@extends('adminlte::page')

@section('title', 'Editar Termo de Garantia')

@section('content_header')
    <h1><i class="fas fa-shield-alt "></i> Editar Termo de Garantia</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
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
                {!! html()->form('PUT', route('configuracao.garantia.update', $garantia->id))->open() !!}
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                        <label for="name">Nome da Garantia</label>
                        {!! html()->text('name', $garantia->name)->class('form-control')->placeholder('Nome da Garantia') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="prazo_garantia">Prazo de garantia</label>
                            <div class="input-group mb-3">
                                {!! html()->text('prazo_garantia', $garantia->prazo_garantia)->class('form-control code')->placeholder('Prazo de garantia') !!}
                                <div class="input-group-append">
                                <span class="input-group-text">Dias</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="os">OS</label>
                        <div class="custom-control custom-switch custom-switch-md">
                            {!! html()->checkbox('os', $garantia->os)->class('custom-control-input') !!}
                            <label class="custom-control-label" for="os"></label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="venda">Venda</label>
                        <div class="custom-control custom-switch custom-switch-md">
                            {!! html()->checkbox('venda', $garantia->venda)->class('custom-control-input') !!}
                            <label class="custom-control-label" for="venda"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="garantia">Termo de Garantia</label>
                    {!! html()->textarea('garantia', $garantia->garantia)->class('form-control')->placeholder('Descrição do Garantia') !!}
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
    $(document).ready(function() {
        $('#garantia').summernote({
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
</script>
<script>
    $(document).ready(function(){
        $('.code').mask('0#');
        $('.money').mask('#.##0,00', {reverse: true});
        $('.cpf').mask('000.000.000-00', {reverse: true});
    });
</script>
@stop
