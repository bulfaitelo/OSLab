@extends('adminlte::page')

@section('title', 'Editando Setor')

@section('content_header')
    <h1>Editando Setor</h1>
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
          {!! Form::open(['route' => ['configuracoes.user.setor.update', $setor->id],'method' => 'put']) !!}
            <div class="form-group">
              <label for="setor">Setor</label>
              {!! Form::text('setor', $setor->name ?? '', ['id' => 'setor', 'class' => 'form-control', 'placeholder' => 'Setor']) !!}
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
    {{-- <script> console.log('Hi!'); </script> --}}
    <script>
        @if(session('success'))
          $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Cadastro realizado com Sucesso!',
                    subtitle: '',
                    autohide: true,
                    delay: 2000,
                    body: '{{Session::get("success")}}'
          })
        @endif
        @if(count($errors) > 0)
          $(document).Toasts('create', {
                  class: 'bg-danger',
                  title: 'Ocorreu um erro',
                  subtitle: '',
                  autohide: true,
                  delay: 2000,
                  body: 'Por favor verifique o formulário'
          })
        @endif
    </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
      <script>
        $(document).ready(function(){
            $('.code').mask('000000');
        });
      </script>

@stop
