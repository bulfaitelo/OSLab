@extends('adminlte::page')

@section('title', 'Status')

@section('content_header')
    <h1 class="d-inline">
        <i class="fas fa-wave-square "></i> Status
    </h1>
@stop

{{-- Texto de ajuda --}}
@section('content_header_help_content', 'Tela de cadastro de Status, usado em Ordem de Serviço e em Vendas.')
{{-- Titulo (Opcional)--}}
{{-- @section('content_header_help_title', 'titulo') --}}

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
            @can('config_status_create')
            <a href="{{ route('configuracao.parametro.status.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Criar Status
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
                    <th>Status</th>
                    <th>Cor</th>
                    <th>Descrição</th>
                    <th>Exibe Garantia</th>
                    <th style="width: 40px"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($status as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <span class="badge {{ $item->color }}">{{ $item->name }}</span>
                        </td>
                        <td>
                            <div class="{{$item->color}}" style="width: 70px; height: 25px; border-radius: 3px;" >
                        </div>
                        <td>{{ $item->descricao }}</td>
                        @if ($item->garantia)
                        <td>
                            <span class="badge bg-success">Sim</span>
                        </td>
                        @else
                        <td>
                            <span class="badge bg-danger">Não</span>
                        </td>
                        @endif
                        <td>
                            <div class="btn-group btn-group-sm">
                            @can('config_status_edit')
                            <a href="{{ route('configuracao.parametro.status.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('config_status_show')
                                <a href="{{ route('configuracao.parametro.status.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                            @endcan
                            @can('config_status_destroy')
                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('configuracao.parametro.status.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                            @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="5" > <h4>Não existem registros</h4></td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$pacientes->appends(['busca' => $busca])->links() }}	 --}}
            {{$status->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('config_status_destroy')
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
