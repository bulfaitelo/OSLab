@extends('adminlte::page')

@section('title', 'Editar Status')

@section('content_header')
    <h1><i class="fas fa-wave-square "></i> Editar Status</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
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
          {!! html()->form('PUT', route('configuracao.os.status.update', $status->id))->open() !!}
            <div class="form-group">
              <label for="name">Status</label>
              {!! html()->text('name', $status->name)->class('form-control')->placeholder('Status')->required() !!}
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                {!! html()->text('descricao', $status->descricao)->class('form-control')->placeholder('Descrição') !!}
            </div>
            <div class="form-group">
                <label>Cor</label>
                <br>
                @foreach ($cor_array as $cor)
                <div class="form-check  form-check-inline">
                    <label for="{{$cor}}">
                        <span class="right badge {{$cor}}">
                            <input @if ($cor == $status->color)
                                checked
                            @endif type="radio" name="color" style='margin:4px' value="{{$cor}}" id="{{$cor}}">
                        </span>
                    </label>
                </div>
            @endforeach
            </div>
            <div class="form-group">
                <label for="garantia_id">Modelo de Email</label>
                {{-- {!! Form::select('email_id', \App\Models\Configuracao\Os\Garantia::orderBy('name')->pluck('name', 'id'), '', ['id' => 'garantia_id','class' => 'form-control', 'placeholder'=> 'Selecione' ]) !!} --}}
            </div>
            <h4>Notificações via Email</h4>
            <div class="row">
                <div class="col-md-2">
                    <label for="chek_ativo">Enviar email?</label>
                    <div class="custom-control custom-switch">
                        {!! html()->checkbox('ativar_email', $status->ativar_email)->class('custom-control-input') !!}
                        <label class="custom-control-label" for="ativar_email"> </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="prazo_email">Prazo para envio</label>
                    <div class="input-group">
                        {!! html()->text('prazo_email', $status->prazo_email)->class('form-control')->placeholder('Prazo D + X') !!}
                        <div id="data_info" class="input-group-append" data-container="body" data-toggle="popover" data-placement="right" data-content="Define a data de envio, por exemplo: Caso seja o valor 10, após 10 dias da alteração do status será enviado um email.">
                            <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                        </div>
                    </div>
                </div>

            </div>
            <h4>Ativar Campos Personalizados na Os</h4>
            <div class="row">
                <div class="col-md-2">
                    <label for="chek_ativo">Rastreio de Objetos</label>
                    <div class="custom-control custom-switch">
                        {!! html()->checkbox('ativar_rastreio', $status->ativar_rastreio)->class('custom-control-input') !!}
                        <label class="custom-control-label" for="ativar_rastreio"> </label>
                    </div>
                </div>
            </div>
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
@stop

@section('js')
<script>
    $('#data_info').popover({
    trigger: 'hover'
    });
</script>
@stop
