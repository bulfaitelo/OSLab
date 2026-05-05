@extends('adminlte::page')

@section('title', 'Visualizando Clientes')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Visualizando Clientes</h1>
@stop

@section('content')
<div class="mb-3">
    @can('relatorio_sistema_auditoria')
    <a href="{{ route('relatorio.sistema.auditoria.index', ['auditable_type' => get_class($cliente), 'auditable_id' => $cliente->id]) }}" class="btn btn-sm bg-lightblue">
        <i class="fas fa-history"></i>
        Auditoria
    </a>
    @endcan
</div>
@livewire('cliente.show-cliente', ['cliente' => $cliente], key('detalhes-tab'))
@stop

@section('css')
@stop

@section('js')
@stop
