@extends('adminlte::page')

@section('title', 'Vizualizando Produto')

@section('content_header')
    <h1>Vizualizando Produto</h1>
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
                    <label for="name">Produto</label>
                    {!! html()->text('name', $produto->name)->class('form-control')->placeholder('Nome do Produto')->required()->disabled() !!}
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição do produto</label>
                    {!! html()->text('descricao', $produto->descricao)->class('form-control')->placeholder('descrição do Produto (opcional)')->disabled() !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="valor_custo">Valor de custo do Produto</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            {!! html()->text('valor_custo', $produto->valor_custo)->class('form-control decimal')->placeholder('Valor de custo do Produto')->disabled() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="valor_venda">Valor de venda do Produto</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            {!! html()->text('valor_venda', $produto->valor_venda)->class('form-control decimal')->placeholder('Valor de venda do Produto')->disabled() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estoque">Estoque Inicial</label>
                            {!! html()->text('estoque', $produto->estoque)->class('form-control numero')->placeholder('Estoque inicial do produto')->disabled() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estoque_minimo">Estoque Minimo</label>
                            {!! html()->text('estoque_minimo', $produto->estoque_minimo)->class('form-control numero')->placeholder('Estoque minimo do protuto')->disabled() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="centro_custo_id">Centro de Custo</label>
                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'), $produto->centro_custo_id)->class('form-control')->placeholder('Selecione')->required()->disabled() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label for="modelo_id">Modelo</label>
                            {!! html()->select('modelo_od', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                        </div> --}}
                    </div>
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
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
    $('.numero').mask('#', { reverse: true });
</script>
@stop
