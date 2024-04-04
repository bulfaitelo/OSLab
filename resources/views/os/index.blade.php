@extends('adminlte::page')

@section('title', 'Ordem de Serviço')

@section('content_header')
    <h1><i class="fa-regular fa-rectangle-list "> </i> Ordem de Serviço</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        <div class="card-header card-outline card-primary pb-2 ">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('os_create')
            <a href="{{ route('os.create') }}">
                <button type="button"  class="btn btn-sm bg-primary">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar OS
                </button>
            </a>
            @endcan
            <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseOs" aria-expanded="false" aria-controls="collapseOs">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseOs">
                <hr>
                {{ html()->form('get', route('os.index'))->open() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="busca">Cliente / Descricao / Laudo / Defeito / Modelo</label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Cliente, Descricao, Laudo, Defeito') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="categoria_id">Categoria</label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Os\OsCategoria::orderBy('name')->pluck('name', 'id'), $request->categoria_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="periodo">Período</label>
                            {!! html()->select('periodo',['dia' => 'Dia', 'mes' => 'Mês', 'ano' => 'Ano'], $request->periodo)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="data_inicial">Data Início </label>
                            {!! html()->date('data_inicial', $request->data_inicial)->class('form-control form-control-sm')->placeholder('Nome da forma de pagamento') !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="data_final">Data Fim </label>
                            {!! html()->date('data_final', $request->data_final)->class('form-control form-control-sm')->placeholder('Nome da forma de pagamento') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="status">Status</label>
                            {!! html()->select('status_id', \App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), $request->status_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group text-right mb-2">
                            <button type="submit"  class="btn bg-lightblue btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                            @if (count($request->all()) > 0)
                            <a href="{{ route('os.index') }}">
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
        <!-- card-body -->
        <div class="card-body pt-2 table-responsive">
            @include('os.partials.os-table', ['osTable' => $os,  'edit' => true, 'show'=> true,  'destroy' => true])
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{$os->appends($request->all())->links() }}
        </div>

    {{-- Modal Excluir --}}
    @can('os_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
    {{-- // Modal Excluir --}}
    </div>
</div>
@stop

@section('css')

<style>
    .os {
        border-top: 3px solid #39cccc;
    }
</style>
@stop

@section('js')
@stop
