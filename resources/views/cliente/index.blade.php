@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Clientes</h1>
@stop

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('cliente_create')
            <a href="{{ route('cliente.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Criar Cliente
                </button>
            </a>
            @endcan
            <button class="btn btn-sm bg-lightblue float-right" type="button" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <div class="collapse @if (count($request->all()) > 0) show @endif" id="collapseCliente">
                <hr>
                {{ html()->form('get', route('cliente.index'))->open() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2 ">
                            <label for="busca">Cliente / email / Celular / Telefone</label>
                            {!! html()->text('busca', $request->busca)->class('form-control form-control-sm')->placeholder('Buscar por Cliente, Email, Celular, ou telefone') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2 ">
                            <label for="tipo">Tipo de Cliente</label>
                            {!! html()->select('tipo', ['1' => 'Pessoa Jurídica', '0' => 'Pessoa Física'], $request->tipo)->class('form-control form-control-sm')->placeholder('Todos') !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group text-right mb-2">
                            <button type="submit"  class="btn bg-lightblue btn-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                            @if (count($request->all()) > 0)
                            <a href="{{ route('cliente.index') }}">
                                <button type="button"  class="btn bg-gray btn-sm">
                                    <i class="fa-solid fa-xmark"></i>
                                    Limpar
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-2 table-responsive">
            @include('cliente.partials.cliente-table', ['clientesTable' => $clientes,  'edit' => true, 'show'=> true,  'destroy' => true])
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $clientes->appends($request->all())->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('cliente_destroy')
        @include('adminlte::partials.modal.modal-excluir')
    @endcan
    {{-- // Modal Excluir --}}
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
