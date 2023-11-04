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
                Voltar
            </button>
        </a>
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
</script>
@stop
