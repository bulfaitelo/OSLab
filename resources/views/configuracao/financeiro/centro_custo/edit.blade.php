@extends('adminlte::page')

@section('title', 'Editar Centro de custo')

@section('content_header')
    <h1><i class="fas fa-cubes "></i> Editar Centro de custo</h1>
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
            {!! html()->form('put', route('configuracao.financeiro.centro_custo.update', $centroCusto->id))->open() !!}
            <div class="form-group">
                <label for="name">Centro de Custo</label>
                {!! html()->text('name', $centroCusto->name)->class('form-control')->placeholder('Centro de Custo') !!}
              </div>
              <div class="form-group">
                  <label for="descricao">Descrição</label>
                  {!! html()->text('descricao', $centroCusto->descricao)->class('form-control')->placeholder('Descrição do centro de custo') !!}
              </div>
              <h4>Tipo de Centro de Custo:</h4>
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-on-success custom-switch custom-switch-md">
                              {!! html()->checkbox('receita', $centroCusto->receita)->class('custom-control-input ') !!}
                              <label class="custom-control-label" for="receita">Receita</label>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-on-danger custom-switch custom-switch-md">
                              {!! html()->checkbox('despesa', $centroCusto->despesa)->class('custom-control-input ') !!}
                              <label class="custom-control-label" for="despesa">Despesa</label>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
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
<style>
    .custom-switch.custom-switch-md .custom-control-label {
        padding-left: 2rem;
        padding-bottom: 1.5rem;
    }

    .custom-switch.custom-switch-md .custom-control-label::before {
        height: 1.5rem;
        width: calc(2rem + 0.75rem);
        border-radius: 3rem;
    }

    .custom-switch.custom-switch-md .custom-control-label::after {
        width: calc(1.5rem - 4px);
        height: calc(1.5rem - 4px);
        border-radius: calc(2rem - (1.5rem / 2));
    }

    .custom-switch.custom-switch-md .custom-control-input:checked ~ .custom-control-label::after {
        transform: translateX(calc(1.5rem - 0.25rem));
    }
</style>
@stop

@section('js')
@stop
