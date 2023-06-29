@extends('adminlte::page')

@section('title', 'Visualizando Usuário')

@section('content_header')
    <h1>Visualizando Usuário</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-11 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn  btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
            </div>

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <label for="chek_ativo">Ativo</label>
                    <div class="custom-control custom-switch">
                        {!! html()->checkbox('ativo', $user->ativo)->class('custom-control-input')->disabled() !!}
                        <label class="custom-control-label" for="ativo"></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="name">Usuário</label>
                        {!! html()->text('name', $user->name)->class('form-control')->placeholder('Nome do usuário')->required()->disabled() !!}
                    </div>
                </div>
                @if ((file_exists(storage_path('app/public/img_perfil/' . $user->img_url))) && $user->img_url)
                    <div class="col-md-1">
                        <img class="profile-user-img img-fluid img-circle" src="/storage/img_perfil/{{$user->img_url }}" alt="User profile picture">
                    </div>
                @else
                    <img class="profile-user-img img-fluid img-circle" src="/storage/img_perfil/img_default.png" alt="User profile picture">
                @endif
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              {!! html()->email('email', $user->email)->class('form-control')->placeholder('Email')->required()->disabled() !!}
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="celular">Celular </label>
                        {!! html()->text('celular', $user->celular)->class('form-control cel')->placeholder('Celular')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone', $user->telefone)->class('form-control tel')->placeholder('Telefone')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="setor_id">Setor</label>
                        {!! html()->select('setor_id', \App\Models\Configuracao\User\Setor::orderBy('name')->pluck('name', 'id'), $user->setor_id)->class('form-control')->placeholder('Selecione')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Senha </label>
                        {!! html()->password('password')->class('form-control')->placeholder('Senha')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Repita a Senha</label>
                        {!! html()->password('password_confirmation')->class('form-control')->placeholder('Repita a Senha')->disabled() !!}
                    </div>
                </div>
            </div>
            <h4>Endereço:</h4>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Cep</label>
                        {!! html()->text('cep', $user->cep)->class('form-control cep')->placeholder('CEP')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Logradouro">Logradouro</label>
                        {!! html()->text('logradouro', $user->logradouro)->class('form-control')->placeholder('Logradouro')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        {!! html()->text('numero', $user->numero)->class('form-control')->placeholder('Número')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        {!! html()->text('bairro', $user->bairro)->class('form-control')->placeholder('Bairro')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        {!! html()->text('cidade', $user->cidade)->class('form-control')->placeholder('Cidade')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        {!! html()->text('estado', $user->estado)->class('form-control')->placeholder('Estado')->disabled() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        {!! html()->text('complemento', $user->complemento)->class('form-control')->placeholder('Complemento')->disabled() !!}
                    </div>
                </div>
            </div>
            @can('config_users_permissions_edit')
                <h4>Configurações de permissões e acesso:</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="departamento">Perfis: </label>
                            @foreach (\Spatie\Permission\Models\Role::orderBy('name')->get() as $id => $item)
                                <div class="custom-control custom-checkbox">
                                    @if ($user->hasAnyRole($item->id))
                                        <input checked class="custom-control-input" disabled  type="checkbox" id="item_{{$item->id}}" name="role[]" value="{{$item->id}}">
                                    @else
                                        <input class="custom-control-input"  disabled type="checkbox" id="item_{{$item->id}}" name="role[]" value="{{$item->id}}">
                                    @endif
                                    <label for="item_{{$item->id}}" class="custom-control-label">{{$item->name}}</label> <i> ({{ $item->description }})</i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="expire_at">Validade do acesso</label>
                            {!! html()->date('expire_at', $user->expire_at)->class('form-control')->placeholder('Validade do acesso, define a data limite de uso do sistema')->disabled() !!}
                        </div>
                    </div>
                </div>

            @endcan

          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
        </div>
      <!-- /.card -->
      </div>

</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
