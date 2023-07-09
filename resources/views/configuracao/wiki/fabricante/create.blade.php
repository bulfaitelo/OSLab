@extends('adminlte::page')

@section('title', 'Criar Fabricante')

@section('content_header')
    <h1>Criar Fabricante</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-9 ">
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
            @include('adminlte::partials.form-alert')
            {!! html()->form('post', route('configuracao.wiki.fabricante.store'))->open() !!}
                <div class="form-group">
                    <label for="name">Fabricante</label>
                    {!! html()->text('name')->class('form-control')->placeholder('Nome do serviço')->required() !!}
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->text('descricao')->class('form-control')->placeholder('descrição (opcional)') !!}
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
