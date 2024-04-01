@extends('adminlte::page')

@section('title', 'Checklist')

@section('content_header')
    <h1><i class="fa-solid fa-list-check "></i> Checklist</h1>
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
                @can('checklist_create')
                <a href="{{ route('checklist.create') }}">
                    <button type="button"  class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar Checklist
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
                    <th>Nome</th>
                    <th>Categoria Padrão</th>
                    <th>Criado pelo usuario</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checklists as $item)
                    <tr >
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->categoria->name }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('checklist_show')
                                    <a href="{{ route('checklist.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('checklist_edit')
                                    <a href="{{ route('checklist.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('checklist_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('checklist.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>
                        <!-- /.modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$Checklist->appends(['busca' => $busca])->links() }} --}}
            {{ $checklists->links() }}
        </div>
    </div>
    @can('checklist_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
