@extends('adminlte::page')

@section('title', 'Centro de Custo')

@section('content_header')
    <h1><i class="fas fa-cubes "></i> Centro de Custo</h1>
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
            @can('config_financeiro_centro_custo_create')
            <a href="{{ route('configuracao.financeiro.centro_custo.create') }}">
                <button type="button"  class="btn btn-sm btn-oslab">
                    <i class="fa-solid fa-plus"></i>
                    Criar Centro de Custo
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
                        <th>Centro de Custo</th>
                        <th>Receita / Despesa</th>
                        <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($centroCusto as $item)
                    <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <h5>
                            @if ($item->receita)
                                <span class="badge bg-success">Receita</span>
                            @endif
                            @if ($item->despesa)
                                <span class="badge bg-danger">Despesa</span>
                            @endif
                        </h5>
                        </td>
                    <td>
                        <div class="btn-group btn-group-sm ">
                        @can('config_financeiro_centro_custo_edit')
                            <a href="{{ route('configuracao.financeiro.centro_custo.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('config_financeiro_centro_custo_show')
                            <a href="{{ route('configuracao.financeiro.centro_custo.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('config_financeiro_centro_custo_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('configuracao.financeiro.centro_custo.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
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
            {{$centroCusto->links() }}

        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('config_user_setor_destroy')
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
