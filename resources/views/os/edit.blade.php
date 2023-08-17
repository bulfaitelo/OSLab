@extends('adminlte::page')

@section('title', 'Editar Os')

@section('content_header')
    <h1>Editar Os</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-12 col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="detalhes-tab" data-toggle="pill" href="#detalhes" role="tab" aria-controls="detalhes" aria-selected="true">
                            <i class="fa-regular fa-rectangle-list "></i>
                            Detalhes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="produtos-tab" data-toggle="pill" href="#produtos" role="tab" aria-controls="produtos" aria-selected="false">
                            <i class="fas fa-box-open "></i>
                            Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="servicos-tab" data-toggle="pill" href="#servicos" role="tab" aria-controls="servicos" aria-selected="false">
                            <i class="fas fa-hand-holding-usd "></i>
                            Serviços
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="anexos-tab" data-toggle="pill" href="#anexos" role="tab" aria-controls="anexos" aria-selected="false">
                            <i class="fa-solid fa-paperclip"></i>
                            Anexos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="informacoes-tab" data-toggle="pill" href="#informacoes" role="tab" aria-controls="informacoes" aria-selected="false">
                            <i class="fa-solid fa-circle-info"></i>
                            Informações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="balancete-tab" data-toggle="pill" href="#balancete" role="tab" aria-controls="balancete" aria-selected="false">
                            <i class="fas fa-balance-scale"></i>
                            Balancete
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="detalhes" role="tabpanel" aria-labelledby="detalhes-tab">

                            <!-- general form elements -->

                              <!-- /.card-header -->
                              <!-- form start -->


                                @include('adminlte::partials.form-alert')
                                {!! html()->form('post', route('os.store'))->acceptsFiles()->open() !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cliente_id">Cliente</label>
                                            {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tecnico_id">Tecnico Responsavel </label>
                                            {!! html()->select('tecnico_id', [Auth()->id() => Auth()->user()->name], Auth()->id())->class('form-control user')->placeholder('Selecione')->required() !!}

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria</label>
                                            {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="modelos_id">Modelo</label>
                                            {!! html()->select('modelos_id', [], )->class('form-control modelo')->placeholder('Selecione') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_id">Status</label>
                                            {!! html()->select('status_id', \App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="data_entrada">Data Entrada</label>
                                            {!! html()->date('data_entrada', $os->data_entrada)->class('form-control') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="data_saida">Data Saída</label>
                                            {!! html()->date('data_saida', $os->data_saida)->class('form-control') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-5 d-flex align-items-end">
                                        <div class="form-group text-right">
                                            <a href="#">
                                                <button type="button"  class="btn bg-primary">
                                                    <i class="fa-solid fa-list-check"></i>
                                                    Wiki
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button type="button"  class="btn bg-primary">
                                                    <i class="fa-solid fa-book"></i>
                                                    Checklist
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descricao">Descrição</label>
                                            {!! html()->textarea('descricao')->class('texto')->placeholder('Status') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="defeito">Defeito</label>
                                            {!! html()->textarea('defeito')->class('texto')->placeholder('Status') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="observacoes">Observações</label>
                                            {!! html()->textarea('observacoes')->class('texto')->placeholder('Status') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="laudo">Laudo</label>
                                            {!! html()->textarea('laudo')->class('texto')->placeholder('Status') !!}
                                        </div>
                                    </div>
                                </div>

                              {{-- Minimal with icon only --}}
                              <!-- /.card-body -->

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>


                          {!! html()->form()->close() !!}

                    </div>
                    <div class="tab-pane fade" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                        produtos
                    </div>
                    <div class="tab-pane fade" id="servicos" role="tabpanel" aria-labelledby="servicos-tab">
                        servicos
                    </div>
                    <div class="tab-pane fade" id="anexos" role="tabpanel" aria-labelledby="anexos-tab">
                        anexos
                    </div>
                    <div class="tab-pane fade" id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab">
                        informacoes
                    </div>
                    <div class="tab-pane fade" id="balancete" role="tabpanel" aria-labelledby="balancete-tab">
                        balancete
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-12">
        <!-- general form elements -->
        <div class="card os">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn  btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.form-alert')
            {!! html()->form('post', route('os.store'))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cliente_id">Cliente</label>
                        {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tecnico_id">Tecnico Responsavel </label>
                        {!! html()->select('tecnico_id', [Auth()->id() => Auth()->user()->name], Auth()->id())->class('form-control user')->placeholder('Selecione')->required() !!}

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="modelos_id">Modelo</label>
                        {!! html()->select('modelos_id', [], )->class('form-control modelo')->placeholder('Selecione') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        {!! html()->select('status_id', \App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_entrada">Data Entrada</label>
                        {!! html()->date('data_entrada', $os->data_entrada)->class('form-control') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_saida">Data Saída</label>
                        {!! html()->date('data_saida', $os->data_saida)->class('form-control') !!}
                    </div>
                </div>
                <div class="col-md-5 d-flex align-items-end">
                    <div class="form-group text-right">
                        <a href="#">
                            <button type="button"  class="btn bg-primary">
                                <i class="fa-solid fa-list-check"></i>
                                Wiki
                            </button>
                        </a>
                        <a href="#">
                            <button type="button"  class="btn bg-primary">
                                <i class="fa-solid fa-book"></i>
                                Checklist
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        {!! html()->textarea('descricao')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="defeito">Defeito</label>
                        {!! html()->textarea('defeito')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        {!! html()->textarea('observacoes')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="laudo">Laudo</label>
                        {!! html()->textarea('laudo')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
            </div>
          </div>

          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
          </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}
    </div> --}}

</div>
@stop

@section('css')
<link href="{{ url('') }}/vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('') }}/vendor/select2/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
<style>
    .os {
        border-top: 3px solid #39cccc;
    }
</style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('') }}/vendor/select2/dist/js/i18n/pt-BR.js"></script>
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script src="{{ url('') }}/src/js/os.js"></script>

<script>
    $(document).ready(function() {
        $('.texto').summernote({
            lang: 'pt-BR',
            height: 300,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'clear'] ],
                // [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', ['link', 'picture',]],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    });
</script>
@stop
