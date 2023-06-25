@extends('adminlte::page')

@section('title', 'Perfil editar dados ')

@section('content_header')
    <h1>Editar perfil </h1>
@stop

@section('content')

<div class=" row justify-content-md-center">
    <div class="col-md-10 ">
        <div class="card ">
            <div class="card-header">
              <h3 class="card-title">Seus Dados</h3>
            </div>
            {!! html()->form('put', route('configuracao.user.perfil.update'))->open() !!}
            <div class="card-body">
                @include('adminlte::partials.form-alert')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    {!! html()->text('name', \Auth::user()->name)->class('form-control')->placeholder('Nome do usuário')->required() !!}
                </div>
                <div class="form-group">
                    <label for="email">Setor</label>
                    <input disabled value="{{ \Auth::user()->setor->name ?? '' }}" type="email" class="form-control" id="email" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input disabled value="{{ \Auth::user()->email }}" type="email" class="form-control" id="email" >
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
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            {!! html()->form()->close() !!}
        </div>

    </div>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
