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
                <div class="form-group">
                    <label for="matricula">Matricula</label>
                    <input disabled value="{{ \Auth::user()->matricula }}" type="text" class="form-control" id="matricula" placeholder="Digite sua matricula">
                    <i>Caso nao saiba sua matricula se informe com o setor Pessoal</i>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                  <a href="{{ route('configuracoes.user.perfil.edit') }}">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </a>
              </div>
          </div>
    </div>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
