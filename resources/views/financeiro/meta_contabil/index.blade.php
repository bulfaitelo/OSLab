@extends('adminlte::page')

@section('title', 'Metas Contábeis')

@section('content_header')
    <h1><i class="fa-regular fa-chart-bar "></i> Metas Contábeis</h1>
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
                @can('financeiro_meta_contabil_create')
                <a href="{{ route('financeiro.meta_contabil.create') }}">
                    <button type="button"  class="btn btn-sm btn-oslab">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar Meta Contábil
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
                    <th>Nome</th>
                    <th class="text-right">Valor</th>
                    <th style="width: 50px">Liquido</th>
                    <th style="width: 100px">Intervalo</th>
                    <th>Progresso</th>
                    <th style="width: 45px">%</th>
                    <th style="width: 90px">Dashboard</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($metaContabil as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name}}</td>
                        <td class="text-right">{{ $item->valor}}</td>
                        <td class="text-center">                            
                            @if ($item->valor_liquido == 1)                                                                                    
                            <i class="fa-solid fa-check" style="color: #4a42d3;"></i>
                            @endif
                        </td>
                        <td>{{ $item->intervalo}}</td>       
                        <td>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar progress-bar-striped btn-oslab" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td><span class="badge btn-oslab">90%</span></td>                        
                        <td class="text-center" >                            
                            @if ($item->exibir_dashboard == 1)                                                                                    
                            <i class="fa-solid fa-check" style="color: #4a42d3;"></i>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('financeiro_meta_contabil_edit')
                                    <a href="{{ route('financeiro.meta_contabil.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('financeiro_meta_contabil_show')
                                    <a href="{{ route('financeiro.meta_contabil.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('financeiro_meta_contabil_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('financeiro.meta_contabil.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$Serviços->appends(['busca' => $busca])->links() }} --}}
            {{ $metaContabil->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
    @can('produto_destroy')
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
