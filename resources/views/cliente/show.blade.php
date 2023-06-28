@extends('adminlte::page')

@section('title', 'Editando Clientes')

@section('content_header')
    <h1>Editando Clientes</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-11 ">
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
            <div class="row">
                <div class="col-md-4">
                    <label for="name">CPF / CNPJ</label>
                    <div class="input-group ">
                        {!! html()->text('registro', $cliente->registro)->class('form-control cpf_cnpj')->placeholder('Nome do usuário')->disabled() !!}
                    </div>
                    <i class="text-danger" id="msg_cpnj_error"></i>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Cliente</label>
                        {!! html()->text('name', $cliente->name)->class('form-control')->placeholder('Nome do Cliente')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      {!! html()->email('email', $cliente->email)->class('form-control')->placeholder('Email')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="celular">Celular </label>
                        {!! html()->text('celular', $cliente->celular)->class('form-control cel')->placeholder('Celular')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone', $cliente->telefone)->class('form-control tel')->placeholder('Telefone')->disabled() !!}
                    </div>
                </div>
            </div>
            <h4>Endereço:</h4>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Cep</label>
                        {!! html()->text('cep', $cliente->cep)->class('form-control cep')->placeholder('CEP')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Logradouro">Logradouro</label>
                        {!! html()->text('logradouro', $cliente->logradouro)->class('form-control')->placeholder('Logradouro')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        {!! html()->text('numero', $cliente->numero)->class('form-control')->placeholder('Número')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        {!! html()->text('bairro', $cliente->bairro)->class('form-control')->placeholder('Bairro')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        {!! html()->text('cidade', $cliente->cidade)->class('form-control')->placeholder('Cidade')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        {!! html()->text('estado', $cliente->estado)->class('form-control')->placeholder('Estado')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        {!! html()->text('complemento', $cliente->complemento)->class('form-control')->placeholder('Complemento')->disabled() !!}
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- MASCARA  --}}
    {{-- <script>
        $(document).ready(function(){
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 0000#-0000');
            $('.tel').mask('(00) 0000-0000');
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
    </script>     --}}
@stop
