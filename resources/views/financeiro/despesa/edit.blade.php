@extends('adminlte::page')

@section('title', 'Editar Despesa')

@section('content_header')
    <h1><i class="fa-solid fa-money-bill"></i> Editar Despesa</h1>
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
                @can('financeiro_despesa_show')
                <a href="{{ route('financeiro.despesa.show', $despesa) }}">
                    <button type="button" title="Editar" class="btn btn-sm btn-default">
                        <i class="fas fa-eye"></i>
                        <span class="d-none d-sm-inline">Visualizar</span>
                    </button>
                </a>
                @endcan
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
                                {!! html()->text('name', $despesa->name)->class('form-control')->placeholder('Descrição da despesa')->required() !!}
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
                                <label for="cliente_id">Cliente / Fornecedor </label>
                                {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required()->disabled($despesa->os_id) !!}
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
                                {!! html()->text('valor', $despesa->valor)->class('form-control decimal')->attributes(['inputmode' => 'numeric'])->placeholder('Valor total da Receita')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="parcelas"> Parcelas </label>
                                <div class="input-group">
                                    {!! html()->text('parcelas', $despesa->parcelas)->class('form-control int')->attributes(['inputmode' => 'numeric'])->placeholder('Parcelas')->required() !!}
                                    @can('financeiro_despesa_pagamento_create')
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-pagamento">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </span>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                {!! html()->form()->close() !!}
            </div>
            <div class="card-body table-responsive">
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
                                        <button  title="Editar" class="btn btn-left btn-info" data-toggle="modal" data-json="{{$item->dataModal()}}"  data-url="{{route('financeiro.despesa.pagamento.update', [$despesa->id, $item->id])}}" data-target="#modal-editar" ><i class="fas fa-edit"></i></button>
                                    @endcan
                                    @can('financeiro_despesa_pagamento_destroy')
                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->parcela}}" data-url="{{route('financeiro.despesa.pagamento.destroy', [$despesa->id, $item->id])}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Minimal with icon only --}}
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" onclick="$('#form-despesa').submit();" class="btn btn-sm btn-oslab">
                    <i class="fas fa-save"></i>
                    Salvar
                </button>
            </div>
        </div>
        <!-- /.card -->
    </div>
    {{-- Modal par editar pagamento --}}
    @can('financeiro_despesa_pagamento_edit')
    <div class="modal fade" id="modal-editar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar: Parcela </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-pagamento" method="post">
                        @method('put')
                        @csrf
                    <div class="row">
                        <div  class="col-md-2">
                            <div class="form-group">
                                <label for="parcela"> Parcela </label>
                                {!! html()->text('parcela')->class('form-control int')->attributes(['inputmode' => 'numeric'])->placeholder('Parcela')->required() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vencimento"> Vencimento </label>
                                {!! html()->date('vencimento')->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
                            </div>
                        </div>
                        <div  class="col-md-4">
                            <div class="form-group">
                                <label for="forma_pagamento_id">Forma de pagamento</label>
                                {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="pago_edit">Pago</label>
                                <div class="custom-control custom-switch custom-switch-md">
                                    <input type="checkbox" name="pago" id="pago_edit" class="custom-control-input" onchange="alternaPagoEdit()">
                                    <label class="custom-control-label" for="pago_edit"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row collapse div_pago_edit">
                        <div  class="col-md-4">
                            <div class="form-group">
                                <label for="pagamento_valor"> Valor </label>
                                {!! html()->text('pagamento_valor')->class('form-control decimal')->attributes(['inputmode' => 'numeric'])->placeholder('Valor') !!}
                            </div>
                        </div>
                        <div  class="col-md-4 ">
                            <div class="form-group">
                                <label for="data_pagamento"> Data pagamento </label>
                                {!! html()->date('data_pagamento')->class('form-control')->placeholder(' Data pagamento ') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-sm btn-oslab">
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
    {{-- /Modal par editar pagamento --}}

    {{-- Modal para excluir Pagamento --}}
    @can('financeiro_despesa_pagamento_destroy')
    <div class="modal fade"  id="modal-excluir" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Realmente deseja Excluir?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p><b>Parcela:</b> <span></span></p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                    <i class="fa-solid fa-ban"></i>
                    Fechar
                </button>
                    {!! html()->form('delete')->open() !!}
                    <button type="submit" class="btn btn-sm btn-danger delete-permission">
                        <i class="fa-solid fa-trash"></i>
                        Excluir
                    </button>
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>
    @endcan
    {{-- /Modal para excluir Pagamento --}}

    {{-- Modal para criação de Pagamento de parcela --}}
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
                        <div  class="col-md-4">
                            <div class="form-group">
                                <label for="forma_pagamento_id">Forma de pagamento</label>
                                {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
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
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-sm btn-oslab">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>
    @endcan
    {{-- /Modal para criação de Pagamento de parcela --}}
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
    .ts-control::after {
        display: none!important;
    }
</style>
@stop
@section('js')
@routes
<script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script>
<script>
    $(document).ready(function() {
        // tom-select Clientes
        tomSelectCliente = new TomSelect(".cliente",{
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
                                    '<button type="button"  class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Criar</button>' +
                                '</a>' +
                            '</div>';
                },
                @endcan
            },
        });
        // selecionando os dados do cliente
        tomSelectCliente.addOption(@js($despesa->getClienteForSelect()));
        tomSelectCliente.addItem(@js($despesa->cliente_id));
    });
</script>

<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
    $('.int').mask('#0', { reverse: true });
    $('#data_info').popover({
        trigger: 'hover'
    });
</script>
<script>
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

    function alternaPagoEdit() {
        var checkPago = $('#pago_edit');

        if (checkPago.prop('checked') == true) {
            // divPAgo.css('display', '');
            $('.div_pago_edit').collapse('show');
            // $('#pagamento_valor').attr("required","required");
            // $('#forma_pagamento_id').attr("required","required");
            // $('#data_pagamento').attr("required","required");
        } else {
            // divPAgo.css('display', 'none');
            $('.div_pago_edit').collapse('hide');
            // $('#pagamento_valor').removeAttr("required");
            // $('#forma_pagamento_id').removeAttr("required");
            // $('#data_pagamento').removeAttr("required");
        }
    }
</script>

<script>
    $('#modal-editar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var item = button.data('json') // Extract info from data-* attributes
        console.log(item);
        var url = button.data('url') // Extract info from data-* attributes
        var modal = $(this)

        // valores
        modal.find('#parcela').val(item.parcela);
        modal.find('#vencimento').val(item.vencimento);
        modal.find('#forma_pagamento_id').val(item.forma_pagamento_id);
        if (item.data_pagamento) {
            modal.find('#pago_edit').prop('checked', true);
            $('.div_pago_edit').collapse('show');
        } else {
            modal.find('#pago_edit').prop('checked', false);
            $('.div_pago_edit').collapse('hide');
        }

        modal.find('#pagamento_valor').val(item.valor);
        modal.find('#data_pagamento').val(item.data_pagamento);
        modal.find('form').attr('action', url);
    })
</script>
@stop
