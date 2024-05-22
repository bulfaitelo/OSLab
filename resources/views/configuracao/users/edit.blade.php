@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1><i class="fas fa-users "></i> Editar Usuário</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-11 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
            </div>

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.form-alert')
            {!! html()->form('put', route('configuracao.users.update', $user->id))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-1">
                    <label for="chek_ativo">Ativo</label>
                    <div class="custom-control custom-switch custom-switch-md">
                        {!! html()->checkbox('ativo', $user->ativo)->class('custom-control-input') !!}
                        <label class="custom-control-label" for="ativo"></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="name">Usuário</label>
                        {!! html()->text('name', $user->name)->class('form-control')->placeholder('Nome do usuário')->required() !!}
                    </div>
                </div>
                @if ((file_exists(storage_path('app/public/img_perfil/' . $user->img_url))) && $user->img_url)
                    <div class="col-md-1">
                        <img class="profile-user-img img-fluid img-circle" src="/storage/img_perfil/{{$user->img_url }}" alt="User profile picture">
                    </div>
                @else
                    <img class="profile-user-img img-fluid img-circle" src="/storage/img_perfil/img_default.png" alt="User profile picture">
                @endif
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="img_perfil">Foto do perfil</label>
                        <div class="input-group">
                            <div class="custom-file">
                                {!! html()->file('img_perfil')->class('custom-file-input')->accept('.jpg, .jpeg, .png') !!}
                            </div>
                            <div class="input-group-append">
                                <label class="custom-file-label" for="img_perfil">Selecione uma foto</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
              <label for="email">Email</label>
              {!! html()->email('email', $user->email)->class('form-control')->placeholder('Email')->required() !!}
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="celular">Celular </label>
                        {!! html()->text('celular', $user->celular)->class('form-control cel')->placeholder('Celular') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        {!! html()->text('telefone', $user->telefone)->class('form-control tel')->placeholder('Telefone') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="setor_id">Setor</label>
                        {!! html()->select('setor_id', \App\Models\Configuracao\User\Setor::orderBy('name')->pluck('name', 'id'), $user->setor_id)->class('form-control')->placeholder('Selecione') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Senha </label>
                        {!! html()->password('password')->class('form-control')->placeholder('Senha') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Repita a Senha</label>
                        {!! html()->password('password_confirmation')->class('form-control')->placeholder('Repita a Senha') !!}
                    </div>
                </div>
            </div>
            <h4>Endereço:</h4>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">Cep</label>
                        {!! html()->text('cep', $user->cep)->class('form-control cep')->placeholder('CEP') !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Logradouro">Logradouro</label>
                        {!! html()->text('logradouro', $user->logradouro)->class('form-control')->placeholder('Logradouro') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        {!! html()->text('numero', $user->numero)->class('form-control')->placeholder('Número') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        {!! html()->text('bairro', $user->bairro)->class('form-control')->placeholder('Bairro') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        {!! html()->text('cidade', $user->cidade)->class('form-control')->placeholder('Cidade') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        {!! html()->text('estado', $user->estado)->class('form-control')->placeholder('Estado') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        {!! html()->text('complemento', $user->complemento)->class('form-control')->placeholder('Complemento') !!}
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
                                        <input checked class="custom-control-input" type="checkbox" id="item_{{$item->id}}" name="role[]" value="{{$item->id}}">
                                    @else
                                        <input class="custom-control-input" type="checkbox" id="item_{{$item->id}}" name="role[]" value="{{$item->id}}">
                                    @endif
                                    <label for="item_{{$item->id}}" class="custom-control-label">{{$item->name}}</label> <i> ({{ $item->description }})</i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($user->hasRole)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="departamento">Personalização de permissões</label>
                            <br>
                            <a href="{{ route('configuracao.users.permissions_edit', $user->id) }}">
                            <button type="button"  class="btn  btn-success">
                                <i class="fas fa-layer-group"></i>
                                Configurar Permissões
                            </button>
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="expire_at">Validade do acesso</label>
                            {!! html()->date('expire_at', $user->expire_at)->class('form-control')->placeholder('Validade do acesso, define a data limite de uso do sistema') !!}
                        </div>
                    </div>
                </div>

            @endcan

          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-oslab">
                <i class="fas fa-save"></i>
                Salvar
            </button>
          </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}

      </div>

</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 0000#-0000');
            $('.tel').mask('(00) 0000-0000');
        });
    </script>
    {{-- BUSCA CEP --}}
    <script>
        $(document).ready(function() {
          $('#cep').blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep.length == 8) {
              $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                if (!("erro" in data)) {
                  $('#logradouro').val(data.logradouro);
                  $('#bairro').val(data.bairro);
                  $('#cidade').val(data.localidade);
                  $('#estado').val(data.uf);
                  $('#cep').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                  $('#numero').focus();
                } else {
                    $('#cep').removeClass('is-valid').removeClass('is-invalid').addClass('is-invalid');
                }
              });
            }
          });
        });
      </script>
@stop
