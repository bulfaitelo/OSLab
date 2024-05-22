@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1><i class="fas fa-box-open"></i> Produtos</h1>
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
            @can('produto_create')
            <a href="{{ route('produto.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Produto
                </button>
            </a>
            @endcan
            <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseProduto" aria-expanded="false" aria-controls="collapseProduto">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseProduto">
                <hr>
                {{ html()->form('get', route('produto.index'))->open() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="busca">Produto / Descrição</label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Produto ou Descrição de produto') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="centro_custo_id">Centro de Custo</label>
                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'), $request->centro_custo_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group text-right mb-2">
                            <button type="submit"  class="btn bg-lightblue btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                            @if (count($request->all()) > 0)
                            <a href="{{ route('produto.index') }}">
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
            @include('produto.partials.produto-table',
                ['produtoTable' => $produtos,  'edit' => true, 'show'=> true,  'destroy' => true, 'movimentacao' => true , 'movimentacao_create' => true]
            )
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{$produtos->appends($request->all())->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('produto_destroy')
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
