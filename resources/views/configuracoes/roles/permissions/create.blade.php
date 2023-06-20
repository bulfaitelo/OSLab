@extends('adminlte::page')

@section('title', 'Criando permissões')

@section('content_header')
    <h1>Criando Permissões</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.form-alert')
          {!! Form::open(['route' => ['configuracoes.permissions.store']]) !!}
            <div class="form-group">
              <label for="name">Nome da Permissão</label>
              {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'nome_permissao']) !!}
              <i>Os nomes não podem conter espaços e obrigatoriamente tem que ser em caixa baixa. <b>Exemplo:</b> nome_teste, criar_usuario</i>
            </div>
            <div class="form-group">
              <label for="description">Descrição da permissão</label>
              {!! Form::text('description', '', ['id' => 'description','class' => 'form-control', 'placeholder' => 'Nome Permissão']) !!}
            </div>
            <div class="form-group">
              <label for="description">Grupo</label>
              {!! Form::select('group', \App\Models\Configuracao\User\PermissionsGroup::orderBy('name')->pluck('name', 'id'), '', ['id' => 'group','class' => 'form-control' ]) !!}
              <i>Grupo padrão (facilita na hora de organizar).</i>
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
