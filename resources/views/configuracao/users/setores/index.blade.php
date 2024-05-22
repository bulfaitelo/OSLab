@extends('adminlte::page')

@section('title', 'Setores')

@section('content_header')
    <h1><i class="fas fa-industry "></i> Setores</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('config_user_setor_create')
                <a href="{{ route('configuracao.user.setor.create') }}">
                    <button type="button"  class="btn btn-sm btn-oslab">
                        <i class="fa-solid fa-plus"></i>
                        Criar setor
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
                    <th>Setor</th>
                    <th>Usuários</th>
                    <th style="width: 40px"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($setores as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{$item->users->count()}}</td>
                        <td>
                            <div class="btn-group btn-group-sm ">
                            @can('config_user_setor_edit')
                            <a href="{{ route('configuracao.user.setor.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('config_user_setor_destroy')
                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('configuracao.user.setor.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                            @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="5" > <h4>Não existem registros</h4></td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$pacientes->appends(['busca' => $busca])->links() }}	 --}}
            {{$setores->links() }}

        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('config_user_setor_destroy')
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
