@extends('adminlte::page')

@section('title', 'Setor')

@section('content_header')
    <h1>Configuração de Setor</h1>
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
        @can('config_user_setor_create')
            <a href="{{ route('configuracao.user.setor.create') }}">
                <button type="button"  class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Criar setor
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
            <th>Setor</th>
            <th>Usuários</th>
            <th style="width: 40px"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($setores as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{$item->users->count()}}</td>
              <td>
                <div class="btn-group btn-group-sm ">
                  @can('config_user_setor_edit')
                  <a href="{{ route('configuracao.user.setor.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                  @endcan

                  @can('config_user_setor_destroy')
                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                  @endcan
                </div>
                @can('config_user_setor_destroy')
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
                          <p><b>Setor:</b> {{ $item->name}}</p>
                          @if ($item->descricao)
                          <p><b>Descrição:</b> {{ $item->descricao}}</p>
                          @endif
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          {!! html()->form('delete', route('configuracao.user.setor.destroy', $item->id))->open() !!}
                            <input type="submit" class="btn btn-danger delete-setor" value="Delete setor">
                          {!! html()->form()->close() !!}

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
        {{$setores->links() }}

    </div>
  </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
