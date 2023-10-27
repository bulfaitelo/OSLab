@extends('adminlte::page')

@section('title', 'Cadastro Emitente')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Cadastro Emitente</h1>
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
            {!! html()->form('post', route('configuracao.emitente.store'))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="img-container">
                        <label>Logo</label>
                        <input type="file" id="emitente_file" name="emitente_file"  accept=".jpeg, .jpg, .png, .bmp"  />
                        <img id="logo_emitente" src="{{ asset('vendor/oslab/imgs/oslab_logo.png') }}" alt="Logo da empresa" class="rounded image img-fluid">
                        <div id="img-upload" class="overlay">
                          <div class="text">
                                <i class="fa fa-upload fa-5x"></i>
                          </div>
                        </div>
                      </div>
                    {{-- <img class="rounded  img-fluid" src="https://img.freepik.com/fotos-premium/o-ceu-da-paisagem-do-arco-iris-refletiu-a-imagem-de-fundo-da-natureza-da-agua-ai-gerou-a-arte_856480-1354.jpg?w=740" alt=""> --}}
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="registro">CNPJ</label>
                            <div class="input-group ">
                                {!! html()->text('registro')->class('form-control cnpj')->placeholder('CNPJ') !!}
                                <span class="input-group-append">
                                    <button type="button" id="busca_registro" class="btn btn-info">Buscar</button>
                                </span>
                            </div>
                            <i class="text-danger" id="msg_cpnj_error"></i>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Razão Social</label>
                                {!! html()->text('name')->class('form-control')->placeholder('Razão Social')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fantasia">Nome Fantasia</label>
                                {!! html()->text('fantasia')->class('form-control')->placeholder('Nome Fantasia') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inscricao_estadual">Inscrição Estadual</label>
                                {!! html()->text('inscricao_estadual')->class('form-control')->placeholder('Inscrição Estadual') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="porte">Porte</label>
                                {!! html()->text('porte')->class('form-control')->placeholder('Porte, por exemplo MEI MICRO...') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="email">Email</label>
                              {!! html()->email('email')->class('form-control')->placeholder('Email') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefone">Telefone </label>
                                {!! html()->text('telefone')->class('form-control tel')->placeholder('Telefone') !!}
                            </div>
                        </div>
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
            @can('config_emitente_create')
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar
                </button>
            @endcan
          </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}
      </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .img-container {
          position: relative;
          width: 100%;
        }

        .image {
          display: block;
          width: 100%;
          height: auto;
        }

        .overlay {
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          height: 100%;
          width: 100%;
          opacity: 0;
          transition: .5s ease;
          background-color: #008CBA;
        }

        .img-container:hover .overlay {
          opacity: 1;
        }

        .text {
          color: white;
          font-size: 20px;
          position: absolute;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
          text-align: center;
        }
        #emitente_file {
            display: none;
        }
    </style>
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
    <script>
        $('#img-upload').click(function(){
            $('#emitente_file').click();
        });
    </script>
    <script src="{{ asset('src/js/cnpj.js') }}"></script>
@stop
