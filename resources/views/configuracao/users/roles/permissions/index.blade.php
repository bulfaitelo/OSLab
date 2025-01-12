@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <h1><i class="fas fa-user-tag "></i> Permissões</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
                <a href="{{ route('configuracao.roles.index') }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
            @can('config_permissions_create')
                <a href="{{ route('configuracao.permissions.create') }}">
                    <button type="button"  class="btn btn-sm btn-oslab">
                        <i class="fa-solid fa-plus"></i>
                        Criar Permissão
                    </button>
                </a>
            @endcan
            <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseProduto" aria-expanded="false" aria-controls="collapseProduto">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseProduto">
                <hr>
                {{ html()->form('get', route('configuracao.permissions.index'))->open() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="busca">Produto / Descrição</label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Produto ou Descrição de produto') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="group_id">Grupo</label>
                            {!! html()->select('group_id', \App\Models\Configuracao\User\PermissionsGroup::orderBy('name')->pluck('name', 'id'), $request->group_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group text-right mb-2">
                            <button type="submit"  class="btn bg-lightblue btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                            @if (count($request->all()) > 0)
                            <a href="{{ route('configuracao.permissions.index') }}">
                                <button type="button"  class="btn bg-gray btn-sm">
                                    <i class="fa-solid fa-xmark"></i>
                                    Limpar
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-sm table-hover text-nowrap">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>Nome da permissão</th>
                    <th>Descrição</th>
                    <th>Grupo</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name}}</td>
                        <td>{{ $permission->description}}</td>
                        <td>{{ @$permission->group->name}}</td>
                        <td>
                            <div class="btn-group btn-group-sm ">
                                @can('config_permissions_edit')
                                    <a href="{{ route('configuracao.permissions.edit', $permission->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('config_permissions_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$permission->name}}" data-url="{{route('configuracao.permissions.destroy', $permission->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$pacientes->appends(['busca' => $busca])->links() }}	 --}}
            {{$permissions->links() }}
        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('config_permissions_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
    {{-- // Modal Excluir --}}
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
