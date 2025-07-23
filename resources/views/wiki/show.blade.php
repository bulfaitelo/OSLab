{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Wiki - '. $wiki->name)

@section('content_header')
    <h1><i class="fa-solid fa-book "></i> <b>[{{ $wiki->fabricante->name }}]</b> -  {{ $wiki->name}} </h1>
    <h6>
        <a href="{{ route('configuracao.wiki.modelo.create', ['wiki_id' => $wiki]) }}" target="_blank" rel="noopener noreferrer">
            <button
                type="button"
                class="btn btn-primary btn-sm pop_info pt-0 pb-0 pr-1 pl-1"
                title=""
                data-original-title="Adicionar novo Modelo">
                <i class="fas fa-plus-square"></i>
            </button>
        </a>
        {{ $wiki->modelosTitle() }}
    </h6>
@stop
{{-- Texto de ajuda --}}
{{-- @section('content_header_help_content', 'Utilize os campos a seguir para cadastrar as informações de um dispositivo. Esses dados auxiliam em novos atendimentos.') --}}
{{-- Titulo (Opcional)--}}
{{-- @section('content_header_help_title', 'titulo') --}}

@section('content')
<div class="row">
    {{-- WIKI --}}
    <div class="col-md-9">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><b>Wiki</b></h3>
                    <div id="notification-container" style="position: fixed; top: 80px; right: 20px; z-index: 9999; width: 350px;">

                    </div>
                    @can('wiki_edit')
                    {{-- <a href="{{ route('wiki.edit', $wiki->id) }}" title="Editar" >
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </button>
                    </a> --}}
                    <button id="edit_wiki" class="btn btn-primary btn-sm" onclick="editWiki()" type="button">
                        <i class="fas fa-edit"></i>
                        Editar
                    </button>
                    <button style="display: none" id="save_wiki" class="btn btn-primary btn-sm" onclick="saveWiki()" type="button">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div id="texto_wiki" class="texto_wiki">{!! $wiki->texto !!}</div>
            </div>
        </div>
    </div>
    {{-- Fim - Wiki --}}
    {{-- Links e arquivos --}}
    <div class="col-md-3">
        <div class="row">
            {{-- Links --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="p-2 card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><b>Links</b></h3>
                            {{-- <button type="button" class="btn btn-primary btn-sm pop_info" data-toggle="popover" data-placement="left" data-content="Adicionar Link"><i class="fas fa-plus-square"></i></button> --}}
                            @can('wiki_link_create')
                                <button type="button" class="btn btn-primary btn-sm pop_info" data-toggle="modal" data-target="#modal-link" title="Adicionar Link"><i class="fas fa-plus-square"></i></button>
                                <div class="modal fade" id="modal-link">
                                    <div class="modal-dialog">
                                        <div class="modal-content">



                                            {{-- {!! html()->form('post',route('wiki.link.create', $wiki))->open() !!} --}}
                                            <form action="{{ route('wiki.link.create', $wiki) }}" id="linkForm" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Adicionar Novo Link</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('adminlte::partials.form-alert')
                                                    <div class="form-group">
                                                        <label for="name_link">Nome</label>
                                                        {!! html()->text('name_link')->class('form-control')->placeholder('Descrição do link (opcional)') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="link">Link</label>
                                                        {!! html()->text('link')->class('form-control')->placeholder('Link')->required() !!}
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        <i class="fas fa-times"></i>
                                                        Fechar
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i>
                                                        Salvar
                                                    </button>
                                                </div>
                                            {!! html()->form()->close() !!}
                                        </div>

                                    </div>

                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table id="table_link" class="table table-sm lateral_table ">
                            <tbody>
                                @forelse ($wiki->links as $item)
                                <tr>
                                    <td class="p-2 text-truncate" >
                                        <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer">
                                            @if (strlen($item->name) > 0)
                                                <b>{{ $item->name }}</b>
                                            @else
                                                {{ $item->link }}
                                            @endif
                                        </a>
                                    </td>
                                    <td class="text-right" style="width: 40px" >
                                        @can('wiki_link_destroy')
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                    @can('wiki_link_destroy')
                                        <div class="modal fade" id="modal-excluir_{{ $item->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Realmente deseja Excluir?</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p><b>Nome:</b>
                                                        @if (strlen($item->name) > 0)
                                                            {{ $item->name }}
                                                        @else
                                                            {{ $item->link }}
                                                        @endif
                                                    </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        {!! html()->form('delete', route('wiki.link.destroy', [$wiki->id, $item->id]))->open() !!}
                                                            <input type="submit" class="btn btn-danger delete-permission" value="Excluir Wiki">
                                                        {!! html()->form()->close() !!}

                                                    </div>
                                                </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endcan
                                </tr>

                                @empty

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Fim Links --}}
            {{-- ARQUIVOS --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="p-2 card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><b>Arquivos</b></h3>
                            {{-- <button type="button" class="btn btn-primary btn-sm pop_info" data-toggle="popover" data-placement="left" data-content="Adicionar Link"><i class="fas fa-plus-square"></i></button> --}}
                            @can('wiki_file_create')
                                <button type="button" class="btn btn-primary btn-sm pop_info" data-toggle="modal" data-target="#modal-file" title="Adicionar Arquivo"><i class="fas fa-plus-square"></i></button>
                                <div class="modal fade" id="modal-file">
                                    <div class="modal-dialog">
                                        <div class="modal-content">



                                            {{-- {!! html()->form('post',route('wiki.file.create', $wiki))->open() !!} --}}
                                            <form action="{{ route('wiki.file.create', $wiki) }}" id="fileForm" enctype="multipart/form-data"  method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Adicionar Novo Arquivo</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('adminlte::partials.form-alert')
                                                    <div class="form-group">
                                                        <label for="name_file">Nome</label>
                                                        {!! html()->text('name_file')->class('form-control')->placeholder('Descrição do arquivo (opcional)') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="arquivo_import">Arquivo</label>
                                                        <div class="custom-file">
                                                            <input class="custom-file-input" id="arquivo_import" accept=".zip, .bin, .rar, .pdf" name="arquivo_import" type="file">
                                                            <label class="custom-file-label" for="arquivo">Coloque aqui o arquivo</label>
                                                            <i>Extenções permitidas: .zip, .bin, .rar, .pdf</i>
                                                            <br>
                                                            <i>Tamanho maximo permitido 20mb</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        <i class="fas fa-times"></i>
                                                        Fechar
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i>
                                                        Salvar
                                                    </button>
                                                </div>
                                            {!! html()->form()->close() !!}
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table id="table_file" class="table table-sm lateral_table ">
                            <tbody>
                                @forelse ($wiki->files as $item)
                                <tr>
                                    <td class="p-2 text-truncate" >
                                        <a href="{{ $item->url() }}" target="_blank" >
                                            @if (strlen($item->name) > 0)
                                                <b>{{ $item->name }}</b>
                                            @else
                                                {{ $item->file_name }}
                                            @endif
                                        </a>
                                    </td>
                                    <td class="text-right" style="width: 40px" >
                                        @can('wiki_file_destroy')
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                    @can('wiki_file_destroy')
                                        <div class="modal fade" id="modal-excluir_{{ $item->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Realmente deseja Excluir?</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p><b>Nome:</b>
                                                        @if (strlen($item->name) > 0)
                                                            {{ $item->name }}
                                                        @else
                                                            {{ $item->link }}
                                                        @endif
                                                    </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        {!! html()->form('delete', route('wiki.file.destroy', [$wiki->id, $item->id]))->open() !!}
                                                            <input type="submit" class="btn btn-danger delete-permission" value="Excluir Wiki">
                                                        {!! html()->form()->close() !!}

                                                    </div>
                                                </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endcan
                                </tr>

                                @empty

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Fim ARQUIVOS --}}
        </div>
    </div>
    {{-- Fim - Links e arquivos --}}

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><b>OS</b></h3>
                    <h3 class="card-title">Total: {{ $wiki->os->count() }}</h3>
                </div>
            </div>
            <div class="card-body pt-2 table-responsive">
            @include('os.partials.os-table', ['osTable' => $wiki->os,  'show'=> true])
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
    <style>
        .lateral_table {
            table-layout: fixed
        }
    </style>

@stop
@section('js')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @routes

    <script src="{{ url('') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ url('') }}/vendor/jquery-validation/additional-methods.min.js"></script>

    {{-- summernote --}}
    <script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
    <script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
    {{-- summernote --}}
    <script src="/vendor/flasher/flasher.min.js"></script>

    <script>
        $('.pop_info').popover({
        trigger: 'hover'
        });
    </script>
    <script src="{{ url('') }}/vendor/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('src/js/wiki.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>

@stop
@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
