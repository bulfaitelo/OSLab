@extends('adminlte::page')

@section('title', 'Criar Perfil')

@section('content_header')
    <h1><i class="fas fa-user-tag "></i> Criar Perfil</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
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
            {!! html()->form('post', route('configuracao.roles.store'))->open() !!}
            <div class="form-group">
              <label for="name">Nome do Perfil</label>
              {!! html()->text('name')->class('form-control')->placeholder('nome_perfil') !!}
              <i>Os nomes não podem conter espaços e obrigatoriamente tem que ser em caixa baixa. <b>Exemplo:</b> nome_teste, criar_usuario</i>
            </div>
            <div class="form-group">
              <label for="description">Descrição do Perfil</label>
              {!! html()->text('description')->class('form-control')->placeholder('nome perfil') !!}
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
@stop
