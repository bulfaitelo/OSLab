@extends('adminlte::page')

@section('title', 'Visualizar Forma de Pagamento')

@section('content_header')
    <h1><i class="fa-solid fa-money-bill-transfer "></i> Visualizar Forma de Pagamento</h1>
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
                <div class="form-group">
                    <label for="name">Forma de pagamento</label>
                    {!! html()->text('name', $formaPagamento->name)->class('form-control')->placeholder('Nome da forma de pagamento')->disabled() !!}
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->text('descricao', $formaPagamento->descricao)->class('form-control')->placeholder('descrição (opcional)')->disabled() !!}
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
