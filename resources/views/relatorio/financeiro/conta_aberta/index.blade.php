{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Relatório de Contas em Aberto')

@section('content_header')
<h1><i class="fa-solid fa-money-bill"></i> Relatório de Contas em Aberto</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        {!! html()->form('get', route('relatorio.financeiro.conta_aberta.index'))->open() !!}
        <div class="card-header ">
            <a href="{{ url()->previous() }}">
                <button type="button" class="btn btn-sm btn-default d-print-none">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @if (Request::all())
                <a onclick="window.print();return false;">
                    <button type="button" title="Imprimir" class="btn btn-sm bg-navy d-print-none">
                        <i class="fa-solid fa-print"></i>
                        <span class="d-none d-sm-inline">Imprimir</span>
                    </button>
                </a>
            @endif
            <button type="submit" class="float-right btn bg-lightblue btn-sm d-print-none">
                <i class="fa-solid fa-magnifying-glass"></i>
                Buscar
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="d-none d-print-block">
                {{ App\Models\Configuracao\Sistema\Emitente::getHtmlEmitente(1) }}
            </div>
            @include('adminlte::partials.form-alert')
            <div class="row d-print-none">
                <div class="col-md-2">
                    <label>Financeiro</label>
                    {{ html()->select('financeiro', ['despesa' => 'Despesas', 'receita' => 'Receitas'], $request->financeiro)->class('form-control form-control-sm')->placeholder('Receitas / Despesas') }}
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="busca">Cliente / Fornecedor / Despesa / Observação </label>
                        {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Cliente, Fornecedor, Despesa ou Observação') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-2 ">
                        <label for="centro_custo">Centro de Custo</label>
                        {!! html()->select('centro_custo', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'), $request->centro_custo)->class('form-control form-control-sm')->placeholder('Todos') !!}
                    </div>
                </div>                
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_inicio">Data Início</label>
                        {!! html()->date('data_inicio', $request->data_inicio )->class('form-control  form-control-sm')->placeholder('Data Início') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_fim">Data Fim</label>
                        {!! html()->date('data_fim', $request->data_fim )->class('form-control  form-control-sm')->placeholder('Data Fim') !!}
                    </div>
                </div>               
                {{-- <div class="col-md-2">
                    <div class="form-group">
                        <label for="ordenacao">Ordenação </label>
                        {!! html()->select('ordenacao', ['data' => 'Data', 'nome' => 'Nome', 'saldo' => 'Saldo'],
                        ($request->ordenacao == true) ? $request->ordenacao : '' )->class('form-control
                        form-control-sm') !!}
                    </div>
                </div> --}}
            </div>
            <div class=" table-responsive">                       
                @if ($relatorio)
                    <hr>
                    @include('relatorio.financeiro.conta_aberta.relatorio')
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
