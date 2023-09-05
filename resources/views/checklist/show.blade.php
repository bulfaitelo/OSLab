@extends('adminlte::page')

@section('title', 'Visualizar Checklist')

@section('content_header')
    <h1><i class="fa-solid fa-list-check "></i> Visualizar Checklist</h1>
@stop

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
                <input type="hidden" name="checklist" id="checklist">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            {!! html()->text('checklist_name', $checklist->name)->class('form-control')->placeholder('Nome do Checklist')->disabled() !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="categoria_id">Categoria</label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), $checklist->categoria_id)->class('form-control')->placeholder('Selecione')->disabled() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->text('descricao', $checklist->descricao)->class('form-control')->placeholder('Descrição do Checklist')->disabled() !!}
                </div>
            </div>
            <div class="col-md-12">
                <h3>Checklist</h3>
                <div id="fb-render"></div>
            </div>


          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->

        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}
      </div>
</div>
@stop

@section('css')
@stop

@section('js')

<script src="{{ url('') }}/vendor/form-builder/form-render.min.js"></script>

<script>

$(document).ready(function() {
    var fbRender = document.getElementById('fb-render');
    var formData = '{!! $checklist->checklist !!}';

    var formRenderOpts = {
        formData,
        dataType: 'json',
        i18n: {
            locale: 'pt-BR',
            location: '/vendor/form-builder/'
        },
    };

   var fData = $(fbRender).formRender(formRenderOpts);
//    console.log(fData.userData); // retorna o formulário preenchido e formatado.
});




</script>

@stop
