@extends('adminlte::page')

@section('title', 'Movimentação - '. $produto->name)

@section('content_header')
    <h1><i class="fa-solid fa-boxes-packing"></i> Movimentação - {{ $produto->name }}</h1>
@stop

@section('content')
<div class="">
    <div class="card">
      <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="d-none d-sm-inline">Voltar</span>
                </button>
            </a>
            @can('produto_movimentacao_create')
            <a href="{{ route('movimentacao.create', $produto->id) }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    <span class="d-none d-sm-inline">Adicionar Estoque</span>
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
              <th>Quantidade Movimentada</th>
              <th>Valor de custo</th>
              <th>Tipo de movimentação</th>
              <th>Observações</th>
              <th>Data da movimentação</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($movimentacoes as $item)
              <tr>
                <td>{{ $item->quantidade_movimentada}}</td>
                <td>{{ $item->valor_custo}}</td>
                <td>{{ $item->tipo_movimentacao}}</td>
                <td>{{ $item->descricao}}</td>
                <td>{{ $item->created_at->format('H:i:s d/m/Y') }}</td>
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
@stop
