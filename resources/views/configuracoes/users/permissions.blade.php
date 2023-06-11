@extends('adminlte::page')

@section('title', 'Atribuindo Permissões')

@section('content_header')
    <h1>Personalizando Permissões - <b>{{ $user->name }}</b></h1>
@stop

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-10">

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Selecione as permissões </h3>

      </div>
      <!-- /.card-header -->
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
      <div class="card-body">
        {!! Form::open(['route' => ['configuracoes.users.permissions.update', $user->id],'method' => 'put']) !!}
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <?php $active = "active"?>
                    <?php $selected = "true"?>
                    @foreach ($groups as $group_singular)

                      <li class="nav-item">
                        <a class="nav-link {{$active}}" id="xablau_{{@$group_singular->group_id}}-tab" data-toggle="pill" href="#xablau_{{@$group_singular->group_id}}" role="tab" aria-controls="xablau_{{@$group_singular->group_id}}-ref" aria-selected="{{$selected}}">{{$group_singular->name}}</a>
                      </li>
                    {{ $active = ''}}
                    <?php $selected = "false"?>
                    @endforeach
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-four-tabContent">
                    <?php $active = "active show"?>
                    <?php $selected = "true"?>

                    @foreach ($groups as $group_singular)
                      <div class="tab-pane fade {{$active}}" id="xablau_{{@$group_singular->group_id}}" role="tabpanel" aria-labelledby="xablau_{{@$group_singular->group_id}}-tab">
                        @foreach ($permissions::where('group_id', $group_singular->group_id)->orderBy('name')->get() as $permission)
                        <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            @if (($user->hasPermissionTo($permission->id) == true) and ($roles->hasPermissionTo($permission->id)  == true))
                              <input disabled checked class="custom-control-input" name="assign_id[]" type="checkbox" id="{{ $permission->id }}" value="{{ $permission->id }}">
                            @elseif ($user->hasPermissionTo($permission->id))
                              <input checked class="custom-control-input" name="assign_id[]" type="checkbox" id="{{ $permission->id }}" value="{{ $permission->id }}">
                            @else
                              <input  class="custom-control-input" name="assign_id[]" type="checkbox" id="{{ $permission->id }}" value="{{ $permission->id }}">
                            @endif
                            <label for="{{ $permission->id }}" class="custom-control-label"> [{{ @$group::find($permission->group_id)->name }}] - {{$permission->name}}  </label>,
                            {{$permission->description}}
                          </div>
                        </div>
                        @endforeach
                        {{ $active = ''}}
                      </div>
                    @endforeach

                  </div>
                </div>
                <!-- /.card -->
              </div>


          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        {!! Form::close() !!}
      <!-- /.card-body -->
    </div>
  </div>
</div>

<div class="row justify-content-md-center">
  <div class="col-md-10">

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
                    body: '{{Session::get("success")}}'
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
