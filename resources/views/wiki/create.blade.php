@extends('adminlte::page')

@section('title', 'Cadastrar Wiki')

@section('content_header')
    <h1 class="d-inline"><i class="fa-solid fa-book "></i> Cadastrar Wiki</h1>
@stop
{{-- Texto de ajuda --}}
@section('content_header_help_content', 'Utilize os campos a seguir para cadastrar as informações de um dispositivo. Esses dados auxiliam em novos atendimentos.')
{{-- Titulo (Opcional)--}}
{{-- @section('content_header_help_title', 'titulo') --}}

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-12">
        <!-- general form elements -->
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
            <!-- form start -->
            <div class="card-body">
                @include('adminlte::partials.form-alert')
                {!! html()->form('post', route('wiki.store'))->acceptsFiles()->open() !!}
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fabricante_id">Fabricante <span class="required-span" title="Este campo é obrigatório">*</span></label>
                            <div class="input-group mb-3">
                                {!! html()->select('fabricante_id', \App\Models\Configuracao\Wiki\Fabricante::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                                @can('config_wiki_fabricante_create')
                                    <span class="input-group-append">
                                        <a href="{{ route('configuracao.wiki.fabricante.create') }}" target="_blank" >
                                            <button type="button" class="btn btn-primary">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </a>
                                    </span>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nome do Dispositivo</label>
                            {!! html()->text('name')->class('form-control')->placeholder('Ex. Galaxy A52, Dell Inspiron 5548.')->required() !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="modelo">Modelo do Dispositivo</label>
                            {!! html()->text('modelo')->class('form-control')->placeholder('Ex.: SM-A525M, P39F.')->required() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="categoria_id">Categoria</label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Os\OsCategoria::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Minimal with icon only --}}
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-oslab">
                    <i class="fas fa-save"></i>
                    Salvar
                </button>
            </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}
      </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css"> --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
    <script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                lang: 'pt-BR', // default: 'en-US'
                height: 300,
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                    [ 'fontname', [ 'fontname' ] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'link'] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                ]
            });
        });
    </script> --}}
@stop
