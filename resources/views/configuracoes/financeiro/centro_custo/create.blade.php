@extends('adminlte::page')

@section('title', 'Criando Centro de custo')

@section('content_header')
    <h1>Criando Centro de custo</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">

          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.alert')
          {!! Form::open(['route' => ['configuracoes.financeiro.centro_custo.store']]) !!}
            <div class="form-group">
              <label for="name">Centro de Custo</label>
              {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Centro de Custo']) !!}
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                {!! Form::text('descricao', '', ['id' => 'descricao', 'class' => 'form-control', 'placeholder' => 'Descrição do centro de custo']) !!}
            </div>
            <h4>Tipo de Centro de Custo:</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-success">
                            {!! Form::checkbox('receita', true, '', ['id'=> 'receita', 'class'=>'custom-control-input ']) !!}
                            <label class="custom-control-label" for="receita">Receita</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-danger">
                            {!! Form::checkbox('despesa', true, '0', ['id'=> 'despesa', 'class'=>'custom-control-input ']) !!}
                            <label class="custom-control-label" for="despesa">Despesa</label>
                        </div>
                    </div>
                </div>
            </div>


          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      <!-- /.card -->
      {!! Form::close() !!}
      </div>

</div>
@stop

@section('css')
@stop

@section('js')
@stop