{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Buscar')

@section('content_header')
    <h1>OSLAB - Buscar</h1>
@stop

@section('content')
{{-- OS --}}
@if ($os->total() > 0)
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle">
            <h3 class="card-title pt-1">Os</h3>
            <div class="card-tools">
                <a href="{{ route('os.index', ['busca' => $request->busca]) }}">
                    <button class="btn btn-sm btn-oslab" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <b>Ver todos </b>
                        <span title="Total encontrados 132132" class="badge bg-indigo">{{ $os->total() }}</span>
                    </button>
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-2 table-responsive" >
            @include('os.partials.os-table', [
                'osTable' => $os,
                'show'=> true
            ])
        </div>
    </div>
@endif
{{-- FIM - OS  --}}

{{-- Produto --}}
@if ($produtos->total() > 0)
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle">
            <h3 class="card-title pt-1">Produtos</h3>
            <div class="card-tools">
                <a href="{{ route('produto.index', ['busca' => $request->busca]) }}">
                    <button class="btn btn-sm btn-oslab" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <b>Ver todos </b>
                        <span title="Total encontrados 132132" class="badge bg-indigo">{{ $produtos->total() }}</span>
                    </button>
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-2 table-responsive" >
            @include('produto.partials.produto-table', [
                'produtoTable' => $produtos,
                'show'=> true,
            ])
        </div>
    </div>
@endif
{{-- FIM - Produto  --}}

{{-- Cliente --}}
@if ($clientes->total() > 0)
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle">
            <h3 class="card-title pt-1">Clientes</h3>
            <div class="card-tools">
                <a href="{{ route('cliente.index', ['busca' => $request->busca]) }}">
                    <button class="btn btn-sm btn-oslab" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <b>Ver todos </b>
                        <span title="Total encontrados 132132" class="badge bg-indigo">{{ $clientes->total() }}</span>
                    </button>
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-2 table-responsive" >
            @include('cliente.partials.cliente-table', [
                'clientesTable' => $clientes,
                'show'=> true,
            ])
        </div>
    </div>
@endif
{{-- FIM - Cliente  --}}

{{-- Wiki --}}
@if ($wikis->total() > 0)
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle">
            <h3 class="card-title pt-1">Wikis</h3>
            <div class="card-tools">
                <a href="{{ route('wiki.index', ['busca' => $request->busca]) }}">
                    <button class="btn btn-sm btn-oslab" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <b>Ver todos </b>
                        <span title="Total encontrados 132132" class="badge bg-indigo">{{ $wikis->total() }}</span>
                    </button>
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-2 table-responsive" >
            @include('wiki.partials.wiki-table', [
                'wikiTable' => $wikis,
                'show'=> true,
            ])
        </div>
    </div>
@endif
{{-- FIM - Wiki  --}}
@stop

@section('css')

@stop

@section('js')

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
