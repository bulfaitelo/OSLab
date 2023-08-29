@extends('adminlte::page')

@section('title', 'Criar Centro de custo')

@section('content_header')
    <h1><i class="fas fa-cubes "></i> Criar Centro de custo</h1>
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
            {!! html()->form('post', route('configuracao.financeiro.centro_custo.store'))->open() !!}
            <div class="form-group">
              <label for="name">Centro de Custo</label>
              {!! html()->text('name')->class('form-control')->placeholder('Centro de Custo') !!}
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                {!! html()->text('descricao')->class('form-control')->placeholder('Descrição do centro de custo') !!}
            </div>
            <h4>Tipo de Centro de Custo:</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-success">
                            {!! html()->checkbox('receita')->class('custom-control-input ') !!}
                            <label class="custom-control-label" for="receita">Receita</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-danger">
                            {!! html()->checkbox('despesa')->class('custom-control-input ') !!}
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
@stop

@section('js')
@stop
