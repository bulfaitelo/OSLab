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
          @if(count($errors) > 0)
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
          {!! Form::open(['route' => ['configuracoes.user.setor.store']]) !!}
            <div class="form-group">
              <label for="setor">Setor</label>
              {!! Form::text('setor', '', ['id' => 'setor', 'class' => 'form-control', 'placeholder' => 'Setor']) !!}
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
@stop

@section('js')
@stop
