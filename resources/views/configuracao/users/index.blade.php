@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1><i class="fas fa-users "></i> Usuários</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
            <div class="row"></div>
            <a href="{{ route('configuracao.roles.index') }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
            </a>
            @can('config_users_create')
                <a href="{{ route('configuracao.users.create') }}">
                    <button type="button"  class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Criar Usuário
                    </button>
                </a>
            @endcan
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-sm table-hover text-nowrap">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>Status</th>
                    <th>Usuário</th>
                    <th>Setor</th>
                    <th>Validade</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        @if ($user->ativo)
                        <td>
                            <span class="badge bg-success">Ativo</span>
                        </td>
                        @else
                        <td>
                            <span class="badge bg-danger">Desativado</span>
                        </td>
                        @endif
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->setor->name ?? ''}}</td>
                        <td>{{ $user->expire_at?->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm ">
                                @can('config_users_edit')
                                    <a href="{{ route('configuracao.users.edit', $user->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('config_users_show')
                                    <a href="{{ route('configuracao.users.show', $user->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('config_users_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$user->name}}" data-url="{{route('configuracao.users.destroy', $user->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
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
            {{$users->links() }}
        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('config_users_destroy')
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
