@extends('adminlte::page')

@section('title', 'Editar Fabricante')

@section('content_header')
    <h1><i class="fa-solid fa-book "></i> Editar Fabricante</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-9 ">
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
            {!! html()->form('put', route('configuracao.wiki.fabricante.update', $fabricante))->open() !!}
                <div class="form-group">
                    <label for="name">Fabricante</label>
                    {!! html()->text('name', $fabricante->name)->class('form-control')->placeholder('Fabricante')->required() !!}
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->text('descricao', $fabricante->descricao)->class('form-control')->placeholder('descrição (opcional)') !!}
                </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
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
