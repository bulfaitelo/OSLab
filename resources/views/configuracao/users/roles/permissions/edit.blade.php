@extends('adminlte::page')

@section('title', 'Editando permissões')

@section('content_header')
    <h1>Editando Permissões</h1>
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
          {!! html()->form('put', route('configuracao.permissions.update', $permission->id))->open() !!}
            <div class="form-group">
                <label for="name">Nome da Permissão</label>
                {!! html()->text('name', $permission->name)->class('form-control')->placeholder('nome_permissao') !!}
                <i>Os nomes não podem conter espaços e obrigatoriamente tem que ser em caixa baixa. <b>Exemplo:</b> nome_teste, criar_usuario</i>
            </div>
            <div class="form-group">
                <label for="description">Descrição da permissão</label>
                {!! html()->text('description', $permission->description)->class('form-control')->placeholder('Nome Permisão') !!}
            </div>
            <div class="form-group">
                <label for="description">Grupo</label>
                {!! html()->select('group', \App\Models\Configuracao\User\PermissionsGroup::orderBy('name')->pluck('name', 'id'), $permission->group_id)->class('form-control' )->placeholder('Selecione') !!}
                <i>Grupo padrão (facilita na hora de organizar).</i>
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
