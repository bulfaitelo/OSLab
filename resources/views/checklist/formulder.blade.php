{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Home')

@section('content_header')
    <h1>OSLAB - Home</h1>
@stop

@section('content')
<div id="fb-editor"></div>

@stop

@section('css')

@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script>
jQuery(function($) {
  $(document.getElementById('fb-editor')).formBuilder();
});
</script>
@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
