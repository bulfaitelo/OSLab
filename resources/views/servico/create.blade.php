@extends('adminlte::page')

@section('title', 'Criar Serviço')

@section('content_header')
    <h1> <i class="fas fa-hand-holding-usd "></i> Criar Serviço</h1>
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
            {!! html()->form('post', route('servico.store'))->acceptsFiles()->open() !!}


                <div class="form-group">
                    <label for="name">Serviço</label>
                    {!! html()->text('name')->class('form-control')->placeholder('Nome do serviço')->required() !!}
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição do servico</label>
                    {!! html()->text('descricao')->class('form-control')->placeholder('descrição do serviço (opcional)') !!}
                </div>


                <label for="valor_servico">Valor do servico</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    {!! html()->text('valor_servico')->class('form-control decimal')->placeholder('Valor do serviço') !!}
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
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
@stop
