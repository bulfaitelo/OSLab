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
            {!! html()->form('post', route('wiki.store'))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="name">Fabricante</label>
                        {!! html()->text('name')->class('form-control')->placeholder('Nome do dispositivo')->required() !!}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        {!! html()->text('name')->class('form-control')->placeholder('Nome do dispositivo')->required() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Modelo</label>
                        {!! html()->text('name')->class('form-control')->placeholder('Modelo do Dispositivo')->required() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="descricao">Categoria</label>
                        {!! html()->text('descricao')->class('form-control')->placeholder('descrição do serviço (opcional)') !!}
                    </div>

                </div>
            </div>
            <div class="row">

            </div>





          </div>
          {{-- Minimal with icon only --}}
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
      </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
@stop
