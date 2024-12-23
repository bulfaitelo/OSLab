@extends('adminlte::page')

@section('title', 'Visualizar Meta Contábil')

@section('content_header')
    <h1> <i class="fa-regular fa-chart-bar "></i> Visualizar Meta Contábil</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-12 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body table-responsive">
                <table class="table table-sm table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th>Nome</th>
                        <th style="width: 110px" class="text-right">Valor Previsto</th>
                        <th style="width: 50px">Tipo de Meta</th>
                        <th style="width: 50px">Liquido</th>
                        <th style="width: 100px">Intervalo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $metaContabil->name}}</td>
                            <td class="text-right">{{ $metaContabil->valor_meta}}</td>
                            <td>
                                <h5>
                                    @if ($metaContabil->tipo_meta == 'R')
                                        <span class="badge bg-success">Receita</span>
                                    @endif
                                    @if ($metaContabil->tipo_meta == 'D')
                                        <span class="badge bg-danger">Despesa</span>
                                    @endif
                                </h5>
                            </td>
                            <td class="text-center">
                                @if ($metaContabil->meta_liquida == 1)
                                <i class="fa-solid fa-check" style="color: #4a42d3;"></i>
                                @endif
                            </td>
                            <td>{{ $metaContabil->intervalo}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-sm table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th>Período</th>
                        <th style="width: 110px" class="text-right">Valor Executado</th>
                        <th style="width: 110px" class="text-right">Valor Previsto</th>
                        <th>Progresso</th>
                        <th style="width: 45px" class="">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($metaContabil->getMetaExecutadaTable() as $item)
                        <tr>
                            <td>{{ $item->mes}}{{ ($item->mes) ? '/' : '' }}{{ $item->ano}}</td>
                            <td class="text-right">{{ number_format($item->executado, 2, ',', '.')}}</td>
                            <td class="text-right">{{ number_format($item->valor_meta, 2, ',', '.')}}</td>
                            <td>
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar progress-bar-striped btn-oslab" role="progressbar" style="width: {{ $item->porcentagem_executada }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge btn-oslab">{{ $item->porcentagem_executada }}%</span>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Minimal with icon only --}}
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
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
</script>
@stop
