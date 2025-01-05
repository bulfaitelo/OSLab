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
        @can('venda_show')
        <a href="{{ route('venda.show', $venda) }}">
            <button type="button" title="Editar" class="btn btn-sm btn-default">
                <i class="fas fa-eye"></i>
                <span class="d-none d-sm-inline">Visualizar</span>
            </button>
        </a>
        @endcan
        @can('venda_faturar')
            @if (!$venda->fatura_id)
            <button onclick="Livewire.dispatch('faturarOs')"  type="button" title="Editar" class="btn btn-sm btn-success" >
                <i class="fa-solid fa-dollar-sign"></i>
                <span class="d-none d-sm-inline">Faturar</span>
            </button>
            @endif
        @endcan
        @can('venda_cancelar_faturar')
            @if ($venda->fatura_id)
                <button type="button" title="Editar" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#cancelarFaturarModal">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <span class="d-none d-sm-inline">Cancelar Fatura</span>
                </button>
                <div class="btn-group btn-group-sm">
                    @can('venda_receita_pagamento_create')
                    <a onclick="Livewire.dispatch('adicionarPagamento')" title="Adicionar Pagamento" class="btn btn-left bg-success"   >
                        <i class="fa-solid fa-plus"></i>
                        <span class="d-none d-sm-inline">Add. Pagamento</span>
                    </a>
                    @endcan
                    @canany(['venda_despesa_create', 'financeiro_despesa_create'])
                    <a href="{{route('venda.despesa.create', $venda)}}" target="_blank" title="Adicionar Despesa" class="btn btn-left bg-danger"  >
                        <i class="fa-solid fa-plus"></i>
                        <span class="d-none d-sm-inline">Add. Despesa</span>
                    </a>
                    @endcanany
                </div>
            @endif
        @endcan
        @can('venda_print')
        <div class="btn-group btn-group-sm">
            <a class="btn btn-sm bg-navy" title="Imprimir" href="{{ route('venda.print', $venda) }}" target="_blank" >
                <i class="fa-solid fa-print"></i>
                <span class="d-none d-sm-inline">Imprimir</span>
            </a>
            <a class="btn btn-sm bg-maroon" title="Imprimir em PDF" href="{{ route('venda.print_pdf', $venda) }}" target="_blank" >
                <i class="fa-regular fa-file-pdf"></i>
                <span class="d-none d-sm-inline">PDF</span>
            </a>
        </div>
        @endcan
        @if ($venda->modelo_id)
            <a target="_blank" href="{{route('wiki.show', $venda->modelo->wiki->id)}}">
                <button type="button"  class="btn bg-primary btn-sm float-right">
                    <i class="fa-solid fa-book"></i>
                    <span class="d-none d-sm-inline">Wiki</span>
                </button>
            </a>
        @endif
    </div>
    <div class="card-body pt-2">
        <ul class="nav nav-tabs" id="os-tabs" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active" id="#produtos-tab" data-toggle="tab" href="#produtos" role="tab" aria-controls="produtos" aria-selected="true">
                    <i class="fas fa-box-open "></i>
                    <span class="d-none d-sm-inline">Produtos</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="detalhes-tab" data-toggle="tab" href="#detalhes" role="tab" aria-controls="detalhes" aria-selected="false">
                    <i class="fa-regular fa-rectangle-list "></i>
                    <span class="d-none d-sm-inline">Detalhes</span>
                </a>
            </li>
            @if ($venda->fatura_id)
            <li class="nav-item">
                <a class="nav-link" id="balancete-tab" data-toggle="tab" href="#balancete" role="tab" aria-controls="balancete" aria-selected="false">
                    <i class="fas fa-balance-scale"></i>
                    <span class="d-none d-sm-inline">Balancete</span>
                </a>
            </li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade " id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                {{-- @livewire('produto.produto-tab', ['venda' => $venda]) --}}
            </div>
            <div class="tab-pane fade active show" id="detalhes" role="tabpanel" aria-labelledby="detalhes-tab">
                {{-- @livewire('venda.detalhes-tab', ['venda' => $venda], key('detalhes-tab')) --}}
            </div>
            @if ($venda->fatura_id)
                <div class="tab-pane fade" id="balancete" role="tabpanel" aria-labelledby="balancete-tab">
                    {{-- @livewire('financeiro.balancete-tab', ['os' => $venda]) --}}
                </div>
            @endif
        </div>
    </div>
</div>

@can('venda_faturar')
<!-- Modal - FATURA  -->
<div class="modal fade" id="faturarModal" tabindex="-1" role="dialog" aria-labelledby="faturarModalLabel" aria-hidden="true">
    {{-- @livewire('financeiro.faturar-modal', ['venda' => $venda], key($venda->id)) --}}
</div>
<!-- FIM Modal - FATURA  -->
@endcan

@can('venda_cancelar_faturar')
<!-- Modal - CANCELAR FATURA  -->
<div class="modal fade" id="cancelarFaturarModal" tabindex="-1" role="dialog" aria-labelledby="cancelarfaturarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! html()->form('delete', route('venda.cancelar-faturar', $venda->id))->open() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="faturarModalLabel">Cancelar Fatura OS: #{{ $venda->id }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Observações ao cancelar uma fatura:</h5>
                    <p>Receitas e despesa serão escluidas.</p>
                    <p>Movimentações de estoque serão apagadas.</p>
                    <p>Estoque será atualizado com o saldo antes do faturamento dessa OS. <br> Talvez seja necessáro corrigir o estoque!</p>
                    <p>O status da os será retornado par ao status padrão.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                        <i class="fa-regular fa-rectangle-xmark"></i>
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-save"></i>
                        Cancelar Fatura
                    </button>
                </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
</div>
<!-- FIM Modal - CANCELAR FATURA  -->
@endcan


{{-- Modal para criação de Pagamento de parcela --}}
@can('venda_receita_pagamento_create')
<div class="modal fade" id="addPagamentoModal">
    {{-- @livewire('financeiro.add-pagamento-modal', ['venda' => $venda], key($venda->id)) --}}
</div>
@endcan
{{-- /Modal para criação de Pagamento de parcela --}}

@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="{{ url('') }}/vendor/patternlock/patternlock.css">
<link href="{{ url('') }}/vendor/tom-select/tom-select.bootstrap4.min.css" rel="stylesheet" />

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
    .ts-control::after {
        display: none!important;
    }


</style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script src="{{ url('') }}/vendor/patternlock/patternlock.js"></script>
<script src="{{ url('') }}/vendor/form-builder/form-render.min.js"></script>

<script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script>
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
            $('#data_recebimento').attr("required","required");
            $('#forma_pagamento_id').attr("required","required");
            $('#valor_recebido').attr("required","required");

        } else {
            $('#recebido-div').css('display', 'none');
            $('#data_recebimento').removeAttr("required");
            $('#forma_pagamento_id').removeAttr("required");
            $('#valor_recebido').removeAttr("required");
        }
    });


    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        tabId = e.target.id;
        if(tabId == 'log-tab'){
            Livewire.dispatchTo('venda.log-tab', 'showLogTab');
        }
        if(tabId == 'balancete-tab'){
            Livewire.dispatchTo('venda.balancete-tab', 'showBalanceteTab');
        }
    });



</script>
@stop
