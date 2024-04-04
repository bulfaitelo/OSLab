<table class="table table-sm table-hover text-nowrap">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Estoque</th>
            <th>Valor</th>
            <th>Ultima atualização</th>
            @if (
                (isset($movimentacao) && $movimentacao === true)
                || (isset($movimentacao_create) && $movimentacao_create === true)
                || (isset($edit) && $edit === true)
                || (isset($show) && $show === true)
                || (isset($destroy) && $destroy === true)
            )
                <th style="width: 40px"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($produtos as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name}}</td>
            <td>{{ $item->centroCusto->name}}</td>
            <td>{{ $item->estoque}}</td>
            <td>{{ $item->valor_venda}}</td>
            <td>{{ $item->updated_at->format('H:i:s d/m/Y') }}</td>
            @if (
                (isset($movimentacao) && $movimentacao === true)
                || (isset($movimentacao_create) && $movimentacao_create === true)
                || (isset($edit) && $edit === true)
                || (isset($show) && $show === true)
                || (isset($destroy) && $destroy === true)
            )
            <td>
                <div class="btn-group btn-group-sm">
                    @if (isset($movimentacao) && $movimentacao === true)
                        @can('produto_movimentacao')
                            <a href="{{ route('movimentacao.index', $item->id) }}" title="Movimentações" class="btn btn-left bg-olive"><i class="fa-solid fa-boxes-packing"></i></a>
                        @endcan
                    @endif
                    @if (isset($movimentacao_create) && $movimentacao_create === true)
                        @can('produto_movimentacao_create')
                            <a href="{{ route('movimentacao.create', $item->id) }}" title="Adicionar Estoque" class="btn btn-left bg-primary"><i class="fa-solid fa-plus"></i></a>
                        @endcan
                    @endif
                    @if (isset($edit) && $edit === true)
                        @can('produto_edit')
                        <a href="{{ route('produto.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                    @endif
                    @if (isset($show) && $show === true)
                        @can('produto_show')
                            <a href="{{ route('produto.show', $item->id) }}" title="Vizualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                    @endif
                    @if (isset($destroy) && $destroy === true)
                        @can('produto_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('produto.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                        @endcan
                    @endif
                </div>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            <th>
                <h3>Não existem produtos cadastrados</h3>
            </th>
        </tr>
        @endforelse
    </tbody>
</table>
