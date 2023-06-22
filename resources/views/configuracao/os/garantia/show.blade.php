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
          <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                  <label for="name">Nome da Garantia</label>
                  {!! Form::text('name', $garantia->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nome da Garantia', 'disabled' ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="prazo_garantia">Prazo de garantia</label>
                    <div class="input-group mb-3">
                        {!! Form::text('prazo_garantia', $garantia->prazo_garantia, ['id' => 'prazo_garantia', 'class' => 'form-control code', 'placeholder' => 'Prazo de garantia', 'disabled']) !!}
                        <div class="input-group-append">
                        <span class="input-group-text">Dias</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
            <div class="form-group">
                <label for="garantia">Termo de Garantia</label>
                {!! $garantia->garantia !!}
            </div>


          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->

        </div>
      <!-- /.card -->

      </div>

</div>
@stop

@section('css')
@stop

@section('js')
@stop