@extends('adminlte::page')

@section('title', 'Editar Emitente')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Editar Emitente</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-11 ">
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
            {!! html()->form('put', route('configuracao.emitente.update', $emitente))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-4">
                    <label for="registro">CNPJ</label>
                    <div class="input-group ">
                        {!! html()->text('registro', $emitente->cnpj)->class('form-control cnpj')->placeholder('CNPJ') !!}
                        <span class="input-group-append">
                            <button type="button" id="busca_registro" class="btn btn-info">Buscar</button>
                        </span>
                    </div>
                    <i class="text-danger" id="msg_cpnj_error"></i>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Razão Social</label>
                        {!! html()->text('name', $emitente->name)->class('form-control')->placeholder('Razão Social')->required() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fantasia">Nome Fantasia</label>
                        {!! html()->text('fantasia', $emitente->fantasia)->class('form-control')->placeholder('Nome Fantasia') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="inscricao_estadual">Inscrição Estadual</label>
                        {!! html()->text('inscricao_estadual', $emitente->inscricao_estadual)->class('form-control')->placeholder('Inscrição Estadual') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="porte">Porte</label>
                        {!! html()->text('porte', $emitente->porte)->class('form-control')->placeholder('Porte, por exemplo MEI MICRO...') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">Email</label>
                      {!! html()->email('email', $emitente->email)->class('form-control')->placeholder('Email') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone', $emitente->telefone)->class('form-control tel')->placeholder('Telefone') !!}
                    </div>
                </div>
            </div>
            <h4>Endereço:</h4>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        {!! html()->text('cep', $emitente->cep)->class('form-control cep')->placeholder('CEP') !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Logradouro">Logradouro</label>
                        {!! html()->text('logradouro', $emitente->logradouro)->class('form-control')->placeholder('Logradouro') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        {!! html()->text('numero', $emitente->numero)->class('form-control')->placeholder('Número') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        {!! html()->text('bairro', $emitente->bairro)->class('form-control')->placeholder('Bairro') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        {!! html()->text('cidade', $emitente->cidade)->class('form-control')->placeholder('Cidade') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="uf">Estado</label>
                        {!! html()->text('uf', $emitente->uf)->class('form-control')->placeholder('Estado') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        {!! html()->text('complemento', $emitente->complemento)->class('form-control')->placeholder('Complemento') !!}
                    </div>
                </div>
            </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
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
        $(document).ready(function(){
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 0000#-0000');
            $('.tel').mask('(00) 0000-0000');
            $('.cnpj').mask('00.000.000/0000-00');
        });
    </script>
    <script src="{{ asset('src/js/cnpj.js') }}"></script>
@stop
