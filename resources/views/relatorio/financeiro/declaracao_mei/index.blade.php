@extends('adminlte::page')

@section('title', 'Declaração MEI')

@section('content_header')
    <h1><i class="fa-regular fa-file-lines"></i> Declaração MEI</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @include('adminlte::partials.form-alert')
            <livewire:financeiro.declaracao-mei-report />
        </div>
    </div>
@stop
