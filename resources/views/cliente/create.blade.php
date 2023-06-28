@extends('adminlte::page')

@section('title', 'Criando Clientes')

@section('content_header')
    <h1>Criando Clientes</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-11 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <div class="row"></div>
                  <a href="{{ url()->previous() }}">
                      <button type="button"  class="btn  btn-default"> Voltar</button>
                  </a>
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.form-alert')
            {!! html()->form('post', route('cliente.store'))->acceptsFiles()->open() !!}

            <div class="row">
                <div class="col-md-4">
                    <label for="name">CPF / CNPJ</label>
                    <div class="input-group ">
                        {!! html()->text('registro')->class('form-control cpf_cnpj')->placeholder('Nome do usuário') !!}
                        <span class="input-group-append">
                            <button type="button" id="busca_cnpj" class="btn btn-info">Buscar CNPJ</button>
                        </span>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="name">Cliente</label>
                        {!! html()->text('name')->class('form-control')->placeholder('Nome do usuário')->required() !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              {!! html()->email('email')->class('form-control')->placeholder('Email')->required() !!}
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="celular">Celular </label>
                        {!! html()->text('celular')->class('form-control cel')->placeholder('Celular') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone')->class('form-control tel')->placeholder('Telefone') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="setor_id">Setor</label>
                        {!! html()->select('setor_id', \App\Models\Configuracao\User\Setor::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Senha </label>
                        {!! html()->password('password')->class('form-control')->placeholder('Senha')->required()  !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Repita a Senha</label>
                        {!! html()->password('password_confirmation')->class('form-control')->placeholder('Repita a Senha')->required()  !!}
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
            @can('config_users_permissions_edit')
                <h4>Configurações de permissões e acesso:</h4>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="departamento">Perfis: </label>
                            @foreach (\Spatie\Permission\Models\Role::orderBy('name')->get() as $id => $item)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="item_{{$item->id}}" name="role[]" value="{{$item->id}}">
                                    <label for="item_{{$item->id}}" class="custom-control-label">{{$item->name}}</label> <i> ({{ $item->description }})</i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="expire_at">Validade do acesso</label>
                            {!! html()->date('expire_at')->class('form-control')->placeholder('Validade do acesso, define a data limite de uso do sistema') !!}
                        </div>
                    </div>
                </div>
            @endcan
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
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
            var options = {
                onKeyPress: function (cpf, ev, el, op) {
                    var masks = ['000.000.000-000', '00.000.000/0000-00'];
                    $('.cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
                }
            }
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 0000#-0000');
            $('.tel').mask('(00) 0000-0000');
            $('.cpf_cnpj').length > 11 ? $('').mask('00.000.000/0000-00', options) : $('.cpf_cnpj').mask('000.000.000-00#', options);
        });
    </script>
    {{-- Busca CNPJ --}}
    <script>
        //
        $(document).ready(function() {
          $('#busca_cnpj').click(function() {
            var cnpj = $('#registro').val().replace(/\D/g, '');

            // if (validateCNPJ(cnpj)){
                if (validateCNPJ(cnpj)) {
                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#name").val("...");
                    $("#email").val("...");
                    $("#cep").val("...");
                    $("#logradouro").val("...");
                    $("#numero").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");
                    $("#complemento").val("...");
                    $("#telefone").val("...");
                    //Consulta o webservice receitaws.com.br/
                    $.ajax({
                        url: "https://www.receitaws.com.br/v1/cnpj/" + cnpj,
                        dataType: 'jsonp',
                        crossDomain: true,
                        contentType: "text/javascript",
                        success: function (dados) {

                            if (dados.status == "OK") {
                                //Atualiza os campos com os valores da consulta.
                                if ($("#name").val() != null) {
                                    $("#name").val(capital_letter(dados.nome));
                                }
                                if ($("#nomeEmitente").val() != null) {
                                    $("#nomeEmitente").val(capital_letter(dados.nome));
                                }
                                $("#cep").val(dados.cep.replace(/\./g, ''));
                                $("#email").val(dados.email.toLocaleLowerCase());
                                $("#telefone").val(dados.telefone.split("/")[0].replace(/\ /g, ''));
                                $("#logradouro").val(capital_letter(dados.logradouro));
                                $("#numero").val(dados.numero);
                                $("#bairro").val(capital_letter(dados.bairro));
                                $("#cidade").val(capital_letter(dados.municipio));
                                $("#estado").val(dados.uf);
                                if (dados.complemento != "") {
                                    $("#complemento").val(capital_letter(dados.complemento));
                                } else{
                                    $("#complemento").val("");
                                }

                                // Força uma atualizacao do endereco via cep
                                //document.getElementById("cep").focus();
                                if ($("#name").val() != null) {
                                    document.getElementById("name").focus();
                                }
                                if ($("#nomeEmitente").val() != null) {
                                    document.getElementById("nomeEmitente").focus();
                                }
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                if ($("#name").val() != null) {
                                    $("#name").val("");
                                }
                                if ($("#nomeEmitente").val() != null) {
                                    $("#nomeEmitente").val("");
                                }
                                $("#cep").val("");
                                $("#email").val("");
                                $("#numero").val("");
                                $("#complemento").val("");
                                $("#telefone").val("");

                                Swal.fire({
                                    type: "warning",
                                    title: "Atenção",
                                    text: "CNPJ não encontrado."
                                });
                            }
                        },
                        error: function () {
                            ///CEP pesquisado não foi encontrado.
                            if ($("#name").val() != null) {
                                $("#name").val("");
                            }
                            if ($("#nomeEmitente").val() != null) {
                                $("#nomeEmitente").val("");
                            }
                            $("#cep").val("");
                            $("#email").val("");
                            $("#numero").val("");
                            $("#complemento").val("");
                            $("#telefone").val("");

                            Swal.fire({
                                type: "warning",
                                title: "Atenção",
                                text: "CNPJ não encontrado."
                            });
                        },
                        timeout: 2000,
                    });
                } else {

                }




        });

        function capital_letter(str) {
            if (typeof str === 'undefined') { return; }
            str = str.toLocaleLowerCase().split(" ");

            for (var i = 0, x = str.length; i < x; i++) {
                str[i] = str[i][0].toUpperCase() + str[i].substr(1);
            }

            return str.join(" ");
        }
        function validateCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

            if (cnpj.length !== 14) {
                return false;
            }

            // Verifica se todos os dígitos são iguais
            if (/^(\d)\1+$/.test(cnpj)) {
                return false;
            }

            // Calcula os dígitos verificadores
            var tamanho = cnpj.length - 2;
            var numeros = cnpj.substring(0, tamanho);
            var digitos = cnpj.substring(tamanho);
            var soma = 0;
            var pos = tamanho - 7;
            for (var i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) {
                pos = 9;
                }
            }
            var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0)) {
                return false;
            }

            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (var i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) {
                pos = 9;
                }
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1)) {
                return false;
            }

            return true;
            }
        });
    </script>
    {{-- BUSCA CEP --}}
    <script>
        $(document).ready(function() {
          $('#cep').blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep.length == 8) {
              $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                if (!("erro" in data)) {
                  $('#logradouro').val(data.logradouro);
                  $('#bairro').val(data.bairro);
                  $('#cidade').val(data.localidade);
                  $('#estado').val(data.uf);
                  $('#cep').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                  $('#numero').focus();
                } else {
                    $('#cep').removeClass('is-valid').removeClass('is-invalid').addClass('is-invalid');
                }
              });
            }
          });
        });
      </script>
@stop
