@extends('adminlte::page')

@section('title', 'Cadastro Cliente')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Cadastro Cliente</h1>
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
            {!! html()->form('post', route('cliente.store'))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-4">
                    <label for="registro">CPF / CNPJ</label>
                    <div class="input-group ">
                        {!! html()->text('registro')->class('form-control cpf_cnpj')->placeholder('CPF ou CNPJ') !!}
                        <span class="input-group-append">
                            <button disabled type="button" id="busca_registro" class="btn btn-info">Buscar CNPJ</button>
                        </span>
                    </div>
                    <i class="text-danger" id="msg_cpnj_error"></i>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Cliente</label>
                        {!! html()->text('name')->class('form-control')->placeholder('Nome do Cliente')->required() !!}
                    </div>
                </div>
            </div>
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
                        {!! html()->text('celular')->class('form-control telefone')->attributes(['inputmode' => 'numeric'])->placeholder('Celular') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone')->class('form-control telefone')->attributes(['inputmode' => 'numeric'])->placeholder('Telefone') !!}
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
                        <label for="cep">CEP</label>
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
                        <label for="uf">Estado</label>
                        {!! html()->text('uf')->class('form-control')->placeholder('Estado') !!}
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- MASCARA  --}}
    <script>
        $(document).ready(function(){
            // var options = {
            //     onKeyPress: function (cpf, ev, el, op) {
            //         var masks = ['000.000.000-000', '00.000.000/0000-00'];
            //         $('.cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            //     }
            // }
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 0000#-0000');
            $('.tel').mask('(00) 0000-0000');
            // $('.cpf_cnpj').length > 11 ? $('').mask('00.000.000/0000-00', options) : $('.cpf_cnpj').mask('000.000.000-00#', options);
            var CpfCnpjMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
                    },
                cpfCnpjpOptions = {
                    onKeyPress: function(val, e, field, options) {
                    field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
                }
                };

            $(function() {
                $(':input[name=registro]').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
            })
        });
    </script>
    <script src="{{ asset('src/js/cnpj.js') }}"></script>
@stop
