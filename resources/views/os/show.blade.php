@extends('adminlte::page')

@section('title', 'Dados da Ordem de Serviço')

@section('content_header')
    <h1><i class="fa-regular fa-rectangle-list "></i> Dados da Ordem de Serviço</h1>
@stop

@section('content')

<div class="card card-primary card-outline">
    <div class="card-header border-0 pb-0">
        <a href="{{ url()->previous() }}">
            <button type="button" title="Voltar" class="btn btn-sm btn-default">
                <i class="fa-solid fa-chevron-left"></i>
                Voltar
            </button>
        </a>
        @can('os_edit')
        <a href="{{ route('os.edit', $os) }}">
            <button type="button" title="Editar" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                Editar
            </button>
        </a>
        @endcan
        @can('os_print')
        <a href="{{ route('os.edit', $os) }}">
            <button type="button" title="Imprimir" class="btn btn-sm bg-navy">
                <i class="fa-solid fa-print"></i>
                Imprimir
            </button>
        </a>
        @endcan

    </div>
    <div class="card-body pt-2">

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
