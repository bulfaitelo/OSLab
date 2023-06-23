@extends('adminlte::page')

@section('title', 'Editando Categoria')

@section('content_header')
    <h1>Editando Categoria</h1>
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
          {!! html()->form('put', route('configuracao.os.categoria.update', $categoria->id))->open() !!}
            <div class="form-group">
                <label for="name">Categoria</label>
                {!! html()->text('name', $categoria->name)->class('form-control')->placeholder('Categoria')->required() !!}
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                {!! html()->text('descricao', $categoria->descricao)->class('form-control')->placeholder('Descrição') !!}
            </div>
            <div class="form-group">
                <label for="garantia_id">Garantia</label>
                {!! html()->select('garantia_id', \App\Models\Configuracao\Os\Garantia::orderBy('name')->pluck('name', 'id'), $categoria->garantia_id)->class('form-control')->placeholder('Selecione') !!}
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
