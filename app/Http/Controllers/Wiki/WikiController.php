<?php

namespace App\Http\Controllers\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wiki\StoreFileRequest;
use App\Http\Requests\Wiki\StoreLinkRequest;
use App\Http\Requests\Wiki\StoreWikiRequest;
use App\Http\Requests\Wiki\UpdateWikiRequest;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Wiki\File as WikiFile;
use App\Models\Wiki\Link;
use App\Models\Wiki\Wiki;
use App\Services\Html\ImageProcessor;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WikiController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:wiki', ['only' => 'index']);
        $this->middleware('permission:wiki_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:wiki_show', ['only' => 'show']);
        $this->middleware('permission:wiki_edit', ['only' => ['edit', 'update', 'textUpdate']]);
        $this->middleware('permission:wiki_destroy', ['only' => 'destroy']);

        $this->middleware('permission:wiki_link_create', ['only' => ['linkCreate']]);
        $this->middleware('permission:wiki_link_destroy', ['only' => 'linkDestroy']);

        $this->middleware('permission:wiki_file_create', ['only' => ['fileCreate']]);
        $this->middleware('permission:wiki_file_destroy', ['only' => 'fileDestroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $wikis = Wiki::getDataTable($request);

        return view('wiki.index', compact('wikis', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wiki.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWikiRequest $request)
    {
        $wiki = new Wiki;
        $modelo = new Modelo;
        DB::beginTransaction();
        try {
            $wiki->name = $request->name;
            $wiki->fabricante_id = $request->fabricante_id;
            $wiki->categoria_id = $request->categoria_id;
            $wiki->user_id = Auth::id();
            $wiki->save();
            $modelo->name = \Str::upper($request->modelo);
            $modelo->wiki_id = $wiki->id;
            $modelo->save();
            DB::commit();

            return redirect()->route('wiki.show', $wiki->id)
                ->with('success', 'Wiki cadastrada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wiki $wiki)
    {
        return view('wiki.show', compact('wiki'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wiki $wiki)
    {
        return view('wiki.edit', compact('wiki'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWikiRequest $request, Wiki $wiki)
    {
        DB::beginTransaction();
        try {
            $wiki->name = $request->name;
            $wiki->fabricante_id = $request->fabricante_id;
            $wiki->categoria_id = $request->categoria_id;
            $wiki->user_id = Auth::id();
            $wiki->save();
            DB::commit();

            return redirect()->route('wiki.index')
                ->with('success', 'Wiki atualizada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wiki $wiki)
    {
        try {
            Storage::deleteDirectory('public/wiki/'.$wiki->id);
            $wiki->delete();

            return redirect()->route('wiki.index')
                ->with('success', 'Wiki excluída com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the text Wiki resource in storage.
     */
    public function textUpdate(Request $request, Wiki $wiki)
    {
        try {
            $processor = new ImageProcessor;
            $processedHtml = $processor->trataImagemEnviada($request->texto, $wiki->id);
            $wiki->texto = $processedHtml;
            $wiki->user_id = Auth::id();
            $wiki->save();

            // 1. Cria a notificação
            flash()->success('Wiki atualizada com sucesso!');

            // 2. Retorna os DADOS da notificação em formato JSON
            return response()->json([
                'flash' => flash()->render('json'),
            ]);

        } catch (\Throwable $th) {
            ds($th);
            $response = [
                'text' => 'Ouve um erro, recarregue a pagina e tente novamente',
            ];

            return response()->json($response, 403);
        }
    }

    /**
     * Update Links wiki.
     *
     * recebe o link via post para inserir dentro do formulário
     *
     * @param  Request  $request  Request
     * @param  Wiki  $wiki  Request
     **/
    public function linkCreate(StoreLinkRequest $request, Wiki $wiki)
    {
        try {
            $links = [
                new Link([
                    'name' => $request->name_link,
                    'link' => $request->link,
                    'wiki_id' => $wiki->id,
                    'user_id' => Auth::id(),
                ]),
            ];
            $wiki->links()->saveMany($links);

            return redirect()->route('wiki.show', $wiki->id)
                ->with('success', 'Link cadastrado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Deletando Links da Wiki.
     *
     * @param  Wiki  $wiki  Description
     * @param  Link  $Link  Description
     **/
    public function linkDestroy(Wiki $wiki, Link $link)
    {
        try {
            $link->delete();

            return redirect()->route('wiki.show', $wiki)
                ->with('success', 'Link excluído com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Criando arquivo na wiki.
     *
     * @param  Wiki  $wiki  WIki
     * @param  Request  $request
     **/
    public function fileCreate(Wiki $wiki, StoreFileRequest $request)
    {
        try {
            $fileName = $this->createFileName($request->arquivo_import);
            $file = new WikiFile;
            $file->name = $request->name_file;
            $file->wiki_id = $wiki->id;
            $file->user_id = Auth::id();
            $file->file = $this->storageFile($request, $wiki, $fileName);
            $file->file_name = $fileName;
            $file->save();

            return redirect()->route('wiki.show', $wiki->id)
                ->with('success', 'Arquivo carregado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Apagando Arquivos da Wiki.
     *
     * @param  Wiki  $wiki  Wiki Model
     **/
    public function fileDestroy(Wiki $wiki, WikiFile $file)
    {
        try {
            $path = 'public/'.$file->file;
            if (Storage::fileExists($path)) {
                Storage::delete($path);
            }
            $file->delete();

            return redirect()->route('wiki.show', $wiki)
                ->with('success', 'Arquivo excluído com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Salvando uma arquivo.
     *
     * @param  Request  $request
     * @param  Wiki  $wiki
     * @param  File  $fileName
     * @return string $fileUploaded
     **/
    private function storageFile($request, $wiki, $fileName)
    {
        $fileUploaded = $request->arquivo_import->storeAs(
            'wiki/'.$wiki->id.'/files/',
            $fileName.'.'.$request->arquivo_import->getClientOriginalExtension(),
            'public'
        );
        if (! $fileUploaded) {
            throw new \Exception('Houve um erro com o upload do arquivo, reveja o tamanho dele ou as configurações do servidor!', 1);
        }

        return $fileUploaded;
    }

    /**
     * Cria o nome do arquivo enviado.
     *
     * Cria o nome do arquivo de forma que remova caracteres especiais e adiciona um uuid curto.
     *
     * @param  File  $arquivo
     * @return string $fileName
     **/
    private function createFileName($file)
    {
        $fileName = $this->removeSpecialChars($file->getClientOriginalName()).'_'.$this->generateRandomLetters(7);

        return $fileName;
    }

    /**
     * Gera letras aleatórias para upload de arquivos.
     *
     * @param  int  $length  Tamanho do uuid
     * @return string uuid
     **/
    private function generateRandomLetters($length)
    {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('a'), ord('z')));
        }

        return $random;
    }

    /**
     * Tratando caracteres par remover possíveis caracteres inválidos.
     *
     * @param  string  $str
     * @return string
     **/
    private function removeSpecialChars($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
        $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)

        return $str;
    }
}
