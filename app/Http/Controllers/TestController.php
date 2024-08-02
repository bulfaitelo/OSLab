<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Os\OsController;
use App\Http\OsLabClass\Backup\GetBackupDataInfo;
use App\Http\Requests\Os\StoreOsRequest;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Os\Os;
use App\Services\OsService\OsService;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;
use Yaza\LaravelGoogleDriveStorage\Gdrive;




class TestController extends Controller
{

    // public function __construct(private readonly OsService $osService) {

    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        dd(storage_path('fonts'));

        // dd($this->osService->createOs(1));
        // Http::fake();
        // $response = Http::post('', [
        //     'teste'=> 'rr',
        // ]);
        // dd($response);
        // dd(config('database.connections.sqlite'));
        // $osService = new OsService;
        // $request->request->set(
            //     'teste', 'valor TESte'
            // );
            $data = [
                'cliente_id' => 123,
                'tecnico_id' => 123,
                'categoria_id' => 1,
                'status_id' => 3,
                'data_entrada' =>  now() ,
                'data_saida' => now() ,
            ];

            $request = new StoreOsRequest;
            $validator = Validator::make($data, $request->rules());




            dd($request->rules(), $validator->messages(),  $validator->failed());


            $request->merge([
                'cliente_id' => 1233,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 3,
                'data_entrada' =>  now() ,
                'data_saida' => now() ,
            ]);
            $request->all();
            dd($request->all());
        // $request->descricao;
        // $request->defeito;
        // $request->observacoes;
        // $request->laudo;
        // $request->serial;
        // dd($request->all());
        dd($osService->create($request));
        // $emitente = new \App\Models\Configuracao\Sistema\Emitente();
        // dd($emitente->getHtmlEmitente(1));

        // $config = config('backup.backup.destination.disks');
        // dd(explode(',', env('BACKUP_DIRECTORY')), $config);

        //     // dd(config('filesystems.disks.local.root').'/OsLab/OsLab_2023-02-19-14-36-53.zip');
        //     // $path = config('filesystems.disks.local.root').'/OsLab/OsLab_2024-02-19-18-37-54.zip';
        //     // $teste = Gdrive::put('filename.zip', $path);

        // dd(collect(Storage::disk('google')->listContents('')));
        // $teste = Gdrive::all('/');
        // dd($teste);
        //     // dd($path);



        // // $backupStatus = BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'));
        // // dd($backupStatus->wasSuccessful());

        // // $backupDestinations = BackupDestinationFactory::createFromArray(config('backup.backup'));
        // // dd($backupDestinations);
        // // // dd(config('backup.backup'));



        // $emitente = Emitente::getHtmlEmitente(1);
        return view("teste");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
