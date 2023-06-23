@extends('adminlte::page')

@section('title', 'Visualizando Categoria')

@section('content_header')
    <h1>Visualizando Categoria</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            <div class="form-group">
                <label for="name">Categoria</label>
                {!! html()->text('name', $categoria->name)->class('form-control')->placeholder('Categoria')->disabled() !!}
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                {!! html()->text('descricao', $categoria->descricao)->class('form-control')->placeholder('Descrição')->disabled() !!}
            </div>
            <div class="form-group">
                <label for="garantia_id">Garantia</label>
                {!! html()->select('garantia_id', \App\Models\Configuracao\Os\Garantia::orderBy('name')->pluck('name', 'id'), $categoria->garantia_id)->class('form-control')->placeholder('Selecione')->disabled() !!}
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
@stop

@section('js')
@stop
