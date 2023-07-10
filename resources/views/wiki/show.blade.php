{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Home')

@section('content_header')
    <h1><b>[{{ $wiki->fabricante->name }}]</b> -  {{ $wiki->name}} </h1>
    <h6>{{ $wiki->modelosTitle() }}</h6>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Wiki</h3>
                    @can('wiki_edit')
                    <a href="{{ route('wiki.edit', $wiki->id) }}" title="Editar" >
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </button>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                {!! $wiki->texto !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Links</h3>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Manual de Uso</td>
                                    <td style="width: 40px" >
                                        <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Arquivos</h3>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Firmware... sd.asdssd lorem sdf</td>
                                    <td style="width: 40px" >
                                        <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">OS</h3>
                    {{-- <button type="button" class="btn btn-primary btn-sm">Editar</button> --}}
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm">
                <thead>
                <tr>
                <th style="width: 10px">#</th>
                <th>Task</th>
                <th>Progress</th>
                <th style="width: 40px">Label</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
                </td>
                <td><span class="badge bg-danger">55%</span></td>
                </tr>
                <tr>
                <td>2.</td>
                <td>Clean database</td>
                <td>
                <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
                </div>
                </td>
                <td><span class="badge bg-warning">70%</span></td>
                </tr>
                <tr>
                <td>3.</td>
                <td>Cron job running</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-primary" style="width: 30%"></div>
                </div>
                </td>
                <td><span class="badge bg-primary">30%</span></td>
                </tr>
                <tr>
                <td>4.</td>
                <td>Fix and squish bugs</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-success" style="width: 90%"></div>
                </div>
                </td>
                <td><span class="badge bg-success">90%</span></td>
                </tr>
                </tbody>
                </table>
                </div>
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
