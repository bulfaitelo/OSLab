@extends('adminlte::page')

@section('title', 'Despesas')

@section('content_header')
    <h1>Despesas</h1>
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
            @can('financeiro_despesa_create')
            <a href="{{ route('financeiro.despesa.create') }}">
                <button type="button"  class="btn  btn-danger" data-toggle="modal" data-target="#modal-despesa">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Despesa
                </button>
            </a>
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


              <label for="parcelas">Número de Parcelas:</label>
              <input type="number" id="parcelas" name="parcelas" min="1" value="1" />

      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Despesa</th>
              <th>Cliente/ Fornecedor</th>
              <th>Centro de Custo</th>
              <th>Total</th>
              <th>Valor Pago</th>
              <th>Valor Pendente</th>
              <th>Parcelas</th>
              <th>Dia Vencimento</th>
              <th>Quitação</th>
              <th style="width: 40px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($despesas as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->cliente->name}}</td>
                <td>{{ $item->centroCusto->name}}</td>
                <td>R$ {{ number_format($item->valor, 2, ',', '.')}}</td>
                <td>R$ {{ number_format($item->pagamentos()->whereNotNull('data_pagamento')->sum('valor'), 2, ',', '.')}}</td>
                <td>R$ {{ number_format($item->valor - $item->pagamentos()->whereNotNull('data_pagamento')->sum('valor'), 2, ',', '.')}}</td>
                <td>{{ $item->parcelas}}</td>
                <td>{{ $item->getVencimentoDate()}}</td>
                <td>{{ $item->data_quitacao?->format('d/m/Y') ?? ''}}</td>



                <td>
                    <div class="btn-group btn-group-sm">
                        @can('financeiro_despesa_edit')
                            <a href="{{ route('financeiro.despesa.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('financeiro_despesa_show')
                            <a href="{{ route('financeiro.despesa.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('financeiro_despesa_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        @endcan
                    </div>
                        @can('financeiro_despesa_destroy')
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
                                    {!! html()->form('delete', route('financeiro.despesa.destroy', $item->id))->open() !!}
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

      <!-- /.card-body -->
      <div class="card-footer clearfix">
          {{-- {{$despesas->appends(['busca' => $busca])->links() }} --}}
          {{ $despesas->links() }}
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

@stop
