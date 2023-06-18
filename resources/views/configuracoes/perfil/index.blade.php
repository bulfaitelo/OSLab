@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>DNCN - Perfil</h1>
@stop

@section('content')

<div class=" row justify-content-md-center">
    <div class="col-md-10 ">
        <div class="card ">
            <div class="card-header">
              <h3 class="card-title">Seus Dados</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input disabled type="text" value="{{ \Auth::user()->name }}" class="form-control" id="nome" >
                </div>
                <div class="form-group">
                    <label for="email">Setor</label>
                    <input disabled value="{{ \Auth::user()->setor->name ?? '' }}" type="email" class="form-control" id="email" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input disabled value="{{ \Auth::user()->email }}" type="email" class="form-control" id="email" >
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                @can('config_perfil_edit')
                    <a href="{{ route('configuracoes.user.perfil.edit') }}">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </a>
                @endcan
              </div>
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
