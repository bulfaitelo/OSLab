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
                <span class="d-none d-sm-inline">Visualizar</span>
            </button>
        </a>
        @endcan
        @can('os_faturar')
            @if (!$os->fatura_id)
            <button onclick="Livewire.emit('faturarOs', {{$os->id}})"  type="button" title="Editar" class="btn btn-sm btn-success" >
                <i class="fa-solid fa-dollar-sign"></i>
                <span class="d-none d-sm-inline">Faturar</span>
            </button>
            @endif
        @endcan
        @can('os_cancelar_faturar')
            @if ($os->fatura_id)
                <button type="button" title="Editar" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#cancelarFaturarModal">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <span class="d-none d-sm-inline">Cancelar Fatura</span>
                </button>
                <div class="btn-group btn-group-sm">
                    @can('os_receita_pagamento_create')
                    <a title="Adicionar Pagamento" class="btn btn-left bg-success" onclick="Livewire.emit('adicionarPagamento', {{$os->id}})"  >
                        <i class="fa-solid fa-plus"></i>
                        <span class="d-none d-sm-inline">Add. Pagamento</span>
                    </a>
                    @endcan
                    @canany(['os_despesa_create', 'financeiro_despesa_create'])
                    <a href="{{route('os.despesa.create', $os)}}" target="_blank" title="Adicionar Despesa" class="btn btn-left bg-danger"  >
                        <i class="fa-solid fa-plus"></i>
                        <span class="d-none d-sm-inline">Add. Despesa</span>
                    </a>
                    @endcanany
                </div>
            @endif
        @endcan
        @can('os_print')
        <a href="{{ route('os.print', $os) }}" target="_blank">
            <button type="button" title="Imprimir" class="btn btn-sm bg-navy">
                <i class="fa-solid fa-print"></i>
                <span class="d-none d-sm-inline">Imprimir</span>
            </button>
        </a>
        @endcan
        @if ($os->modelo_id)
            <a target="_blank" href="{{route('wiki.show', $os->modelo->wiki->id)}}">
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
                <a class="nav-link active" id="detalhes-tab" data-toggle="tab" href="#detalhes" role="tab" aria-controls="detalhes" aria-selected="true">
                    <i class="fa-regular fa-rectangle-list "></i>
                    <span class="d-none d-sm-inline">Detalhes</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="#produtos-tab" data-toggle="tab" href="#produtos" role="tab" aria-controls="produtos" aria-selected="false">
                    <i class="fas fa-box-open "></i>
                    <span class="d-none d-sm-inline">Produtos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="servicos-tab" data-toggle="tab" href="#servicos" role="tab" aria-controls="servicos" aria-selected="false">
                    <i class="fas fa-hand-holding-usd "></i>
                    <span class="d-none d-sm-inline">Serviços</span>
                </a>
            </li>
            @if ($os->categoria->checklist_id)
            <li class="nav-item">
                <a class="nav-link" id="checklist-tab" data-toggle="tab" href="#checklist" role="tab" aria-controls="checklist" aria-selected="false">
                    <i class="fa-solid fa-list-check "></i>
                    <span class="d-none d-sm-inline">Checklist</span>

                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" id="informacoes-tab" data-toggle="tab" href="#informacoes" role="tab" aria-controls="informacoes" aria-selected="false">
                    <i class="fa-solid fa-circle-info"></i>
                    <span class="d-none d-sm-inline">Informações</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="false">
                    <i class="fa-regular fa-file-lines"></i>
                    <span class="d-none d-sm-inline">Log</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="balancete-tab" data-toggle="tab" href="#balancete" role="tab" aria-controls="balancete" aria-selected="false">
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
                @livewire('os.produto-tab', ['os' => $os])
            </div>
            <div class="tab-pane fade " id="servicos" role="tabpanel" aria-labelledby="servicos-tab">
                @livewire('os.servico-tab', ['os' => $os])
            </div>
            @if ($os->categoria->checklist_id)
            <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="checklist-tab">
                @livewire('os.checklist-tab', ['os' => $os])
            </div>
            @endif
            <div class="tab-pane fade" id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab">
                @livewire('os.informacoes-tab', ['os' => $os])
            </div>
            <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="log-tab">
                @livewire('os.log-tab', ['os' => $os])
            </div>
            <div class="tab-pane fade" id="balancete" role="tabpanel" aria-labelledby="balancete-tab">
                balancete
            </div>
        </div>
    </div>
</div>

@can('os_faturar')
<!-- Modal - FATURA  -->
<div class="modal fade" id="faturarModal" tabindex="-1" role="dialog" aria-labelledby="faturarModalLabel" aria-hidden="true">
    @livewire('os.faturar-modal', ['os' => $os], key($os->id))
</div>
<!-- FIM Modal - FATURA  -->
@endcan

@can('os_cancelar_faturar')
<!-- Modal - CANCELAR FATURA  -->
<div class="modal fade" id="cancelarFaturarModal" tabindex="-1" role="dialog" aria-labelledby="cancelarfaturarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! html()->form('delete', route('os.cancelar-faturar', $os->id))->open() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="faturarModalLabel">Cancelar Fatura OS: #{{ $os->id }}</h5>
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
@can('os_receita_pagamento_create')
<div class="modal fade" id="addPagamentoModal">
    @livewire('os.add-pagamento-modal', ['os' => $os], key($os->id))
</div>
@endcan
{{-- /Modal para criação de Pagamento de parcela --}}

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
            console.log(e.target.id);
        }
        if(tabId == 'balancete-tab'){
            console.log(e.target.id);
        }
    });
</script>
@stop
