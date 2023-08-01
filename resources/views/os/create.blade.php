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
                      <label for="email">Email</label>
                      {!! html()->email('email')->class('form-control')->placeholder('Email') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="celular">Celular </label>
                        {!! html()->text('celular')->class('form-control cel')->placeholder('Celular') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone')->class('form-control tel')->placeholder('Telefone') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Senha </label>
                        {!! html()->password('password')->class('form-control')->placeholder('Senha')  !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Repita a Senha</label>
                        {!! html()->password('password_confirmation')->class('form-control')->placeholder('Repita a Senha')  !!}
                    </div>
                </div>
            </div>
            <h4>Endereço:</h4>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Cep</label>
                        {!! html()->text('cep')->class('form-control cep')->placeholder('CEP') !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Logradouro">Logradouro</label>
                        {!! html()->text('logradouro')->class('form-control')->placeholder('Logradouro') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        {!! html()->text('numero')->class('form-control')->placeholder('Número') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        {!! html()->text('bairro')->class('form-control')->placeholder('Bairro') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        {!! html()->text('cidade')->class('form-control')->placeholder('Cidade') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        {!! html()->text('estado')->class('form-control')->placeholder('Estado') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        {!! html()->text('complemento')->class('form-control')->placeholder('Complemento') !!}
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
