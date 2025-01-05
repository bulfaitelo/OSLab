@extends('adminlte::page')

@section('title', 'Termo de Garantia')

@section('content_header')
    <h1><i class="fas fa-shield-alt "></i> Termo de Garantia</h1>
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
            @can('config_garantia_create')
            <a href="{{ route('configuracao.garantia.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Criar Garantia
                </button>
            </a>
            @endcan
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-sm table-hover text-nowrap">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Garantia</th>
                <th>Prazo padrão</th>
                <th>Criador</th>
                <th style="width: 40px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($garantias as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->prazo_garantia }} Dias </td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <div class="btn-group btn-group-sm ">
                        @can('config_garantia_edit')
                            <a href="{{ route('configuracao.garantia.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('config_garantia_show')
                            <a href="{{ route('configuracao.garantia.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('config_garantia_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('configuracao.garantia.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                        @endcan
                        </div>
                    </td>
                </tr>


            @empty
            <tr>
                <td colspan="5" > <h4>Não existem registros</h4></td>
            @endforelse
            </tbody>
        </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$pacientes->appends(['busca' => $busca])->links() }}	 --}}
            {{$garantias->links() }}

        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('config_garantia_destroy')
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
