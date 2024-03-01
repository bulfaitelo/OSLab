{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Balancete')

@section('content_header')
    <h1><i class="fas fa-balance-scale "></i> Balancete</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
        @include('oslab.relatorio.listar-request')
        <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{-- OS --}}
            @if ( isset($osRelatorio) && ($osRelatorio->count() > 0))
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Previsto</th>
                        <th>Crédito</th>
                        <th>Débito</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($osRelatorio as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->data_entrada }}</td>
                        <td>{{ $item->valor_total }}</td>
                        <td>{{ $item->credito }}</td>
                        <td>{{ $item->debito }}</td>
                        <td>{{ $item->saldo }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

        </div>
        <div class="card-footer">
            footer

        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
