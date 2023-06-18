@extends('adminlte::page')

@section('title', 'Criando Perfil')

@section('content_header')
    <h1>Criando Perfil</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.alert')
          {!! Form::open(['route' => ['configuracoes.roles.store']]) !!}
            <div class="form-group">
              <label for="name">Nome da Perfil</label>
              {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'nome_perfil']) !!}
              <i>Os nomes não podem conter espaços e obrigatoriamente tem que ser em caixa baixa. <b>Exemplo:</b> nome_teste, criar_usuario</i>
            </div>
            <div class="form-group">
              <label for="description">Descrição da Perfil</label>
              {!! Form::text('description', '', ['id' => 'description','class' => 'form-control', 'placeholder' => 'nome perfil']) !!}
            </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      <!-- /.card -->
      {!! Form::close() !!}

      </div>

</div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
