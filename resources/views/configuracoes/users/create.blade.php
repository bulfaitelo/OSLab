@extends('adminlte::page')

@section('title', 'Criando Usários')

@section('content_header')
    <h1>Criando Usários</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
          @if(count($errors) > 0)
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

          {!! Form::open(['route' => ['configuracoes.users.store']]) !!}
            <div class="form-group">
              <label for="name">Usuário</label>
              {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nome do usuário']) !!}
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              {!! Form::email('email', '', ['id' => 'description','class' => 'form-control', 'placeholder' => 'Email', ]) !!}
            </div>
            <div class="form-group">
              <label for="setor">Setor</label>
              {!! Form::select('setor', \App\Models\Configuracao\User\Setor::orderBy('name')->pluck('name', 'id'), '', ['id' => 'group','class' => 'form-control' ]) !!}
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Senha </label>
                        {!! Form::text('password', '', ['id' => 'password','class' => 'form-control', 'placeholder' => 'Nova Senha', ]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Repita a Senha</label>
                        {!! Form::text('password_confirmation', '', ['id' => 'password','class' => 'form-control', 'placeholder' => 'Repita a Nova Senha', ]) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="departamento">Perfis: </label>
                @foreach (\Spatie\Permission\Models\Role::orderBy('name')->get() as $id => $item)
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="item_{{$item->id}}" name="role[]" value="{{$item->id}}">

                        <label for="item_{{$item->id}}" class="custom-control-label">{{$item->name}}</label> <i> ({{ $item->description }})</i>
                    </div>
                @endforeach
            </div>
            {{-- @if ($user->hasRole)
                <div class="form-group">
                    <label for="departamento">Personalização de permissões</label>
                    <br>
                    <a href="{{ route('configuracoes.users.permissions_edit', $user->id) }}">
                    <button type="button"  class="btn  btn-success">Configurar Permissões</button>
                    </a>
                </div>
            @endif --}}

          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      <!-- /.card -->
      {!! Form::close() !!}

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
        @if(count($errors) > 0)
          $(document).Toasts('create', {
                  class: 'bg-danger',
                  title: 'Ocorreu um erro',
                  subtitle: '',
                  autohide: true,
                  delay: 2000,
                  body: 'Por favor verifique o formulário'
          })
        @endif
    </script>
@stop
