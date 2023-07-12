<?php

namespace App\Http\Controllers\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wiki\StoreFileRequest;
use App\Http\Requests\Wiki\StoreLinkRequest;
use App\Http\Requests\Wiki\StoreWikiRequest;
use App\Http\Requests\Wiki\UpdateWikiRequest;
use App\Models\Wiki\Wiki;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Wiki\File as WikiFile;
use App\Models\Wiki\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class WikiController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:wiki', ['only'=> 'index']);
        $this->middleware('permission:wiki_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:wiki_show', ['only'=> 'show']);
        $this->middleware('permission:wiki_edit', ['only'=> ['edit', 'update', 'textUpdate']]);
        $this->middleware('permission:wiki_destroy', ['only'=> 'destroy']);

        $this->middleware('permission:wiki_link_create', ['only'=> ['linkCreate']]);
        $this->middleware('permission:wiki_link_destroy', ['only'=> 'linkDestroy']);

        $this->middleware('permission:wiki_file_create', ['only'=> ['fileCreate']]);
        $this->middleware('permission:wiki_file_destroy', ['only'=> 'fileDestroy']);



    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wikis = Wiki::paginate(100);
        return view('wiki.index',compact('wikis'));
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
        $wiki = new Wiki();
        $modelo = new Modelo();
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
        $teste = $this->trataImagemEnviada($request->texto, $wiki->id);

        dd($teste, $request->input() );
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
    public function textUpdate(Request $request, Wiki $wiki) {
        try {
            $wiki->texto = $this->trataImagemEnviada($request->texto, $wiki->id);
            $wiki->user_id = Auth::id();
            $wiki->save();
            $response = [
                'text' =>  'Wiki atualizada com sucesso.'
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'text' =>  'Ouve um erro, recarregue a pagina e tente novamente'
            ];
            return response()->json($response, 403);
        }
    }

    /**
     * Update Links Wiki
     *
     * recebe o link via post para inserir dentro do formulário
     *
     * @param Request $request Request
     * @param Wiki $wiki Request
     * @return response
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
     * Deletando Links da Wiki
     *
     * Undocumented function long description
     *
     * @param Wiki $wiki Description
     * @param Link $Link Description
     * @return response
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
     * Criando arquivo na wiki
     *
     *
     * @param Wiki $wiki WIki
     * @param Request $request
     * @return response
     **/
    public function fileCreate(Wiki $wiki, StoreFileRequest $request)
    {
        try {
            $fileName = $this->createFileName($request);
            $file = new WikiFile();
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
     * Apagando Arquivos da Wiki
     *
     * @param Wiki $wiki Wiki Model
     * @return response

     **/
    public function fileDestroy(Wiki $wiki, WikiFile $file )
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
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Request $var Description
     * @param Wiki $var Description
     * @param Type $var Description
     * @return String $fileUploaded
     **/
    private function storageFile($request, $wiki ,$fileName)
    {
        $fileUploaded = $request->arquivo_import->storeAs(
            'wiki/'.$wiki->id. '/files/',
            $fileName.'.'.$request->arquivo_import->getClientOriginalExtension(),
            'public'
        );
        if (!$fileUploaded) {
            throw new \Exception("Houve um erro com o upload do arquivo, reveja o tamanho dele ou as configurações do servidor!", 1);
        }

        return $fileUploaded;

    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    private function createFileName($request)
    {
        $fileName = $this->removeSpecialChars($request->arquivo_import->getClientOriginalName()).'_'.$this->generateRandomLetters(7);;
        return $fileName;
    }

    /**
     * Gera letras aleatórias para upload de arquivos.
     *
     * @param Integer $length Tamanho do uuid
     * @return String uuid
     **/
    private function generateRandomLetters($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }

    /**
     * Tratando caracteres par remover possíveis caracteres inválidos.
     *
     * @param String $str
     * @return String
     **/
    private function removeSpecialChars($str) {
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


    /**
     * Trata o texto e enviar as imagens para a pasta upload.
     * @param string $text
     * @param int $id id
     * @return object, $dom HTML
     *
     */
    private function trataImagemEnviada($text, $id) {
        // tratando as imagens enviadas.
        $dom = new \DOMDocument();
        @$dom->loadHTML($this->utf8_to_iso8859_1($text), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->encoding = 'utf-8';
        $imageFile = $dom->getElementsByTagName('img');
        $imagePath = "/storage/wiki/". $id . "/imgs/";
        $path = public_path() . $imagePath;
        $arrayImageUrl = [] ;
        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if(preg_match('/^data:image/m', $data)){
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $imageName = \Str::uuid().'_'.time().$item.'.png';
                if (!is_dir($path)) {
                    mkdir($path, 0750, true);
                }
                file_put_contents($path.$imageName, $imgeData);
                $image->removeAttribute('src');
                $image->setAttribute('src', $imagePath.$imageName);
                $arrayImageUrl[] = $imageName;
            }
            else{
                $arrayImageUrl[] =  str_replace($imagePath, '', $data);
            }
        }
        // Limpando imagens não usadas.
        if (File:: isDirectory($path)) {
            foreach (File::allFiles($path) as  $file) {
                if (!in_array($file->getFileName(), $arrayImageUrl)) {
                    unlink($path.$file->getFileName());
                }
            }
        }
        return $dom->saveHTML($dom->documentElement);
    }

    private function utf8_to_iso8859_1(string $string): string {
        $s = (string) $string;
        $len = \strlen($s);

        for ($i = 0, $j = 0; $i < $len; ++$i, ++$j) {
            switch ($s[$i] & "\xF0") {
                case "\xC0":
                case "\xD0":
                    $c = (\ord($s[$i] & "\x1F") << 6) | \ord($s[++$i] & "\x3F");
                    $s[$j] = $c < 256 ? \chr($c) : '?';
                    break;

                case "\xF0":
                    ++$i;
                    // no break

                case "\xE0":
                    $s[$j] = '?';
                    $i += 2;
                    break;

                default:
                    $s[$j] = $s[$i];
            }
        }

        return substr($s, 0, $j);
    }
}
