<table class="table table-sm table-hover text-nowrap">
    <thead>
        <tr>
        <th style="width: 10px">#</th>
        <th>Cliente</th>
        <th>vendedor</th>
        <th>Entrada</th>
        <th>Saída</th>
        <th>Garantia</th>
        <th>Valor</th>
        <th>Status</th>
        @if ((isset($edit) && $edit === true) || (isset($show) && $show === true) || (isset($destroy) && $destroy === true))
            <th style="width: 40px"></th>
        @endif
        </tr>
    </thead>
    <tbody>


        @forelse ($vendaTable as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->cliente->name}}</td>
            <td>{{ $item->vendedor?->name}}</td>
            <td>{{ $item->created_at?->format('d/m/Y') }}</td>
            <td>{{ $item->data_saida?->format('d/m/Y') }}</td>

            <td
                @if ($item->prazo_garantia?->gte(now()))
                class="text-success"
                title="Garantia valida"
                @else
                class="text-danger"
                title="Garantia Vencida"
                @endif
            >

                {{ $item->prazo_garantia?->format('d/m/Y') }}
            </td>
            <td>
                @if ($item->valor_total)
                R$ <span class="float-right" > {{ number_format($item->valor_total, 2, ',', '.') }} </span>
                @endif
            </td>
            <td>
                <span class="badge {{ $item->status->color }}">{{ $item->status->name }}</span>
            </td>

            @if ((isset($edit) && $edit === true) || (isset($show) && $show === true) || (isset($destroy) && $destroy === true))
                <td>
                    <div class="btn-group btn-group-sm">
                        @if (isset($edit) && $edit === true)
                            @can('venda_edit')
                                <a href="{{ route('venda.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                            @endcan
                        @endif
                        @if (isset($show) && $show === true)
                            @can('venda_show')
                                <a href="{{ route('venda.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                            @endcan
                        @endif
                        @if (isset($destroy) && $destroy === true)
                            @can('venda_destroy')
                                <button @disabled($item->conta_id) type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->cliente->name}}" data-url="{{route('venda.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                            @endcan
                        @endif
                    </div>
                </td>
            @endif
        </tr>
        @empty
        <tr>
            <th>
                <h3>Não existem Vendas cadastradas</h3>
            </th>
        </tr>
        @endforelse
    </tbody>
</table>
