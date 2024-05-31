@extends('adminlte::page')

@section('title', 'Visualizando Clientes')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Visualizando Clientes</h1>
@stop

@section('content')
@livewire('cliente.show-cliente', ['cliente' => $cliente], key('detalhes-tab'))
@stop

@section('css')
@stop

@section('js')
@stop
