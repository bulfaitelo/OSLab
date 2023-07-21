@extends('adminlte::page')

@section('title', 'Lançamento')

@section('content_header')
    <h1>Lançamento</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card ">
      <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn  btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('financeiro_lancamento_create')
                <button type="button"  class="btn  btn-danger" data-toggle="modal" data-target="#modal-despesa">
                    {{-- <i class="fa-solid fa-arrow-trend-down"></i> --}}
                    {{-- <i class="fa-solid fa-down-long"></i> --}}
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Despesa
                </button>
                <div class="modal fade modal-primary" id="modal-despesa">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header despesa" >
                                <h4 class="modal-title">Adicionar Despesa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Despesa</label>
                                            {!! html()->text('name')->class('form-control')->placeholder('Descrição da despesa ')->required() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="centro_custo_id">Centro de Custo</label>
                                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione o Centro de Custo')->required() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cliente_id">Cliente / Fonrcedor </label>
                                            {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacoes"> Observações </label>
                                            {!! html()->textarea('observacoes')->class('form-control')->placeholder('Oboservcações (opcional)') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="valor"> Valor </label>
                                            {!! html()->text('valor')->class('form-control decimal')->placeholder('Valor total da despesa')->required() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="vencimento"> Vencimento </label>
                                            {!! html()->date('vencimento')->class('form-control')->placeholder('Nome da forma de pagamento') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="parcelas"> Parcelas </label>
                                            <div class="input-group">
                                                {!! html()->text('parcelas', 1)->class('form-control int')->placeholder('Parcelas')->required() !!}
                                                <div id="data_info" class="input-group-append" data-container="body" data-toggle="popover" data-placement="top" data-content="O valor a ser recebido será automaticamente dividido pelo numero de parcelas, Podendo ser editado posteriormente.">
                                                    <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Pago ?</label>
                                            <br>
                                            <input type="checkbox" name="my-checkbox" data-on-text="Sim" data-off-text="Não" data-bootstrap-switch>
                                        </div>
                                    </div>
                                </div>
                                <h5>Parcelas</h5>
                                <hr>

                                <div class="repeater">
                                    <div data-repeater-list="contas" >
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="valor"> Valor </label>
                                                        {!! html()->text('valor')->class('form-control decimal')->placeholder('Valor total da despesa')->required() !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="vencimento"> Vencimento </label>
                                                        {!! html()->date('vencimento')->class('form-control')->placeholder('Nome da forma de pagamento') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="forma_pagamento_id">Forma de pagamento</label>
                                                    {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button data-repeater-create type="button" class=" btn btn-block btn-primary"><i class="fas fa-plus"></i></button>
                                            </div>
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
                        </div>
                    </div>
                </div>
            @endcan
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cliente_id">Cliente / Fonrcedor </label>
                        <select class="form-control cliente" name="" id=""></select>
                        {{-- {!! html()->select('cliente_id', \App\Models\Cliente\Cliente::orderBy('name')->pluck('name', 'id'))->class('form-control cliente')->placeholder('Selecione')->required() !!} --}}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Forma de pagamento</label>
                {!! html()->text('name')->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
            </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nome</th>
              <th>Descricao</th>
              <th style="width: 40px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($contas as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->descricao}}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        @can('financeiro_lancamento_edit')
                            <a href="{{ route('configuracao.financeiro.forma_pagamento.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('financeiro_lancamento_show')
                            <a href="{{ route('configuracao.financeiro.forma_pagamento.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('financeiro_lancamento_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        @endcan
                    </div>
                        @can('financeiro_lancamento_destroy')
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
                                    {!! html()->form('delete', route('configuracao.financeiro.forma_pagamento.destroy', $item->id))->open() !!}
                                        <input type="submit" class="btn btn-danger delete-permission" value="Excluir Lançamento">
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

      <!-- /.card-body -->
      <div class="card-footer clearfix">
          {{-- {{$contas->appends(['busca' => $busca])->links() }} --}}
          {{ $contas->links() }}
      </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ url('') }}/vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('') }}/vendor/select2/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />
    <style>
        .receita {
            border-top: 3px solid #12cd37;
            /* background-color: #aaceb1; */
        }

        .despesa {
            border-top: 3px solid #cd121f;
        }

    </style>
@stop

@section('js')
@routes
<script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'></script>
<script src="{{ url('') }}/vendor/select2/dist/js/i18n/pt-BR.js"></script>
<script src="{{ url('') }}/src/js/select-cliente.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // $(document).ready(function () {
       var teste =  $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show: function () {
                  $(this).slideDown();
              },
              hide: function (deleteElement) {
                  if(confirm('Você tem certeza que deseja excluir essa linha ?')) {
                      $(this).slideUp(deleteElement);
                  }
              },
        });
    // });
  </script>

<script>
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $('.decimal').mask('#.##0,00', { reverse: true });
    $('.int').mask('#0', { reverse: true });
    $('#data_info').popover({
        trigger: 'hover'
    });
</script>

@stop
