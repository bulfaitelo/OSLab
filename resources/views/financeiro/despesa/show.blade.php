@extends('adminlte::page')

@section('title', 'Visualizar Despesa')

@section('content_header')
    <h1><i class="fa-solid fa-money-bill"></i> Visualizar Despesa</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-11 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header despesa">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
                @can('financeiro_despesa_edit')
                <a href="{{ route('financeiro.despesa.edit', $despesa) }}">
                    <button type="button" title="Editar" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i>
                        Editar
                    </button>
                </a>
                @endcan
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
          <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Despesa</label>
                    {!! html()->text('name', $despesa->name)->class('form-control')->placeholder('Descrição da despesa ')->disabled() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="centro_custo_id">Centro de Custo</label>
                    {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'),$despesa->centro_custo_id)->class('form-control')->placeholder('Selecione o Centro de Custo')->disabled() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cliente_id">Cliente / Fornecedor </label>
                    {!! html()->select('cliente_id', [$despesa->cliente_id => $despesa->cliente->name], $despesa->cliente_id)->class('form-control cliente')->placeholder('Selecione')->disabled() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacoes"> Observações </label>
                    {!! html()->textarea('observacoes', $despesa->observacoes)->class('form-control')->placeholder('Observações (opcional)')->disabled() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valor"> Valor </label>
                    {!! html()->text('valor', $despesa->valor)->class('form-control decimal')->placeholder('Valor total da despesa')->disabled() !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group ">
                    <label for="parcelas"> Parcelas </label>
                    <div class="input-group">
                        {!! html()->text('parcelas', $despesa->parcelas)->class('form-control int')->placeholder('Parcelas')->disabled() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body  pr-0 pl-0 pt-2 table-responsive">
            <table class="table table-sm table-hover text-nowrap">
              <thead>
                <tr>
                  <th style="width: 10px">Parcela</th>
                  <th>Forma Pagamento</th>
                  <th>Usuario</th>
                  <th>Valor</th>
                  <th>Vencimento</th>
                  <th>Data Pagamento</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($despesa->pagamentos as $item)
                  <tr>
                    <td>{{ $item->parcela }}</td>
                    <td>{{ $item->formaPagamento?->name}}</td>
                    <td>{{ $item->user->name}}</td>
                    <td>R$ {{ number_format($item->valor, 2, ',', '.')}}</td>
                    <td>{{ $item->vencimento?->format('d/m/Y') ?? ''}}</td>
                    <td>{{ $item->data_pagamento?->format('d/m/Y') ?? ''}}</td>
                  </tr>

                @endforeach
              </tbody>
            </table>
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

<link href="{{ url('') }}/vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('') }}/vendor/select2/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />
    <style>
        .despesa {
            border-top: 3px solid #cd121f;
        }
    </style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('') }}/vendor/select2/dist/js/i18n/pt-BR.js"></script>
<script src="{{ url('') }}/src/js/select-cliente.js"></script>
{{-- <script src="https://adminlte.io/themes/v3/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> --}}
{{-- <script src="{{ url('') }}/vendor/bootstrap-switch/bootstrap-switch.min.js"></script> --}}

<script>

    $('.decimal').mask('#.##0,00', { reverse: true });
    $('.int').mask('#0', { reverse: true });
    $('#data_info').popover({
        trigger: 'hover'
    });
</script>

@stop
