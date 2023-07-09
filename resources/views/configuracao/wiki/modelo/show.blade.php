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
                    <button type="button"  class="btn  btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
              </a>
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">

                <div class="form-group">
                    <label for="name">Modelo</label>
                    {!! html()->text('name', $modelo->name)->class('form-control')->placeholder('Modelo do aparelho')->disabled() !!}
                </div>
                <div class="form-group">
                    <label for="wiki_id">Wiki</label>
                    {!! html()->select('wiki_id', \App\Models\Wiki\Wiki::orderBy('name')->pluck('name', 'id'), $modelo->wiki_id)->class('form-control')->placeholder('Selecione')->disabled() !!}
                </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->

        </div>
      <!-- /.card -->
      </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
