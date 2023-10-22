@extends('adminlte::page')

@section('title', 'Setores')

@section('content_header')
    <h1><i class="fas fa-industry "></i> Setores</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('config_user_setor_create')
                <a href="{{ route('configuracao.user.setor.create') }}">
                    <button type="button"  class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Criar setor
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
                    <th>Setor</th>
                    <th>Usuários</th>
                    <th style="width: 40px"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($setores as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{$item->users->count()}}</td>
                        <td>
                            <div class="btn-group btn-group-sm ">
                            @can('config_user_setor_edit')
                            <a href="{{ route('configuracao.user.setor.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('config_user_setor_destroy')
                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('configuracao.user.setor.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
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
            {{$setores->links() }}

        </div>
    </div>

    {{-- Modal Excluir --}}
    @can('config_user_setor_destroy')
    <div class="modal fade"  id="modal-excluir" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Realmente deseja Excluir?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p><b>Nome:</b> <span></span></p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    {!! html()->form('delete')->open() !!}
                        <input type="submit" class="btn btn-danger delete-permission" value="Excluir">
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>
    @endcan
    {{-- // Modal Excluir --}}
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    $('#modal-excluir').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('name') // Extract info from data-* attributes
        var url = button.data('url') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body span').text(name)
        modal.find('form').attr('action', url);
    })
</script>
@stop
