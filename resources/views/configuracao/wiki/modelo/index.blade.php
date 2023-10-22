@extends('adminlte::page')

@section('title', 'Modelos')

@section('content_header')
    <h1><i class="fa-solid fa-book "> </i> Modelos</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('config_wiki_modelo_create')
            <a href="{{ route('configuracao.wiki.modelo.create') }}">
                <button type="button"  class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Modelo
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
                    <th>Wiki</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modelos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name}}</td>
                        <td><b>[{{$item->wiki->fabricante->name}}]</b> - {{ $item->wiki->name}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('config_wiki_modelo_edit')
                                    <a href="{{ route('configuracao.wiki.modelo.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('config_wiki_modelo_show')
                                    <a href="{{ route('configuracao.wiki.modelo.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('config_wiki_modelo_destroy')
                                    <button data-url="{{route('configuracao.wiki.modelo.destroy', $item->id)}}" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
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
            {{-- {{$Fabricante->appends(['busca' => $busca])->links() }} --}}
            {{ $modelos->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('config_wiki_modelo_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
    {{-- // Modal Excluir --}}
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
@stop
