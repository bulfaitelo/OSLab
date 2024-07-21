@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1><i class="fas fa-clipboard-list "></i> Categoria</h1>
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
            @can('config_categoria_create')
            <a href="{{ route('configuracao.parametro.categoria.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Criar Categoria
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
                <th>Categoria</th>
                <th>Garantia</th>
                <th>Centro de custo padrão</th>
                <th>Checklist</th>
                <th style="width: 40px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categoria as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->garantia->name ?? '' }}</td>
                    <td>{{ $item->centroCusto->name ?? '' }}</td>
                    <td>{{ $item->checklist->name ?? '' }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                        @can('config_categoria_edit')
                        <a href="{{ route('configuracao.parametro.categoria.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('config_categoria_show')
                            <a href="{{ route('configuracao.parametro.categoria.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('config_categoria_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('configuracao.parametro.categoria.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
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
            {{$categoria->links() }}
        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('config_categoria_destroy')
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
