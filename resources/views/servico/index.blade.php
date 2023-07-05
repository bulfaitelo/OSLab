@extends('adminlte::page')

@section('title', 'Serviços')

@section('content_header')
    <h1>Serviços</h1>
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
            @can('servico_create')
            <a href="{{ route('servico.create') }}">
                <button type="button"  class="btn  btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Serviço
                </button>
            </a>
            @endcan
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Serviço</th>
              <th>Valor</th>
              <th style="width: 40px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($servicos as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name}}</td>
                <td class="decimal">{{ $item->valor_servico}}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        @can('servico_edit')
                            <a href="{{ route('servico.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('servico_show')
                            <a href="{{ route('servico.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('servico_destroy')
                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                    </div>
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
                                    {!! html()->form('delete', route('servico.destroy', $item->id))->open() !!}
                                        <input type="submit" class="btn btn-danger delete-permission" value="Excluir Cliente">
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
          {{-- {{$Serviços->appends(['busca' => $busca])->links() }} --}}
          {{ $servicos->links() }}
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
