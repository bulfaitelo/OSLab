@extends('adminlte::page')

@section('title', 'Visualizar Categoria')

@section('content_header')
<h1><i class="fas fa-clipboard-list "></i> Visualizar Categoria</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button" title="Voltar" class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="d-none d-sm-inline">Voltar</span>
                    </button>
                </a>
            </div>

            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Categoria</label>
                    {!! html()->text('name', $categoria->name)->class('form-control')->placeholder('Categoria')->disabled() !!}
                </div>
                <div class="form-group">
                    <label for="descricao_categoria">Descrição Categoria</label>
                    {!! html()->text('descricao_categoria', $categoria->descricao_categoria)->class('form-control')->placeholder('Descrição')->disabled() !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="garantia_id">Garantia</label>
                            {!! html()->select('garantia_id', \App\Models\Configuracao\Garantia\Garantia::orderBy('name')->pluck('name', 'id'), $categoria->garantia_id)->class('form-control')->placeholder('Selecione')->disabled() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="centro_custo_id">Centro de Custo padrão</label>
                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('receita', '1')->pluck('name', 'id'), $categoria->centro_custo_id)->class('form-control')->placeholder('Selecione o Centro de Custo')->required()->disabled() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checklist_id">Checklist</label>
                            {!! html()->select('checklist_id', \App\Models\Checklist\Checklist::orderBy('name')->pluck('name', 'id'), $categoria->checklist_id)->class('form-control')->placeholder('Selecione')->disabled() !!}
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
                                <input type="checkbox" name="checklist_required" @checked((old('checklist_required') == 1) || ($categoria->checklist_required)) value="1" id="checklist_required"
                                    class="custom-control-input" @disabled(true)>
                                <label class="custom-control-label" for="checklist_required"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>Informações padrão para o preenchimento de OS</h3>
                    <h5>Essas informações serão utilizadas como padrão para preenchimento das OSs desta categoria</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                {!! html()->textarea('descricao', $categoria->descricao)->class('texto')->placeholder('Descrição padrão para esta categoria')->disabled() !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="defeito">Defeito</label>
                                {!! html()->textarea('defeito', $categoria->defeito)->class('texto')->placeholder('Defeito padrão para esta categoria')->disabled() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                {!! html()->textarea('observacao', $categoria->observacao)->class('texto')->placeholder('Observação padrão para esta categoria')->disabled() !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="laudo">Laudo</label>
                                {!! html()->textarea('laudo', $categoria->laudo)->class('texto')->placeholder('Laudo padrão para esta categoria')->disabled() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Minimal with icon only --}}
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
@stop

@section('js')
<script>
    $('.data_info').popover({
        trigger: 'hover'
    });
</script>
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
