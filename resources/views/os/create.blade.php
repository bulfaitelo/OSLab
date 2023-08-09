@extends('adminlte::page')

@section('title', 'Nova Os')

@section('content_header')
    <h1>Nova Os</h1>
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
            {!! html()->form('post', route('cliente.store'))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="cliente_id">Cliente</label>
                      {!! html()->text('cliente_id')->class('form-control')->placeholder('Cliente') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tecnico_id">Tecnico Responsavel </label>
                        {!! html()->text('tecnico_id')->class('form-control tel')->placeholder('Tecnico Responsavel') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        {!! html()->text('categoria_id')->class('form-control cep')->placeholder('Categoria de OS') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="categoria_id">Status</label>
                        {!! html()->text('categoria_id')->class('form-control cep')->placeholder('Categoria de OS') !!}
                    </div>
                </div>
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

@stop

@section('js')

@stop