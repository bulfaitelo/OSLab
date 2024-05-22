@extends('adminlte::page')

@section('title', 'Editar Setor')

@section('content_header')
    <h1><i class="fas fa-industry "></i> Editar Setor</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
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
          @if(count($errors) > 0)
          @include('adminlte::partials.form-alert')
        @endif
        {!! html()->form('put', route('configuracao.user.setor.update', $setor->id))->open() !!}
            <div class="form-group">
              <label for="setor">Setor</label>
              {!! html()->text('setor', $setor->name)->class('form-control')->placeholder('Setor') !!}
            </div>
          </>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-oslab">
                <i class="fas fa-save"></i>
                Salvar
            </button>
          </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}

      </div>
    </div>

</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
