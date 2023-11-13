@extends('adminlte::page')

@section('title', 'Ordem de Serviço')

@section('content_header')
    <h1><i class="fa-regular fa-rectangle-list "> </i> Ordem de Serviço</h1>
@stop

@section('content')

    <div class="card ">
        <div class="card-header card-outline card-primary pb-2 ">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('os_create')
            <a href="{{ route('os.create') }}">
                <button type="button"  class="btn btn-sm bg-primary">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar OS
                </button>
            </a>
            @endcan
            <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseExample">
                <hr>
                {{ html()->form('get', route('os.index'))->open() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="busca">Cliente / Descricao / Laudo / Defeito / Modelo</label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Cliente, Descricao, Laudo, Defeito') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="categoria_id">Categoria</label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Os\OsCategoria::orderBy('name')->pluck('name', 'id'), $request->categoria_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="periodo">Período</label>
                            {!! html()->select('periodo',['dia' => 'Dia', 'mes' => 'Mês', 'ano' => 'Ano'], $request->periodo)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="data_inicial">Data Início </label>
                            {!! html()->date('data_inicial', $request->data_inicial)->class('form-control form-control-sm')->placeholder('Nome da forma de pagamento') !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2 ">
                            <label for="data_final">Data Fim </label>
                            {!! html()->date('data_final', $request->data_final)->class('form-control form-control-sm')->placeholder('Nome da forma de pagamento') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="status">Status</label>
                            {!! html()->select('status_id', \App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), $request->status_id)->class('form-control form-control-sm')->placeholder('Selecione') !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group text-right mb-2">
                            <button type="submit"  class="btn bg-lightblue btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                            @if (count($request->all()) > 0)
                            <a href="{{ route('os.index') }}">
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
                    <th>Cliente</th>
                    <th>Técnico</th>
                    <th>Data Entrada</th>
                    <th>Data Saída</th>
                    <th>Garantia</th>
                    <th>Valor Total</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($os as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->cliente->name}}</td>
                        <td>{{ $item->tecnico?->name}}</td>
                        <td>{{ $item->data_entrada->format('d/m/Y') }}</td>
                        <td>{{ $item->data_saida?->format('d/m/Y') }}</td>
                        <td> garantia </td>
                        <td class="decimal">{{ $item->valorTotal() }}</td>
                        <td> {{ $item->categoria->name }} </td>
                        <td>
                            <span class="badge {{ $item->status->color }}">{{ $item->status->name }}</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('os_edit')
                                    <a href="{{ route('os.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('os_show')
                                    <a href="{{ route('os.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('os_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>
                                @can('os_destroy')
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
                                            {!! html()->form('delete', route('os.destroy', $item->id))->open() !!}
                                                <input type="submit" class="btn btn-danger delete-permission" value="Excluir Receita">
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
            {{$os->appends($request->all())->links() }}
            {{-- {{ $os->links() }} --}}
        </div>

</div>
@stop

@section('css')
<link href="{{ url('') }}/vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('') }}/vendor/select2/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />

<style>
    .os {
        border-top: 3px solid #39cccc;
    }
</style>
@stop

@section('js')


{{-- <script>
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

</script> --}}
@stop
