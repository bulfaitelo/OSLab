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
            {!! html()->form('post', route('configuracao.sistema.store'))->open() !!}
            <div class="card-body">
                    @include('adminlte::partials.form-alert')
                    <div class="tab-content">
                        {{-- LIST --}}
                        <div class="tab-pane fade  active show" id="list" role="tabpanel" aria-labelledby="list-tab">
                            @dump($backupInfo)
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
                                                {{-- @dump(config('filesysten')) --}}
                                                <td>{{ $backup['name'] }}</td>
                                                <td>{{ $backup['date']->format('d/m/Y h:i:s') }}</td>
                                                <td>{{ $backup['size'] }}</td>
                                                <td>botões</td>
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
                        <div class="tab-pane fade " id="configuracao" role="tabpanel" aria-labelledby="os-tab">
                            Config
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                @can('config_sistema_edit')
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                @endcan
            </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
