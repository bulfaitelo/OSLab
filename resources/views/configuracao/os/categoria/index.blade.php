@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1>Configuração de Categoria</h1>
@stop

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="row"></div>
      @can('config_os_categoria_create')
        <a href="{{ route('configuracao.os.categoria.create') }}">
          <button type="button"  class="btn btn-primary">Criar Categoria</button>
        </a>
      @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Categoria</th>
            <th>Garantia</th>
            <th style="width: 40px"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categoria as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->garantia->name }}</td>
              <td>
                <div class="btn-group">
                @can('config_os_categoria_edit')
                <a href="{{ route('configuracao.os.categoria.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                @endcan
                @can('config_os_categoria_show')
                    <a href="{{ route('configuracao.os.categoria.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                @endcan
                @can('config_os_categoria_destroy')
                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                @endcan
                </div>
                @can('config_os_categoria_destroy')
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
                          <p><b>Categoria:</b> {{ $item->name}}</p>
                          @if ($item->descricao)
                          <p><b>Descrição:</b> {{ $item->descricao}}</p>
                          @endif
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          {!! Form::open(['route' => ['configuracao.os.categoria.destroy', $item->id], 'method' => 'delete']) !!}
                            <input type="submit" class="btn btn-danger delete-setor" value="Delete Categoria">
                          {!! Form::close() !!}

                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                @endcan
              </td>
            </tr>


          @empty
          <tr>
            <td colspan="5" > <h4>Não existem registros</h4></td>
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{-- {{$pacientes->appends(['busca' => $busca])->links() }}	 --}}
        {{$categoria->links() }}
    </div>
  </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
