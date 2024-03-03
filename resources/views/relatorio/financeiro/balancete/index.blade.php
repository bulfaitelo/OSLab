{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Balancete')

@section('content_header')
    <h1><i class="fas fa-balance-scale "></i> Balancete</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
        {!! html()->form('get', route('relatorio.financeiro.balancete.index'))->open() !!}
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
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="data_inicio">Data Início</label>
                        {!! html()->date('data_inicio', ($request->data_inicio == true) ? $request->data_inicio : Carbon\Carbon::now()->subMonth()->format('d-m-Y') )->class('form-control')->placeholder('Data Início') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="data_fim" >Data Fim</label>
                        {!! html()->date('data_fim', ($request->data_fim == true) ? $request->data_fim : Carbon\Carbon::now()->format('d-m-Y'))->class('form-control')->placeholder('Data Fim') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tipo de agrupamento</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! html()->radio('tipo_de_agrupamento', ($request->tipo_de_agrupamento == 'os') ? $request->tipo_de_agrupamento : true, 'os')->class('form-check-input')->attribute('id', 'radio_os') !!}
                        <label class="form-check-label" for="radio_os">OS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! html()->radio('tipo_de_agrupamento', ($request->tipo_de_agrupamento == 'mes') ? $request->tipo_de_agrupamento : '', 'mes')->class('form-check-input')->attribute('id', 'radio_mes') !!}
                        <label class="form-check-label" for="radio_mes">Mês</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! html()->radio('tipo_de_agrupamento', ($request->tipo_de_agrupamento == 'centro_de_custo') ? $request->tipo_de_agrupamento : '', 'centro_de_custo')->class('form-check-input')->attribute('id', 'radio_centro_custo') !!}
                        <label class="form-check-label" for="radio_centro_custo">Centro de Custo</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="ordenacao" >Ordenação </label>
                    {!! html()->select('ordenacao', ['data' => 'Data', 'nome' => 'Nome', 'saldo' => 'Saldo'], ($request->ordenacao == true) ? $request->ordenacao : '' )->class('form-control') !!}
                    </div>
                </div>
            </div>
            <div class=" table-responsive">
                @if ($osRelatorio)
                    <hr>
                    @include('relatorio.financeiro.balancete.relatorio-os')
                @endif
                @if ($mesRelatorio)
                    <hr>
                    @include('relatorio.financeiro.balancete.relatorio-mes')
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
