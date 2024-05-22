@extends('adminlte::page')

@section('title', 'Adicionar Despesa')

@section('content_header')
    <h1><i class="fa-solid fa-money-bill"></i> Adicionar Despesa</h1>
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
                @isset($os->id)
                    <span class="float-right" ><b>Despesa Relacionada a OS: #{{ $os->id }}</b></span>
                @endisset
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
          @include('adminlte::partials.form-alert')
          {!! html()->form('post', route('financeiro.despesa.store'))->open() !!}
          @isset($os->id)
          {!! html()->hidden('os_id', $os?->id) !!}
          @endisset
          <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name">Despesa</label>
                    {!! html()->text('name')->class('form-control')->placeholder('Descrição da despesa ')->required() !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="centro_custo_id">Centro de Custo</label>
                    {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione o Centro de Custo')->required() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cliente_id">Cliente / Fornecedor </label>
                    {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required()->disabled($os->id == true) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacoes"> Observações </label>
                    {!! html()->textarea('observacoes')->class('form-control')->placeholder('Observações (opcional)') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valor"> Valor </label>
                    {!! html()->text('valor')->class('form-control decimal')->placeholder('Valor total da despesa')->attributes(['inputmode' => 'numeric'])->required() !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="vencimento"> Vencimento </label>
                    {!! html()->date('vencimento')->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="forma_pagamento_id">Forma de pagamento</label>
                    {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="parcelado">Parcelado</label>
                    <div class="custom-control custom-switch custom-switch-md">
                        <input type="checkbox" name="parcelado" id="parcelado" class="custom-control-input" @checked(old('parcelado') == 'on') onclick="alternaParcelamento()">
                        <label class="custom-control-label" for="parcelado"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="display: none" id="div_parcelado">
            <div class="col-md-2">
                <div class="form-group ">
                    <label for="parcelas"> Parcelas </label>
                    <div class="input-group">
                        {!! html()->text('parcelas', 1)->class('form-control int')->placeholder('Parcelas')->required() !!}
                        <div id="data_info" class="input-group-append" data-container="body" data-toggle="popover" data-placement="top" data-content="O valor a ser recebido será automaticamente dividido pelo numero de parcelas, Podendo ser editado posteriormente.">
                            <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="parcelado_pago">Pago</label>
                    <div class="custom-control custom-switch custom-switch-md">
                        <input type="checkbox" name="parcelado_pago" @checked(old('parcelado_pago') == 'on') id="parcelado_pago" class="custom-control-input" onclick="alternaPagoParcelado()">
                        <label class="custom-control-label" for="parcelado_pago"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"  id="div_avista">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="avista_pago">Pago</label>
                    <div class="custom-control custom-switch custom-switch-md">
                        <input type="checkbox" name="avista_pago" @checked(old('avista_pago') == 'on') id="avista_pago" class="custom-control-input" onclick="alternaPagoAvista()">
                        <label class="custom-control-label" for="avista_pago"></label>
                    </div>
                </div>
            </div>
            <div style="display: none" class="col-md-2 div_avista_pago ">
                <div class="form-group">
                    <label for="avista_valor"> Valor </label>
                    {!! html()->text('avista_valor')->class('form-control decimal')->placeholder('Valor Pago')->attributes(['inputmode' => 'numeric'])->required() !!}
                </div>
            </div>
            <div style="display: none" class="col-md-2 div_avista_pago ">
                <div class="form-group">
                    <label for="data_pagamento"> Data pagamento </label>
                    {!! html()->date('data_pagamento')->class('form-control')->placeholder('Valor Pago')->required() !!}
                </div>
            </div>
        </div>



          </div>
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
@stop

@section('css')
<link href="{{ url('') }}/vendor/tom-select/tom-select.bootstrap4.min.css" rel="stylesheet" />

<style>
    .despesa {
        border-top: 3px solid #cd121f;
    }
    .ts-wrapper .option .title {
        display: block;
    }
    .ts-wrapper .option .url {
        font-size: 15px;
        display: block;
        color: #7c7c7c;
    }

    .ts-wrapper::after {
        display: none;
    }
</style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script>
<script>
    $(document).ready(function() {
        // tom-select Clientes
        var tomSelectCliente = new TomSelect(".cliente",{
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            // fetch remote data
            load: function(query, callback) {
                var url = route('cliente.select') + '?q=' + encodeURIComponent(query);
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json);
                    }).catch(()=>{
                        callback();
                    });
            },
            render: {
                option: function(data, escape) {
                return '<div>' +
                        '<span class="title">' + escape(data.name) + '</span>' +
                        '<span class="url"> <b> Tipo Cliente: </b> ' + escape(data.tipo) + ' | <b> Quant. OS: </b> ' + escape(data.os_count) + '</span>' +
                    '</div>';
                },
                item: function(data, escape) {
                    return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
                },
                @can('cliente_create')
                no_results:function(data,escape){
                    return '<div class="no-results">' +
                                '<p>Cliente não encontrado</p>' +
                                '<a href="'+ route('cliente.create')+'" target="_blank">' +
                                    '<button type="button"  class="btn btn-sm btn-oslab"><i class="fa-solid fa-plus"></i> Criar</button>' +
                                '</a>' +
                            '</div>';
                },
                @endcan
            },
        });
        // selecionando os dados do cliente
        tomSelectCliente.addOption(@js($os?->getClienteForSelect()));
        tomSelectCliente.addItem(@js($os?->cliente_id));

    });
</script>

<script>


    $('#data_info').popover({
        trigger: 'hover'
    });
</script>
<script>
    $(document).ready(function () {
        alternaParcelamento();
        alternaPagoAvista();
        alternaPagoParcelado()
    });
    function alternaParcelamento() {
        console.log('teste');
        var checkParcelado = $('#parcelado');
        var divAvista = $('#div_avista');
        var divParcelado = $('#div_parcelado');
        if (checkParcelado.prop('checked') == true) {
            divAvista.css('display', 'none');
            divParcelado.css('display', '');
        } else {
            divAvista.css('display', '');
            divParcelado.css('display', 'none');
        }
    }

    function alternaPagoAvista() {
        var checkPago = $('#avista_pago');
        var divPAgo = $('.div_avista_pago');
        if (checkPago.prop('checked') == true) {
            divPAgo.css('display', '');
            $('#avista_valor').attr("required","required");
            $('#avista_forma_pagamento_id').attr("required","required");
            $('#data_pagamento').attr("required","required");

        } else {
            divPAgo.css('display', 'none');
            $('#avista_valor').removeAttr("required");
            $('#avista_forma_pagamento_id').removeAttr("required");
            $('#data_pagamento').removeAttr("required");
        }
    }

    function alternaPagoParcelado() {
        var checkPago = $('#parcelado_pago');
        var divPAgo = $('.div_parclado_pago');
        if (checkPago.prop('checked') == true) {
            divPAgo.css('display', '');
            $('#parcelas').attr("required","required");
        } else {
            divPAgo.css('display', 'none');
            $('#parcelas').removeAttr("required");
        }

    }



</script>
@stop
