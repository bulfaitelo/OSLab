@extends('adminlte::page')

@section('title', 'Editar Ordem de Serviço')

@section('content_header')
    <h1><i class="fa-regular fa-rectangle-list "></i> Editar Ordem de Serviço</h1>
@stop

@section('content')

<div class="card card-primary card-outline">
    <div class="card-header border-0 pb-0">
        <a href="{{ url()->previous() }}">
            <button type="button"  class="btn btn-sm btn-default">
                <i class="fa-solid fa-chevron-left"></i>
                <span class="d-none d-sm-inline">Voltar</span>
            </button>
        </a>
        @can('os_show')
        <a href="{{ route('os.show', $os) }}">
            <button type="button" title="Editar" class="btn btn-sm btn-default">
                <i class="fas fa-eye"></i>
                <span class="d-none d-sm-inline">visualizar</span>
            </button>
        </a>
        @endcan
        @can('os_faturar')
        <button type="button" title="Editar" class="btn btn-sm btn-success" data-toggle="modal" data-target="#faturarModal">
            <i class="fa-solid fa-dollar-sign"></i>
            <span class="d-none d-sm-inline">Faturar</span>

        </button>
        @endcan
        @can('os_print')
        <a href="{{ route('os.show', $os) }}">
            <button type="button" title="Imprimir" class="btn btn-sm bg-navy">
                <i class="fa-solid fa-print"></i>
                <span class="d-none d-sm-inline">Imprimir</span>
            </button>
        </a>
        @endcan

    </div>
    <div class="card-body pt-2">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active" id="detalhes-tab" data-toggle="pill" href="#detalhes" role="tab" aria-controls="detalhes" aria-selected="true">
                    <i class="fa-regular fa-rectangle-list "></i>
                    <span class="d-none d-sm-inline">Detalhes</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="#produtos-tab" data-toggle="pill" href="#produtos" role="tab" aria-controls="produtos" aria-selected="false">
                    <i class="fas fa-box-open "></i>
                    <span class="d-none d-sm-inline">Produtos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="servicos-tab" data-toggle="pill" href="#servicos" role="tab" aria-controls="servicos" aria-selected="false">
                    <i class="fas fa-hand-holding-usd "></i>
                    <span class="d-none d-sm-inline">Serviços</span>
                </a>
            </li>
            @if ($os->categoria->checklist_id)
            <li class="nav-item">
                <a class="nav-link" id="checklist-tab" data-toggle="pill" href="#checklist" role="tab" aria-controls="checklist" aria-selected="false">
                    <i class="fa-solid fa-list-check "></i>
                    <span class="d-none d-sm-inline">Checklist</span>

                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" id="informacoes-tab" data-toggle="pill" href="#informacoes" role="tab" aria-controls="informacoes" aria-selected="false">
                    <i class="fa-solid fa-circle-info"></i>
                    <span class="d-none d-sm-inline">Informações</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="log-tab" data-toggle="pill" href="#log" role="tab" aria-controls="log" aria-selected="false">
                    <i class="fa-regular fa-file-lines"></i>
                    <span class="d-none d-sm-inline">Log</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="balancete-tab" data-toggle="pill" href="#balancete" role="tab" aria-controls="balancete" aria-selected="false">
                    <i class="fas fa-balance-scale"></i>
                    <span class="d-none d-sm-inline">Balancete</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="detalhes" role="tabpanel" aria-labelledby="detalhes-tab">
                @livewire('os.detalhes-tab', ['os' => $os])
            </div>
            <div class="tab-pane fade " id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                @livewire('os.produto-tab', ['os_id' => $os->id])
            </div>
            <div class="tab-pane fade " id="servicos" role="tabpanel" aria-labelledby="servicos-tab">
                @livewire('os.servico-tab', ['os_id' => $os->id])
            </div>
            @if ($os->categoria->checklist_id)
            <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="checklist-tab">
                @livewire('os.checklist-tab', ['os_id' => $os->id])
            </div>
            @endif
            <div class="tab-pane fade" id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab">
                @livewire('os.informacoes-tab', ['os_id' => $os->id])
            </div>
            <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="log-tab">
                log
            </div>
            <div class="tab-pane fade" id="balancete" role="tabpanel" aria-labelledby="balancete-tab">
                balancete
            </div>
        </div>
    </div>
</div>

<!-- Modal - ANOTACAO  -->
<div class="modal fade" id="faturarModal" tabindex="-1" role="dialog" aria-labelledby="faturarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="faturarModalLabel">Adicionar Anotação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                {!! html()->text('descricao')->class('form-control')->placeholder('Modelo do aparelho')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="centro_custo_id">Centro de Custo</label>
                                {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('receita', '1')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione o Centro de Custo')->required() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <label data-toggle="collapse" href="#observacoes-div" role="button" for="observacoes" aria-expanded="true" aria-controls="observacoes" >
                                    Observações
                                    <i id="obervacoes-icon" class="fa-solid fa-caret-right"></i>
                                </label>
                                <div id="observacoes-div" class="collapse ">
                                    {!! html()->textarea('observacoes')->class('form-control mb-2')->placeholder('Observações (opcional)') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="entrada">Entrada</label>
                                {!! html()->date('entrada')->class('form-control')->placeholder('Modelo do aparelho')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                {!! html()->text('valor')->class('form-control')->placeholder('Modelo do aparelho')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="recebido">Recebido</label>
                                <div class="custom-control custom-switch custom-switch-md">
                                    <input type="checkbox" name="recebido" id="recebido" class="custom-control-input" >
                                    <label class="custom-control-label" for="recebido"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="recebido-div" class="row" style="display: none">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="data_recebimento">Data Recebimento</label>
                                {!! html()->date('data_recebimento')->class('form-control')->placeholder('Modelo do aparelho')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="forma_pagamento_id">Forma de pagamento</label>
                                {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                        <i class="fa-regular fa-rectangle-xmark"></i>
                        Fechar
                    </button>
                    <button type="submit" id="salvechecklist" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM Modal - ANOTACAO  -->

@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="{{ url('') }}/vendor/patternlock/patternlock.css">
<style>

    .icon{
        width: 3rem;
    }
    .item{
        width: 100%;
    }

    .ts-wrapper .option .title {
        display: block;
    }
    .ts-wrapper .option .url {
        font-size: 15px;
        display: block;
        color: #7c7c7c;
    }

    .ts-wrapper::after {
        display: none;
    }

    .custom-switch.custom-switch-md .custom-control-label {
        padding-left: 2rem;
        padding-bottom: 1.5rem;
    }

    .custom-switch.custom-switch-md .custom-control-label::before {
        height: 1.5rem;
        width: calc(2rem + 0.75rem);
        border-radius: 3rem;
    }

    .custom-switch.custom-switch-md .custom-control-label::after {
        width: calc(1.5rem - 4px);
        height: calc(1.5rem - 4px);
        border-radius: calc(2rem - (1.5rem / 2));
    }

    .custom-switch.custom-switch-md .custom-control-input:checked ~ .custom-control-label::after {
        transform: translateX(calc(1.5rem - 0.25rem));
    }

</style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script src="{{ url('') }}/vendor/patternlock/patternlock.js"></script>
<script src="{{ url('') }}/vendor/form-builder/form-render.min.js"></script>

{{-- <script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script> --}}
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
    $('.numero').mask('#', { reverse: true });

    $('#observacoes-div').on('show.bs.collapse', function () {
        $('#obervacoes-icon').removeClass('fa-caret-right').addClass('fa-caret-down');
    })
    $('#observacoes-div').on('hidden.bs.collapse', function () {
        $('#obervacoes-icon').removeClass('fa-caret-down').addClass('fa-caret-right');
    })

    $('#recebido').on('change', function () {
        if (this.checked) {
            $('#recebido-div').css('display', '');
        } else {
            $('#recebido-div').css('display', 'none');
        }
    });
</script>
@stop
