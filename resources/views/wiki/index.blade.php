@extends('adminlte::page')

@section('title', 'Wiki')

@section('content_header')
    <h1><i class="fa-solid fa-book "></i> Wiki</h1>
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
                @can('wiki_create')
                <a href="{{ route('wiki.create') }}">
                    <button type="button"  class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar Wiki
                    </button>
                </a>
                @endcan
                <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseWiki" aria-expanded="false" aria-controls="collapseWiki">
                    <i class="fa-solid fa-filter"></i>
                    Filtros
                </button>
                <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseWiki">
                    <hr>
                    {{ html()->form('get', route('wiki.index'))->open() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2 ">
                                <label for="busca">Nome / Modelo / Fabricante </label>
                                {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Nome Modelo ou Fabricante') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2 ">
                                <label for="categoria_id">Categoria</label>
                                {!! html()->select('categoria_id', \App\Models\Configuracao\Os\OsCategoria::orderBy('name')->pluck('name', 'id'), $request->categoria_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-group text-right mb-2">
                                <button type="submit"  class="btn bg-lightblue btn-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    Buscar
                                </button>
                                @if (count($request->all()) > 0)
                                <a href="{{ route('wiki.index') }}">
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
        <div class="card-body pt-2 table-responsive">
            @include('wiki.partials.wiki-table', [
                'wikiTable' => $wikis,
                'edit' => true, 'show'=> true,  'destroy' => true
            ])
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{$wikis->appends($request->all())->links() }}
        </div>
    {{-- Modal Excluir --}}
    @can('wiki_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
    {{-- // Modal Excluir --}}
    </div>
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
