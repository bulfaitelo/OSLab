@extends('adminlte::page')

@section('title', 'Visualizar Termo de Garantia')

@section('content_header')
    <h1><i class="fas fa-shield-alt "></i> Visualizar Termo de Garantia</h1>
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
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                      <label for="name">Nome da Garantia</label>
                      {!! html()->text('name', $garantia->name)->class('form-control')->placeholder('Nome da Garantia')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="prazo_garantia">Prazo de garantia</label>
                        <div class="input-group mb-3">
                            {!! html()->text('prazo_garantia', $garantia->prazo_garantia)->class('form-control code')->placeholder('Prazo de garantia')->disabled() !!}
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
