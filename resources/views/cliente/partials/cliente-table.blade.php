<table class="table table-sm table-hover text-nowrap">
    <thead>
        <tr>
            <th style="width: 50px">Tipo</th>
            <th>Cliente</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Estado</th>
            <th>OS</th>
            @if ((isset($edit) && $edit === true) || (isset($show) && $show === true) || (isset($destroy) && $destroy === true))
                <th style="width: 40px"></th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach ($clientesTable as $item)
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
            <td>{{ $item->uf}}</td>
            <td>{{ $item->os->count() }}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    @if (isset($edit) && $edit === true)
                        @can('cliente_edit')
                            <a href="{{ route('cliente.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                    @endif
                    @if (isset($show) && $show === true)
                        @can('cliente_show')
                            <a href="{{ route('cliente.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                    @endif
                    @if (isset($destroy) && $destroy === true)
                        @can('cliente_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('cliente.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                        @endcan
                    @endif
                </div>

                <!-- /.modal -->
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
