@extends('adminlte::page')

@section('title', 'Atribuindo Permissões')

@section('content_header')
    <h1>Atribuindo Permissões</h1>
@stop

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-10">
    <div class="card card-default">
      <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn  btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
    </div>

    <div class="card-body">
        @include('adminlte::partials.form-alert')
        {!! html()->form('put', route('configuracao.roles.assign.update', $role->id))->open() !!}
          <div class="row">
            <h4>Selecione as Permissões:</h4>
            <div class="col-sm-12">
              <!-- checkbox -->
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

                            @if ($role->hasPermissionTo($permission->id))
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
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
        </div>
        {!! html()->form()->close() !!}
      <!-- /.card-body -->

    </div>
  </div>
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
    .red{
    color: red;
    }
    </style>
@stop

@section('js')
@stop
