{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Backup')

@section('content_header')
    <h1><i class="fa-solid fa-server "></i> Backup </h1>
@stop

@section('content')
@livewire('configuracao.backup.backup')
@stop

@section('css')

@stop

@section('js')

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
