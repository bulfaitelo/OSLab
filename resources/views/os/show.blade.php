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
            <div class="btn-group btn-group-sm">
                <a class="btn btn-sm bg-navy" title="Imprimir" href="{{ route('os.print', $os) }}" target="_blank">
                    <i class="fa-solid fa-print"></i>
                    <span class="d-none d-sm-inline">Imprimir</span>
                </a>
                <a class="btn btn-sm bg-maroon" title="Imprimir em PDF" href="{{ route('os.print_pdf', $os) }}"
                    target="_blank">
                    <i class="fa-regular fa-file-pdf"></i>
                    <span class="d-none d-sm-inline">PDF</span>
                </a>
            </div>
        @endcan
        <div class="btn-group btn-group-sm  float-right ">
            <a
                class="help_popover btn bg-lightblue btn-sm d-none d-sm-inline"
                onclick="copyToClipboard('{{ $os->modelo->wiki->fabricante->name }} {{ $os->modelo->wiki->name }} {{ $os->modelo->name }}')"
                target="#"
                data-container="body"
                data-toggle="popover"
                data-placement="right"
                data-content="Clique e copie para área de transferência"
                data-original-title=""
            >
                <span class="d-none d-sm-inline"><b>[ {{ $os->modelo->wiki->fabricante->name }} ]
                        {{ $os->modelo->wiki->name }}</b></span>
            </a>
            @can('wiki_show')
                @if ($os->modelo_id)
                    <a target="_blank" href="{{route('wiki.show', $os->modelo->wiki->id)}}" class="btn bg-primary btn-sm">
                        <i class="fa-solid fa-book"></i>
                        <span class="d-none d-sm-inline">Wiki</span>
                    </a>
                @endif
            @endcan
        </div>

    </div>
    <div class="card-body pt-2">
        @include('os.screen.print-content')
        @yield('os-print-content')
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="{{ url('') }}/vendor/patternlock/patternlock.css">
<style>
    .icon {
        width: 3rem;
    }

    .item {
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
<script>
    function copyToClipboard(text) {
        // Cria um elemento de texto temporário
        let tempInput = document.createElement("textarea");
        tempInput.value = text;
        document.body.appendChild(tempInput);

        // Seleciona e copia o texto
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
    }
</script>
@stop
