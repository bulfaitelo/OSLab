{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Relatório Despesas')

@section('content_header')
    <h1><i class="fas fa-balance-scale "></i> Relatório Despesas</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        {!! html()->form('get', route('relatorio.financeiro.despesa.index'))->open() !!}
        <div class="card-header ">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default d-print-none">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @if (Request::all())
            <a onclick="window.print();return false;"  >
                <button type="button" title="Imprimir" class="btn btn-sm bg-navy d-print-none">
                    <i class="fa-solid fa-print"></i>
                    <span class="d-none d-sm-inline">Imprimir</span>
                </button>
            </a>
            @endif
            <button type="submit"  class="float-right btn bg-lightblue btn-sm d-print-none">
                <i class="fa-solid fa-magnifying-glass"></i>
                Buscar
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="d-none d-print-block" >
                {{ App\Models\Configuracao\Sistema\Emitente::getHtmlEmitente(1) }}
            </div>
            @include('adminlte::partials.form-alert')
            <div class="row d-print-none">
                
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="busca">Cliente / Fornecedor / Despesa / Observação </label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Cliente, Fornecedor, Despesa ou Observação') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="centro_custo">Centro de Custo</label>
                            {!! html()->select('centro_custo', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'), $request->centro_custo)->class('form-control form-control-sm')->placeholder('Todos') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-1">
                            <label>Tipo de data</label>
                        </div>
                        <div class="form-check form-check-inline">
                            {!! html()->radio('tipo_data', ($request->tipo_data == 'pagamento') ? $request->tipo_data : true, 'pagamento')->class('form-check-input ')->attribute('id', 'radio_pagamento') !!}
                            <label class="form-check-label" for="radio_pagamento">Pagamento</label>
                        </div>
                        <div class="form-check form-check-inline">
                            {!! html()->radio('tipo_data', ($request->tipo_data == 'vencimento') ? $request->tipo_data : '', 'vencimento')->class('form-check-input ')->attribute('id', 'radio_vencimento') !!}
                            <label class="form-check-label" for="radio_vencimento">Vencimento</label>
                        </div>                    
                    </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="data_inicio">Data Início</label>
                        {!! html()->date('data_inicio', ($request->data_inicio == true) ? $request->data_inicio : now()->startOfMonth()->format('d-m-Y') )->class('form-control  form-control-sm')->placeholder('Data Início') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="data_fim" >Data Fim</label>
                        {!! html()->date('data_fim', ($request->data_fim == true) ? $request->data_fim : now()->endOfMonth()->format('d-m-Y') )->class('form-control  form-control-sm')->placeholder('Data Fim') !!}
                    </div>
                </div>                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="forma_pagamento_id">Forma de pagamento</label>
                        {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'), $request->forma_pagamento_id)->class('form-control  form-control-sm')->placeholder('Todas') !!}
                    </div>
                </div>
                {{-- <div class="col-md-2">
                    <div class="form-group">
                    <label for="ordenacao" >Ordenação </label>
                    {!! html()->select('ordenacao', ['data' => 'Data', 'nome' => 'Nome', 'saldo' => 'Saldo'], ($request->ordenacao == true) ? $request->ordenacao : '' )->class('form-control  form-control-sm') !!}
                    </div>
                </div> --}}
            </div>            
            <div class=" table-responsive">
                
                @if ($relatorio)
                    <hr>
                    @include('relatorio.financeiro.despesa.relatorio')
                @endif                
            </div>
        </div>
        <div class="card-footer">
            @if (Request::all())
                @include('oslab.relatorio.listar-request')
            @endif
        </div>
        {!! html()->form()->close() !!}
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
