{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Home')

@section('content_header')
    <h1>OSLAB - Home</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-9 ">
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
            <div class="card-body">
                {!! html()->form('post', route('configuracao.wiki.modelo.store'))->open() !!}
                    <div class="form-group">
                        <label for="name">Modelo</label>
                        {!! html()->text('name')->class('form-control')->placeholder('Modelo do aparelho')->required() !!}
                    </div>
                    <div class="form-group">
                        <label for="wiki_id">Wiki</label>
                        {!! html()->select('wiki_id', \App\Models\Wiki\Wiki::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
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
<script>

</script>
@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
