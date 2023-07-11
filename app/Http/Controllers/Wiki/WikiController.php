<?php

namespace App\Http\Controllers\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wiki\StoreWikiRequest;
use App\Http\Requests\Wiki\UpdateWikiRequest;
use App\Models\Wiki\Wiki;
use App\Models\Configuracao\Wiki\Modelo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

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
     * Trata o texto e enviar as imagens para a pasta upload.
     * @param string $text
     * @param int $id id
     * @return object, $dom HTML
     *
     */
    private function trataImagemEnviada($text, $id) {
        // tratando as imagens enviadas.
        $dom = new \DOMDocument();
        @$dom->loadHTML($text, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->encoding = 'utf-8';
        $imageFile = $dom->getElementsByTagName('img');
        $imagePath = "/uploads/wiki/". $id . "/imgs/";
        $path = public_path() . $imagePath;
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
}
