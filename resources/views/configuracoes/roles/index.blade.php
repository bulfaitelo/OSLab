@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <h1>Configuração de Perfis</h1>
@stop

@section('content')
<div class="col-md-12">  
  <div class="card">
    <div class="card-header">
      <div class="row"></div>
      <a href="{{ route('configuracoes.roles.create') }}">
        <button type="button"  class="btn  btn-primary">Criar Perfil</button>
      </a>
      <a href="{{ route('configuracoes.permissions.index') }}">
        <button type="button"  class="btn btn-success ">Listar Permissões</button>
      </a>
    </div>
    <!-- /.card-header -->      
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Nome da permissão</th>
            <th>Descrição</th>
            <th style="width: 40px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
            <tr>
              <td>{{ $role->id }}</td>
              <td>{{ $role->name}}</td>
              <td>{{ $role->description}}</td>                
              <td>
                <div class="btn-group">                                        
                  <a href="{{ route('configuracoes.roles.edit', $role->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                  <a href="{{ route('configuracoes.roles.assign', $role->id) }}" title="Editar permissões" class="btn btn-left btn-success"><i class="fas fa-layer-group"></i></a>
                  <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $role->id }}"><i class="fas fa-trash"></i></button>                                    
                </div>
                <div class="modal fade" id="modal-excluir_{{ $role->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Realmente deseja Excluir?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><b>Nome:</b> {{ $role->name}}</p>
                        @if ($role->description)
                        <p><b>Descrição:</b> {{ $role->description}}</p>
                        @endif                          
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                      
                        {!! Form::open(['route' => ['configuracoes.roles.destroy', $role->id], 'method' => 'delete']) !!}                          
                          <input type="submit" class="btn btn-danger delete-role" value="Delete Perfil">                           
                        {!! Form::close() !!}

                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
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
     
        {{-- {{$pacientes->appends(['busca' => $busca])->links() }}	 --}}
        {{-- {{$roles->links() }}	 --}}

    </div>
  </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <script>
      @if(session('success'))
            $(document).Toasts('create', {
                      class: 'bg-success',
                      title: 'Cadastro realizado com Sucesso!',
                      subtitle: '',
                      autohide: true,
                      delay: 2000,
                      body: '{{Session::get("mensagem")}}'
            })
      @endif
    </script>
@stop