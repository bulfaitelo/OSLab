{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Balancete')

@section('content_header')
    <h1><i class="fas fa-balance-scale "></i> Balancete</h1>
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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="data_inicio">Data Início</label>
                        {!! html()->date('data_inicio')->class('form-control')->placeholder('Data Início') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="data_fim" >Data Fim</label>
                        {!! html()->date('data_fim', Carbon\Carbon::now()->format('d-m-Y'))->class('form-control')->placeholder('Data Fim') !!}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Tipo de agrupamento</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! html()->radio('tipo_de_agrupamento', '', 'os')->class('form-check-input')->attribute('id', 'radio_os') !!}
                        <label class="form-check-label" for="radio_os">OS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! html()->radio('tipo_de_agrupamento', '', 'mes')->class('form-check-input')->attribute('id', 'radio_mes') !!}
                        <label class="form-check-label" for="radio_mes">Mês</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!! html()->radio('tipo_de_agrupamento', '', 'centro_de_custo')->class('form-check-input')->attribute('id', 'radio_centro_custo') !!}
                        <label class="form-check-label" for="radio_centro_custo">Centro de Custo</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit"  class="btn bg-lightblue btn-sm">
                <i class="fa-solid fa-magnifying-glass"></i>
                Buscar
            </button>
        </div>

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
