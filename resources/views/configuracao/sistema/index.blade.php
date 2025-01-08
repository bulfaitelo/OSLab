{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Sistema')

@section('content_header')
    <h1><i class="fa-solid fa-sitemap"></i> Sistema </h1>
@stop

@section('content')
<div class="row justify-content-md-center">
    <div class="col-12 col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="os-tab" data-toggle="pill" href="#os" role="tab" aria-controls="os" aria-selected="false">
                            <i class="fa-regular fa-rectangle-list "></i>
                            <span class="d-none d-sm-inline">Ordem de Serviço</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="os-tab" data-toggle="pill" href="#vendas" role="tab" aria-controls="vendas" aria-selected="false">
                            <i class="fa-solid fa-store "></i>
                            <span class="d-none d-sm-inline">Vendas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="os-tab" data-toggle="pill" href="#backup" role="tab" aria-controls="backup" aria-selected="false">
                            <i class="fa-solid fa-server"></i>
                            <span class="d-none d-sm-inline">Backup</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="#geral-tab" data-toggle="pill" href="#geral" role="tab" aria-controls="geral" aria-selected="true">
                            <i class="fas fa-cogs "></i>
                            <span class="d-none d-sm-inline">Geral</span>
                        </a>
                    </li>
                </ul>
            </div>
            {!! html()->form('post', route('configuracao.sistema.store'))->open() !!}
            <div class="card-body">
                    @include('adminlte::partials.form-alert')
                    <div class="tab-content">
                        {{-- GERAL --}}
                        <div class="tab-pane fade" id="geral" role="tabpanel" aria-labelledby="geral-tab">
                            GERAL
                        </div>
                        {{-- OS --}}
                        <div class="tab-pane fade  active show" id="os" role="tabpanel" aria-labelledby="os-tab">
                            @include('configuracao.sistema.tabs.os-tab')
                        </div>
                        {{-- Vendas --}}
                        <div class="tab-pane fade  active show" id="vendas" role="tabpanel" aria-labelledby="venda-tab">
                            @include('configuracao.sistema.tabs.venda-tab')
                        </div>
                        {{-- BACKUP --}}
                        <div class="tab-pane fade" id="backup" role="tabpanel" aria-labelledby="os-tab">
                            @include('configuracao.sistema.tabs.backup-tab')
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                @can('config_sistema_edit')
                    <button type="submit" class="btn btn-sm btn-oslab">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                @endcan
            </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
@stop

@section('js')
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script>
    $(document).ready(function() {
        $('.textarea').summernote({
            lang: 'pt-BR', // default: 'en-US'
            height: 300,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'clear'] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph'] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    });
</script>

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
