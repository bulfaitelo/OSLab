@extends('adminlte::page')

@section('title', 'Editando Perfis')

@section('content_header')
    <h1>Editando Perfis</h1>
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
          {!! Form::open(['route' => ['configuracoes.roles.update', $role->id],'method' => 'put']) !!}
            <div class="form-group">
              <label for="name">Nome da Permissão</label>
              {!! Form::text('name', $role->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'nome_perfil']) !!}
              <i>Os nomes não podem conter espaços e obrigatoriamente tem que ser em caixa baixa. <b>Exemplo:</b> nome_teste, criar_usuario</i>
            </div>
            <div class="form-group">
              <label for="description">Descrição da permissão</label>
              {!! Form::text('description', $role->description, ['id' => 'description','class' => 'form-control', 'placeholder' => 'Nome do Perfil']) !!}
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
