@extends('adminlte::page')

@section('title', 'Movimentação - '. $produto->name)

@section('content_header')
    <h1><i class="fa-solid fa-boxes-packing"></i> Movimentação - {{ $produto->name }}</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn  btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('produto_movimentacao_create')
            <a href="{{ route('movimentacao.create', $produto->id) }}">
                <button type="button"  class="btn  btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Estoque
                </button>
            </a>
            @endcan
            {{-- <a href="{{ route('movimentacao.edit', $produto) }}">
                <button type="button"  class="btn  btn-warning">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Corrigir Estoque
                </button>
            </a> --}}
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Quantidade Movimentada</th>
              <th>Valor de custo</th>
              <th>Tipo de movimentação</th>
              <th>Data da movimentação</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($movimentacoes as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->quantidade_movimentada}}</td>
                <td class="decimal">{{ $item->valor_custo}}</td>
                <td>{{ $item->tipo_movimentacao}}</td>
                <td>{{ $item->created_at }}</td>
              </tr>

            @endforeach
          </tbody>
        </table>
      </div>

      <!-- /.card-body -->
      <div class="card-footer clearfix">
          {{-- {{$movimentacoes->appends(['busca' => $busca])->links() }} --}}
          {{ $movimentacoes->links() }}
      </div>
    </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
@stop
