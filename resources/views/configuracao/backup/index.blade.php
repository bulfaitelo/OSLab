{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Backup')

@section('content_header')
    <h1><i class="fa-solid fa-server "></i> Backup </h1>
@stop

@section('content')
<div class="row justify-content-md-center">
    <div class="col-12 col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="#list-tab" data-toggle="pill" href="#list" role="tab" aria-controls="list" aria-selected="true">
                            <i class="fa-regular fa-rectangle-list "></i>
                            <span class="d-none d-sm-inline">Backups</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="os-tab" data-toggle="pill" href="#configuracao" role="tab" aria-controls="configuracao" aria-selected="false">
                            <i class="fas fa-cogs "></i>
                            <span class="d-none d-sm-inline">Configurações</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                    @include('adminlte::partials.form-alert')
                    <div class="tab-content">
                        {{-- LIST --}}
                        <div class="tab-pane fade " id="list" role="tabpanel" aria-labelledby="list-tab">
                            {{-- @dump($backupInfo) --}}
                            @forelse ($backupInfo as $disco)
                            <div class="card card-primary card-outline card-outline-tabs">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Disco</th>
                                            <th>Acessível</th>
                                            <th>Saudável</th>
                                            <th>Ultimo Backup</th>
                                            <th>Quantidade de Backups</th>
                                            <th>Espaço em Disco</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $disco['name'] }}</td>
                                        <td>{{ $disco['disk'] }}</td>
                                        @if ($disco['reachable'])
                                        <td>
                                            <i style="color:green" class=" fa-regular fa-circle-check"></i>
                                        </td>
                                        @else
                                        <td>
                                            <i style="color:red"  class="fa-regular fa-circle-xmark"></i>
                                        </td>
                                        @endif
                                        @if ($disco['healthy'])
                                        <td> <i style="color:green" class="fa-regular fa-circle-check"></i> </td>
                                        @else
                                        <td>
                                            <i style="color:red"  class="fa-regular fa-circle-xmark"></i>
                                        </td>
                                        @endif
                                        <td>{{ $disco['newest'] }}</td>
                                        <td>{{ $disco['count'] }}</td>
                                        <td>{{ $disco['storageSpace'] }}</td>
                                    </tr>
                                </table>
                                @if (count($disco['backups']))
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Arquivo</th>
                                            <th>Data</th>
                                            <th>Tamanho</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($disco['backups'] as $backup)
                                            <tr>
                                                <td>{{ $backup['name'] }}</td>
                                                <td>{{ $backup['date']->format('d/m/Y h:i:s') }}</td>
                                                <td>{{ $backup['size'] }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm ">
                                                    @can('config_backup_download')
                                                        @if ($backup['path'])
                                                        <a onclick="document.getElementById('{{ $backup['name'] }}').submit();"  title="Download" class="btn btn-left btn-primary"><i class="fa-solid fa-download"></i></a>
                                                        {!! html()->form('post', route('configuracao.backup.download'))->attribute('id', $backup['name'])->open() !!}
                                                            {!! html()->hidden('path', $backup['path']) !!}
                                                        {!! html()->form()->close() !!}
                                                        @else
                                                            <a href="" title="Download" class="btn btn-left btn-primary disabled"><i class="fa-solid fa-download"></i></a>
                                                        @endif
                                                    @endcan
                                                    @can('config_backup_destroy')
                                                        @if ($backup['path'])
                                                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$backup['name']}}" data-path="{{$backup['path']}}" data-url="{{route('configuracao.backup.delete')}}" data-target="#modal-excluir-download"><i class="fas fa-trash"></i></button>
                                                        @else
                                                            <button type="button" class="btn btn-block btn-danger disabled"><i class="fas fa-trash"></i></button>
                                                        @endif
                                                    @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                                @endif
                            </div>
                            @empty
                                <h5>Backup não configurado.</h5>
                            @endforelse





                        </div>
                        {{-- CONFIG --}}
                        <div class="tab-pane fade active show" id="configuracao" role="tabpanel" aria-labelledby="os-tab">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="local">Ativar Backup Local</label>
                                            <div class="custom-control custom-switch custom-switch-md">
                                                {!! html()->checkbox('local', true)->class('custom-control-input') !!}
                                                <label class="custom-control-label" for="local"></label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="drive">Ativar Backup Google Drive</label>
                                            <div class="custom-control custom-switch custom-switch-md">
                                                {!! html()->checkbox('drive', true)->class('custom-control-input') !!}
                                                <label class="custom-control-label" for="drive"></label>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sistema[default_os_create_status]"> Recorrência de Backup </label>
                                                {!! html()->select('sistema[default_os_create_status]', $recorrenciaBackup, getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
                                                <i>Define a recorrência do backup. </i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4>Dados de configuração do Google Drive</h4>
                                        @dump(config('backup'))
                                        @dump(getConfig('default_os_create_status'))

                                    </div>
                                </div>
                                <div class="card-footer">
                                    @can('config_backup_edit')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-save"></i>
                                            Salvar
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('config_backup_destroy')
        <div class="modal fade"  id="modal-excluir-download" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Realmente deseja Excluir?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p><b>Nome:</b> <span></span></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa-solid fa-ban"></i>
                        Fechar
                    </button>
                    {!! html()->form('post', route('configuracao.backup.delete'))->open() !!}
                        {!! html()->hidden('path') !!}
                        <button type="submit" class="btn btn-danger delete-permission">
                            <i class="fa-solid fa-trash"></i>
                            Excluir
                        </button>
                    {!! html()->form()->close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{-- // Modal Excluir --}}
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $('#modal-excluir-download').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('name') // Extract info from data-* attributes
        var path = button.data('path') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body span').text(name)
        modal.find('#path').val(path)
    })
</script>
@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
