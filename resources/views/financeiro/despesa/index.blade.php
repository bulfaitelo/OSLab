@extends('adminlte::page')

@section('title', 'Despesas')

@section('content_header')
    <h1><i class="fa-solid fa-money-bill"></i> Despesas</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        <div class="card-header despesa pb-2 ">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('financeiro_despesa_create')
            <a href="{{ route('financeiro.despesa.create') }}">
                <button type="button"  class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Despesa
                </button>
            </a>
            @endcan
            <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseFiltros">
                <hr>
                {{ html()->form('get', route('financeiro.despesa.index'))->open() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="busca">Cliente / Despesa / Observação </label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Cliente, Despesa, Observação') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="centro_custo">Centro de Custo</label>
                            {!! html()->select('centro_custo', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'), $request->centro_custo)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="periodo">Período</label>
                            {!! html()->select('periodo',['dia' => 'Dia', 'mes' => 'Mês', 'ano' => 'Ano'], $request->periodo)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="data_inicial"> Data Início </label>
                            {!! html()->date('data_inicial', $request->data_inicial)->class('form-control form-control-sm')->placeholder('Nome da forma de pagamento') !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="data_final"> Data Fim </label>
                            {!! html()->date('data_final', $request->data_final)->class('form-control form-control-sm')->placeholder('Nome da forma de pagamento') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="status">Status</label>
                            {!! html()->select('status',['quitado' => 'Quitado',  'aberto' => 'Em aberto'], $request->status)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group text-right mb-2">
                            <button type="submit"  class="btn bg-lightblue btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                            @if (count($request->all()) > 0)
                            <a href="{{ route('financeiro.despesa.index') }}">
                                <button type="button"  class="btn bg-gray btn-sm">
                                    <i class="fa-solid fa-xmark"></i>
                                    Limpar
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-2 table-responsive">
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
                        {{-- <th>Dia Vencimento</th> --}}
                        <th>Quitação</th>
                        <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($despesas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td title="{{ $item->name }}">{{ Str::limit($item->name, 50) }}</td>
                        <td>{{ $item->cliente->name }}</td>
                        <td>{{ $item->centroCusto->name }}</td>
                        <td class="text-right" >R$ {{ number_format($item->valor, 2, ',', '.')}}</td>
                        <td class="text-right" >R$ {{ number_format($item->pagamentos->whereNotNull('data_pagamento')->sum('valor'), 2, ',', '.')}}</td>
                        <td class="text-right" >R$ {{ number_format($item->valor - $item->pagamentos->whereNotNull('data_pagamento')->sum('valor'), 2, ',', '.')}}</td>
                        <td class="text-center">{{ $item->parcelas}}</td>
                        {{-- <td>{{ $item->getVencimentoDate()}}</td> --}}
                        <td>{{ $item->data_quitacao?->format('d/m/Y') ?? ''}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('financeiro_despesa_edit')
                                    <a href="{{ route('financeiro.despesa.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('financeiro_despesa_show')
                                    <a href="{{ route('financeiro.despesa.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('financeiro_despesa_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('financeiro.despesa.destroy', $item->id)}}" data-target="#modal-excluir" ><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>
                        <!-- /.modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right" colspan="4">
                            Totais:
                        </th>
                        <th class="text-right">
                            R$ {{ number_format($despesas->sum('valor'), 2, ',', '.')}}
                        </th>
                        <th colspan="5" ></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{$despesas->appends($request->all())->links() }}
            {{-- {{ $despesas->links() }} --}}
        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('financeiro_despesa_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
    {{-- // Modal Excluir --}}
</div>
@stop

@section('css')
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

<script>
$(document).ready(function() {
  $("#periodo").change(function() {
    var periodoSelecionado = $(this).val();
    var dataHoje = new Date().toISOString().split('T')[0];

    switch (periodoSelecionado) {
      case 'dia':
        $("#data_inicial").val(dataHoje);
        $("#data_final").val(dataHoje);
        break;
      case 'mes':
        var primeiroDiaMes = new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().split('T')[0];
        var ultimoDiaMes = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).toISOString().split('T')[0];
        $("#data_inicial").val(primeiroDiaMes);
        $("#data_final").val(ultimoDiaMes);
        break;
      case 'ano':
        var primeiroDiaAno = new Date(new Date().getFullYear(), 0, 1).toISOString().split('T')[0];
        var ultimoDiaAno = new Date(new Date().getFullYear(), 11, 31).toISOString().split('T')[0];
        $("#data_inicial").val(primeiroDiaAno);
        $("#data_final").val(ultimoDiaAno);
        break;
    }
  });
});

</script>
@stop
