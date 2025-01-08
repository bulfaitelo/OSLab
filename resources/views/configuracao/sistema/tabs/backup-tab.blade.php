<div>
    <div class="row">
        <div class="col-md-3">
            <label for="sistema[backup_local_store]">Ativar Backup Local</label>
            <div class="custom-control custom-switch custom-switch-md">
                {!! html()->checkbox('sistema[backup_local_store]', getConfig('backup_local_store'))->class('custom-control-input')->disabled(!in_array('local', explode(',', env('BACKUP_DIRECTORY')))) !!}
                <label class="custom-control-label" for="sistema[backup_local_store]"></label>
            </div>
        </div>
        <div class="col-md-3">
            <label for="sistema[backup_gdrive_store]">Ativar Backup Google Drive</label>
            <div class="custom-control custom-switch custom-switch-md">
                {!! html()->checkbox('sistema[backup_gdrive_store]', getConfig('backup_gdrive_store'))->class('custom-control-input')->disabled(!in_array('google', explode(',', env('BACKUP_DIRECTORY')))) !!}
                <label class="custom-control-label" for="sistema[backup_gdrive_store]"></label>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[backup_recorrencia]"> Recorrência de Backup </label>
                {!! html()->select('sistema[backup_recorrencia]', $recorrenciaBackup, getConfig('backup_recorrencia'))->class('form-control') !!}
                <i>Define a recorrência do backup. </i>
            </div>
        </div> --}}
        <div class="col-md-3">
            <div class="form-group">
                <label for="sistema[backup_horario]"> Horário execução Backup </label>
                {!! html()->text('sistema[backup_horario]', getConfig('backup_horario'))->class('form-control hora') !!}
                <i>Define o horário de execução do backup </i>
            </div>
        </div>
    </div>
</div>
