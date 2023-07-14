@extends('adminlte::page')

@section('title', 'Cadastrar Wiki')

@section('content_header')
    <h1>Cadastrar Wiki</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
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
            {{-- {!! html()->form('post', route('checklist.store'))->acceptsFiles()->open() !!} --}}
            <form action="{{ route('checklist.update', $checklist->id) }}" id="formChecklist" method="post">
                @method('put')
                @csrf
                <input type="hidden" name="checklist" id="checklist">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            {!! html()->text('checklist_name', $checklist->name)->class('form-control')->placeholder('Nome do Checklist')->required() !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="categoria_id">Categoria</label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), $checklist->categoria_id)->class('form-control')->placeholder('Selecione') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->text('descricao', $checklist->descricao)->class('form-control')->placeholder('Descrição do Checklist') !!}
                </div>
            </div>
            <div class="col-md-12">
                <h3>Checklist</h3>
                <div id="fb-editor"></div>
            </div>


          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" id="salvechecklist" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
            <button type="button" id="clear-all-fields" class="btn btn-danger">
                <i class="fa-solid fa-broom"></i>
                Limpar
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
{{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
    @routes

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(document).ready(function () {
    var options = {
      i18n: {
        locale: 'pt-BR',
        location: '/vendor/form-builder/'
      },
      disabledActionButtons: ['data', 'save', 'clear'],
      formData: '{!! $checklist->checklist !!}',
      disableFields: [
        'autocomplete',
        'button',
        'date',
        'file',
        'hidden',
      ],
      controlOrder: [
        'header',
        'paragraph',
        'text',
        'number',
        'textarea'
      ]
    },
    $fbTemplate = $(document.getElementById('fb-editor'));
    $form = $fbTemplate.formBuilder(options);

    document.getElementById('clear-all-fields').onclick = function() {
        $form.actions.clearFields();
    };

});


$(document).ready(function() {
  $('#formChecklist').submit(function(event) {
    event.preventDefault(); // Impede o comportamento padrão de envio do formulário
    var checklist = $form.actions.save();


    var objetoSerializado = JSON.stringify(checklist);
    $('#checklist').val(objetoSerializado);

    this.submit(); // Envie o formulário
  });
});

</script>

@stop
