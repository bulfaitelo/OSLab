@extends('adminlte::page')

@section('title', 'Adicionando Estoque - '.  $produto->name)

@section('content_header')
    <h1>Adicionando Estoque - {{ $produto->name }}</h1>
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
            {!! html()->form('post', route('movimentacao.store', $produto->id))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Estoque Atual:</label>
                        {{ $produto->estoque }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ultima Atualização</label>
                        {{ $produto->updated_at->format('d/m/Y h:i') }}
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="estoque">Quantdade de entrada </label>
                        <div class="input-group mb-3">
                            {!! html()->text('estoque')->class('form-control numero')->placeholder('Quandade em unidades de entrada')->required()->attributes(['inputmode' => 'numeric']) !!}
                            <div class="input-group-append">
                                <span class="input-group-text">Unit.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="valor_custo">Valor de custo do Produto</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            {!! html()->text('valor_custo')->class('form-control decimal')->placeholder('Valor de venda do Produto')->attributes(['inputmode' => 'numeric']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descricao">Descrição</label>
                        <div class="input-group mb-3">
                            {!! html()->text('descricao')->class('form-control')->placeholder('Descrição') !!}
                        </div>
                    </div>
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
    $('.numero').mask('#', { reverse: true });
</script>
@stop
