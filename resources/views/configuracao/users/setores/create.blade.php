@extends('adminlte::page')

@section('title', 'Criando Setor')

@section('content_header')
    <h1>Criando Setor</h1>
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
          {!! html()->form('post', route('configuracao.user.setor.store'))->open() !!}
            <div class="form-group">
              <label for="setor">Setor</label>
              {!! html()->text('setor')->class('form-control')->placeholder('Setor') !!}
            </div>
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
@stop

@section('js')
@stop
