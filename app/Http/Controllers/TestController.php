<?php

namespace App\Http\Controllers;

use App\Http\OsLabClass\Backup\GetBackupDataInfo;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Os\Os;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;
use Yaza\LaravelGoogleDriveStorage\Gdrive;




class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
