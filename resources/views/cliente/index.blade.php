@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Clientes</h1>
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
            @can('cliente_create')
            <a href="{{ route('cliente.create') }}">
                <button type="button"  class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Criar Cliente
                </button>
            </a>
            @endcan
        </div>
      <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-sm table-hover text-nowrap">
                <thead>
                    <tr>
                    <th style="width: 50px">Tipo</th>
                    <th>Cliente</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>OS</th>
                    <th style="width: 40px"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $item)
                    <tr>
                        <td>
                        @if ($item->pessoa_juridica == 1)
                            <span class="badge bg-primary">PJ</span>
                        @else
                            <span class="badge bg-success">PF</span>
                        @endif
                        </td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->celular}}</td>
                        <td>{{ $item->email}}</td>
                        <td>{{ $item->os->count() }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @can('cliente_edit')
                                    <a href="{{ route('cliente.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('cliente_show')
                                    <a href="{{ route('cliente.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('cliente_destroy')
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('cliente.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>

                            <!-- /.modal -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- {{$clientes->appends(['busca' => $busca])->links() }} --}}
            {{ $clientes->links() }}
        </div>
    </div>
    {{-- Modal Excluir --}}
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
                <p><b>Nome:</b> <span>asd</span></p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    {!! html()->form('delete')->open() !!}
                        <input type="submit" class="btn btn-danger delete-permission" value="Excluir Cliente">
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>
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
