@if (isset($relatorio) && count($relatorio) > 0)

    <table class="table table-bordered text-nowrap table-sm">
        <thead>
            <tr>
                <th style="width: 90px;">Tipo</th>
                <th>Descrição </th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Valor em Aberto</th>                
                <th style="width: 44px" class="d-print-none">Detalhes</th>
            </tr>
        </thead>
        <tbody>                 
            @foreach ($relatorio as $item)
                <tr>                    
                    <td>
                        <h5>
                            @if ($item->tipo == 'R')
                            <span class="badge bg-success">Receita</span>
                            @else
                            <span class="badge bg-danger">Despesa</span>
                            @endif                           
                        </h5>
                    </td>                    
                    <td title="{{ $item->name }}">{{ Str::limit($item->name, 40) }}</td>
                    <td>{{ $item->cliente }}</td>                  
                    <td class="text-right">R$ {{ number_format($item->valor, 2, ',', '.') }} </td>
                    <td class="text-right">R$ {{ number_format($item->debito, 2, ',', '.') }} </td>
                    <td class="d-print-none">
                        <div class="btn-group btn-group-sm">
                            @if ($item->tipo == 'R')
                                @can('financeiro_receita_show')
                                    <a href="{{ route('financeiro.receita.show', $item->id) }}" title="Visualizar Receita" target="_blank"
                                        class="btn btn-left btn-default btn-sm"><i class="fa-solid fa-money-bill "></i></a>
                                @endcan
                            @else
                                @can('financeiro_despesa_show')
                                    <a href="{{ route('financeiro.despesa.show', $item->id) }}" title="Visualizar Despesa" target="_blank"
                                        class="btn btn-left btn-default btn-sm"><i class="fa-solid fa-money-bill "></i></a>
                                @endcan
                            @endif
                            @if ($item->os_id)
                                @can('os_show')
                                    <a href="{{ route('os.show', $item->os_id) }}" title="Visualizar Ordem de Serviço" target="_blank"
                                        class="btn btn-left btn-default btn-sm"><i class="fa-regular fa-rectangle-list "></i></a>
                                @endcan
                            @endif
                            @if ($item->venda_id)
                                @can('venda_show')
                                    <a href="{{ route('venda.show', $item->venda_id) }}" title="Visualizar Venda" target="_blank"
                                        class="btn btn-left btn-default btn-sm"><i class="fa-solid fa-store "></i></a>
                                @endcan
                            @endif

                        </div>
                    </td>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">TOTAL</th>
                <th class="text-right">R$ {{ number_format( $relatorio->sum('debito'), 2, ',', '.')}} </th>
                <th class="d-print-none"></th>
            </tr>
        </tfoot>
    </table>

@endif
