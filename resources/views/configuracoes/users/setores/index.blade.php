@extends('adminlte::page')

@section('title', 'Setor')

@section('content_header')
    <h1>Configuração de Setor</h1>
@stop

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="row"></div>
      @can('config_user_setor_create')
        <a href="{{ route('configuracoes.user.setor.create') }}">
          <button type="button"  class="btn  btn-primary">Criar setor</button>
        </a>
      @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Setor</th>
            <th>Departamento</th>
            <th>Usuários</th>
            <th style="width: 40px"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($setores as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->departamento->departamento ?? ''}}</td>
              <td>{{$item->users->count()}}</td>
              <td>
                <div class="btn-group">
                  @can('config_user_setor_edit')
                  <a href="{{ route('configuracoes.user.setor.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
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
                          {!! Form::open(['route' => ['configuracoes.user.setor.destroy', $item->id], 'method' => 'delete']) !!}
                            <input type="submit" class="btn btn-danger delete-setor" value="Delete setor">
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
        {{$setores->links() }}

    </div>
  </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
  @if(session('success'))
        $(document).Toasts('create', {
                  class: 'bg-success',
                  title: 'Cadastro realizado com Sucesso!',
                  subtitle: '',
                  autohide: true,
                  delay: 2000,
                  body: '{{Session::get("success")}}'
        })
  @elseif(session('warning'))
        $(document).Toasts('create', {
                  class: 'bg-warning',
                  title: 'Ocorreu um erro!',
                  subtitle: '',
                  autohide: true,
                  delay: 2000,
                  body: '{{Session::get("warning")}}'
        })
  @endif
</script>
@stop
