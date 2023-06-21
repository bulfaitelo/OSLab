@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <h1>Configuração de Permissões</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row"></div>
          <a href="{{ route('configuracao.roles.index') }}">
              <button type="button"  class="btn  btn-info"><i class="fas fa-chevron-left"></i> Voltar</button>
          </a>
          @can('config_permissions_create')
            <a href="{{ route('configuracao.permissions.create') }}">
                <button type="button"  class="btn  btn-primary">Criar Permissão</button>
            </a>
          @endcan
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
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
                <td>{{ @$group::find($permission->group_id)->name}}</td>
                <td>
                  <div class="btn-group">
                    @can('config_permissions_edit')
                        <a href="{{ route('configuracao.permissions.edit', $permission->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                    @endcan
                    @can('config_permissions_destroy')
                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $permission->id }}"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="modal fade" id="modal-excluir_{{ $permission->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Realmente deseja Excluir?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <p><b>Nome:</b> {{ $permission->name}}</p>
                                @if ($permission->description)
                                <p><b>Descrição:</b> {{ $permission->description}}</p>
                                @endif
                                </div>
                                <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {{-- <button type="submit" class="btn btn-danger">Excluir</button> --}}

                                {{-- <form method="POST" action="/admin/users/{{$permission->id}}"> --}}
                                    {!! Form::open(['route' => ['configuracao.permissions.destroy', $permission->id], 'method' => 'delete']) !!}

                                    <input type="submit" class="btn btn-danger delete-permission" value="Delete permission">
                                </form>

                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endcan
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

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
