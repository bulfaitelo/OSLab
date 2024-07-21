@extends('adminlte::page')

@section('title', 'Editar Wiki')

@section('content_header')
    <h1 class="d-inline"><i class="fa-solid fa-book "></i> Editar Wiki</h1>
@stop
{{-- Texto de ajuda --}}
@section('content_header_help_content', 'Caso precise alterar algum dado do dispositivo cadastrado, utilize os campos a seguir.')
{{-- Titulo (Opcional)--}}
{{-- @section('content_header_help_title', 'titulo') --}}

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-12">
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
            {!! html()->form('put', route('wiki.update', $wiki))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fabricante_id">Fabricante <span class="required-span" title="Este campo é obrigatório">*</span></label>
                        <div class="input-group mb-3">
                            {!! html()->select('fabricante_id', \App\Models\Configuracao\Wiki\Fabricante::orderBy('name')->pluck('name', 'id'),$wiki->fabricante_id)->class('form-control')->placeholder('Selecione')->required() !!}
                            @can('config_wiki_fabricante_create')
                                <span class="input-group-append">
                                    <a href="{{ route('configuracao.wiki.fabricante.create') }}" target="_blank" >
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </a>
                                </span>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome do Dispositivo</label>
                        {!! html()->text('name', $wiki->name)->class('form-control')->placeholder('Ex. Galaxy A52, Dell Inspiron 5548. ')->required() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        {!! html()->select('categoria_id', \App\Models\Configuracao\Parametro\Categoria::orderBy('name')->pluck('name', 'id'), $wiki->categoria_id)->class('form-control')->placeholder('Selecione')->required() !!}
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
@stop
