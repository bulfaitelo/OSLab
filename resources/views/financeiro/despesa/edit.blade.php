@extends('adminlte::page')

@section('title', 'Editar Despesa')

@section('content_header')
    <h1>Editar Despesa</h1>
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
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
          @include('adminlte::partials.form-alert')

          <form action="{{ route('financeiro.despesa.update', $despesa) }}" id="form-despesa" method="post">
            @csrf
            @method('PUT')
          <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Despesa</label>
                    {!! html()->text('name', $despesa->name)->class('form-control')->placeholder('Descrição da despesa ')->required() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="centro_custo_id">Centro de Custo</label>
                    {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'),$despesa->centro_custo_id)->class('form-control')->placeholder('Selecione o Centro de Custo')->required() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cliente_id">Cliente / Fonrcedor </label>
                    {!! html()->select('cliente_id', [$despesa->cliente_id => $despesa->cliente->name], $despesa->cliente_id)->class('form-control cliente')->placeholder('Selecione')->required() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacoes"> Observações </label>
                    {!! html()->textarea('observacoes', $despesa->observacoes)->class('form-control')->placeholder('Observações (opcional)') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valor"> Valor </label>
                    {!! html()->text('valor', $despesa->valor)->class('form-control decimal')->placeholder('Valor total da despesa')->required() !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group ">
                    <label for="parcelas"> Parcelas </label>
                    <div class="input-group">
                        {!! html()->text('parcelas', $despesa->parcelas)->class('form-control int')->placeholder('Parcelas')->required() !!}
                        @can('financeiro_despesa_pagamento_create')
                            <span class="input-group-append">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-pagamento">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </span>
                        @endcan
                    </div>
                    {!! html()->form()->close() !!}
                    @can('financeiro_despesa_pagamento_create')
                    <div class="modal fade" id="modal-pagamento">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Adicionar uma nova parcela</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('financeiro.despesa.pagamento.store', $despesa) }}" id="form-pagamento" method="post">
                                        @csrf
                                    <div class="row">
                                        <div  class="col-md-2">
                                            <div class="form-group">
                                                <label for="parcela"> Parcela </label>
                                                {!! html()->text('parcela')->class('form-control int')->placeholder('Parcela')->required() !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vencimento"> Vencimento </label>
                                                {!! html()->date('vencimento')->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="pago">Pago</label>
                                                <div class="custom-control custom-switch custom-switch-md">
                                                    <input type="checkbox" name="pago" @checked(old('pago') == 'on') id="pago" class="custom-control-input" onclick="alternaPago()">
                                                    <label class="custom-control-label" for="pago"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row div_pago collapse" id="collapseExample">
                                        <div  class="col-md-4">
                                            <div class="form-group">
                                                <label for="pagamento_valor"> Valor </label>
                                                {!! html()->text('pagamento_valor')->class('form-control decimal')->placeholder('Valor') !!}
                                            </div>
                                        </div>
                                        <div  class="col-md-4 ">
                                            <div class="form-group">
                                                <label for="data_pagamento"> Data pagamento </label>
                                                {!! html()->date('data_pagamento')->class('form-control')->placeholder('Valor Pago') !!}
                                            </div>
                                        </div>
                                        <div  class="col-md-4">
                                            <div class="form-group">
                                                <label for="forma_pagamento_id">Forma de pagamento</label>
                                                {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                        Fechar
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Salvar
                                    </button>
                                </div>
                                {!! html()->form()->close() !!}
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>

        </div>

        <div class="card-body pt-2 table-responsive">
            <table class="table table-sm table-hover text-nowrap">
              <thead>
                <tr>
                  <th style="width: 10px">Parcela</th>
                  <th>Forma Pagamento</th>
                  <th>Usuario</th>
                  <th>Valor</th>
                  <th>Vencimento</th>
                  <th>Data Pagamento</th>
                  <th style="width: 40px"></th>
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
                    <td>
                        <div class="btn-group btn-group-sm">
                            @can('financeiro_despesa_pagamento_edit')
                                <button  title="Editar" class="btn btn-left btn-info" data-toggle="modal" data-target="#modal-editar_{{ $item->id }}"><i class="fas fa-edit"></i></button>
                            @endcan
                            @can('financeiro_despesa_pagamento_destroy')
                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                            @endcan
                        </div>
                        @can('financeiro_despesa_pagamento_edit')
                                <div class="modal fade" id="modal-editar_{{ $item->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Editar: Parcela </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('financeiro.despesa.pagamento.update', [$despesa->id, $item->id]) }}" id="form-pagamento" method="post">
                                                    @method('put')
                                                    @csrf
                                                <div class="row">
                                                    <div  class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="parcela"> Parcela </label>
                                                            {!! html()->text('parcela', $item->parcela)->class('form-control int')->placeholder('Parcela')->required() !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="vencimento"> Vencimento </label>
                                                            {!! html()->date('vencimento', $item->vencimento)->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="pago_{{$item->id}}">Pago</label>
                                                            <div class="custom-control custom-switch custom-switch-md">
                                                                <input type="checkbox" name="pago" @checked($item->data_pagamento) id="pago_{{$item->id}}" class="custom-control-input" onclick="alternaPagoEdit({{ $item->id }})">
                                                                <label class="custom-control-label" for="pago_{{$item->id}}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row div_pago_{{$item->id}}  @if (!$item->data_pagamento) collapse @endif " id="collapseExample">
                                                    <div  class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="pagamento_valor"> Valor </label>
                                                            {!! html()->text('pagamento_valor', $item->valor)->class('form-control decimal')->placeholder('Valor') !!}
                                                        </div>
                                                    </div>
                                                    <div  class="col-md-4 ">
                                                        <div class="form-group">
                                                            <label for="data_pagamento"> Data pagamento </label>
                                                            {!! html()->date('data_pagamento', $item->data_pagamento)->class('form-control')->placeholder('Valor Pago') !!}
                                                        </div>
                                                    </div>
                                                    <div  class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="forma_pagamento_id">Forma de pagamento</label>
                                                            {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'), $item->forma_pagamento_id)->class('form-control')->placeholder('Selecione') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    <i class="fas fa-times"></i>
                                                    Fechar
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i>
                                                    Salvar
                                                </button>
                                            </div>
                                            {!! html()->form()->close() !!}

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endcan

                            @can('financeiro_despesa_pagamento_destroy')
                                <div class="modal fade" id="modal-excluir_{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Realmente deseja Excluir?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Nome:</b> {{ $item->name}}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                {!! html()->form('delete', route('financeiro.despesa.pagamento.destroy', [$despesa->id, $item->id]))->open() !!}
                                                    <input type="submit" class="btn btn-danger delete-permission" value="Excluir Despesa">
                                                {!! html()->form()->close() !!}

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endcan
                        </div>
                      <!-- /.modal -->
                    </td>
                  </tr>

                @endforeach
              </tbody>
            </table>
          </div>



          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" onclick="$('#form-despesa').submit();" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
          </div>
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

        .custom-switch.custom-switch-md .custom-control-label {
            padding-left: 2rem;
            padding-bottom: 1.5rem;
        }

        .custom-switch.custom-switch-md .custom-control-label::before {
            height: 1.5rem;
            width: calc(2rem + 0.75rem);
            border-radius: 3rem;
        }

        .custom-switch.custom-switch-md .custom-control-label::after {
            width: calc(1.5rem - 4px);
            height: calc(1.5rem - 4px);
            border-radius: calc(2rem - (1.5rem / 2));
        }

        .custom-switch.custom-switch-md .custom-control-input:checked ~ .custom-control-label::after {
            transform: translateX(calc(1.5rem - 0.25rem));
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
<script>

$(document).ready(function () {
        alternaPago();
});
function alternaPago() {
        var checkPago = $('#pago');
        var divPAgo = $('.div_pago');
        if (checkPago.prop('checked') == true) {
            // divPAgo.css('display', '');
            $('.div_pago').collapse('show');
            $('#pagamento_valor').attr("required","required");
            $('#forma_pagamento_id').attr("required","required");
            $('#data_pagamento').attr("required","required");
        } else {
            // divPAgo.css('display', 'none');
            $('.div_pago').collapse('hide');
            $('#pagamento_valor').removeAttr("required");
            $('#forma_pagamento_id').removeAttr("required");
            $('#data_pagamento').removeAttr("required");
        }
    }

    function alternaPagoEdit(id) {
        var checkPago = $('#pago_'+id);

        if (checkPago.prop('checked') == true) {
            // divPAgo.css('display', '');

            $('.div_pago_'+id).collapse('show');
            // $('#pagamento_valor').attr("required","required");
            // $('#forma_pagamento_id').attr("required","required");
            // $('#data_pagamento').attr("required","required");
        } else {
            // divPAgo.css('display', 'none');
            $('.div_pago_'+id).collapse('hide');
            // $('#pagamento_valor').removeAttr("required");
            // $('#forma_pagamento_id').removeAttr("required");
            // $('#data_pagamento').removeAttr("required");
        }
    }
</script>
@stop
