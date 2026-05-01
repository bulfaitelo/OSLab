@extends('adminlte::page')

@section('title', 'Criar Categoria')

@section('content_header')
<h1><i class="fas fa-clipboard-list "></i> Criar Categoria</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
            </div>

            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
                @include('adminlte::partials.form-alert')
                {!! html()->form('post', route('configuracao.parametro.categoria.store'))->open() !!}
                <div class="form-group">
                    <label for="name">Categoria</label>
                    {!! html()->text('name')->class('form-control')->placeholder('Categoria')->required() !!}
                </div>
                <div class="form-group">
                    <label for="descricao_categoria">Descrição Categoria</label>
                    {!! html()->text('descricao_categoria')->class('form-control')->placeholder('Descrição') !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="garantia_id">Garantia</label>
                            {!! html()->select('garantia_id', \App\Models\Configuracao\Garantia\Garantia::where('os', 1)->orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="centro_custo_id">Centro de Custo padrão</label>
                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('receita', '1')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione o Centro de Custo')->required() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checklist_id">Checklist</label>
                            {!! html()->select('checklist_id', \App\Models\Checklist\Checklist::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checklist_required">
                                Obrigatório
                                <i data-container="body" data-toggle="popover" data-placement="top"
                                    data-content="Torna Obrigatório o preenchimento do checklist para poder faturar uma OS"
                                    class="data_info fas fa-exclamation-circle"></i>
                            </label>
                            <div class="custom-control custom-switch custom-switch-md">
                                <input type="checkbox" name="checklist_required" @checked(old('checklist_required') == 1)
                                    value="1" id="checklist_required" class="custom-control-input"
                                    onclick="alternaPagoAvista()">
                                <label class="custom-control-label" for="checklist_required"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>Informações padrão para preenchimento de OS</h3>
                    <h5>Essas informações serão utilizadas como padrão para preenchimento das OSs desta categoria</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                {!! html()->textarea('descricao')->class('texto')->placeholder('Descrição padrão para esta categoria') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="defeito">Defeito</label>
                                {!! html()->textarea('defeito')->class('texto')->placeholder('Defeito padrão para esta categoria') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                {!! html()->textarea('observacao')->class('texto')->placeholder('Observação padrão para esta categoria') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="laudo">Laudo</label>
                                {!! html()->textarea('laudo')->class('texto')->placeholder('Laudo padrão para esta categoria') !!}
                            </div>
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
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
@stop

@section('js')
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script>
    $(document).ready(function () {
        $('.texto').summernote({
            lang: 'pt-BR',
            height: 300,
            toolbar: [
                ['font', ['bold', 'italic', 'clear']],
                ['para', ['ol', 'ul', 'paragraph',]],
                ['table', ['table']],
                ['insert', ['link', 'picture',]],
                ['view', ['undo', 'redo', 'codeview', 'fullscreen', 'help']]
            ]
        });
        $('.data_info').popover({
            trigger: 'hover'
        });
    });
</script>
@stop
