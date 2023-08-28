@extends('adminlte::page')

@section('title', 'Editar Modelo')

@section('content_header')
    <h1>Editar Modelo</h1>
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
            {!! html()->form('put', route('configuracao.wiki.modelo.update', $modelo))->open() !!}
                <div class="form-group">
                    <label for="name">Modelo</label>
                    {!! html()->text('name', $modelo->name)->class('form-control')->placeholder('Modelo do aparelho')->required() !!}
                </div>
                <div class="form-group">
                    <label for="wiki_id">Wiki</label>
                    {!! html()->select('wiki_id', \App\Models\Wiki\Wiki::orderBy('name')->pluck('name', 'id'), $modelo->wiki_id)->class('form-control')->placeholder('Selecione')->required() !!}
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
