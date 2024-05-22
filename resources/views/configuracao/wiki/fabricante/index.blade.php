@extends('adminlte::page')

@section('title', 'Fabricantes')

@section('content_header')
    <h1><i class="fa-solid fa-book "></i> Fabricantes</h1>
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
            @can('config_wiki_fabricante_create')
            <a href="{{ route('configuracao.wiki.fabricante.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Fabricante
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
                    <th>Descricao</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fabricantes as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->descricao}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('config_wiki_fabricante_edit')
                                    <a href="{{ route('configuracao.wiki.fabricante.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('config_wiki_fabricante_show')
                                    <a href="{{ route('configuracao.wiki.fabricante.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('config_wiki_fabricante_destroy')
                                    <button data-url="{{route('configuracao.wiki.fabricante.destroy', $item->id)}}" type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}"  data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
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
            {{ $fabricantes->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('config_wiki_fabricante_destroy')
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
