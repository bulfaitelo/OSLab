@extends('adminlte::page')

@section('title', 'Wiki')

@section('content_header')
    <h1><i class="fa-solid fa-book "></i> Wiki</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('wiki_create')
            <a href="{{ route('wiki.create') }}">
                <button type="button"  class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Wiki
                </button>
            </a>
            @endcan
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nome</th>
              <th>Modelos</th>
              <th>Categoria Padrão</th>
              <th>Criado pelo usuario</th>
              <th style="width: 40px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($wikis as $item)
              <tr >
                <td>{{ $item->id }}</td>
                <td>
                    @can('wiki_show')
                        <a href="{{ route('wiki.show', $item->id) }}">
                            {{ $item->name}}
                        </a>
                    @else()
                        {{ $item->name}}
                    @endcan
                </td>
                <td>
                    @can('wiki_show')
                        <a href="{{ route('wiki.show', $item->id) }}">
                            {{ $item->modelosTitle()}}
                        </a>
                    @else()
                        {{ $item->modelosTitle()}}
                    @endcan
                </td>
                <td>{{ $item->categoria->name}}</td>
                <td>{{ $item->user->name}}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        @can('wiki_show')
                            <a href="{{ route('wiki.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('wiki_edit')
                            <a href="{{ route('wiki.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('wiki_destroy')
                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        @endcan
                    </div>
                        @can('wiki_destroy')
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
                                        {!! html()->form('delete', route('wiki.destroy', $item->id))->open() !!}
                                            <input type="submit" class="btn btn-danger delete-permission" value="Excluir Wiki">
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
          {{-- {{$Wiki->appends(['busca' => $busca])->links() }} --}}
          {{ $wikis->links() }}
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
