@if ( isset($osRelatorio) && ($osRelatorio->count() > 0))
<table class="table table-bordered text-nowrap table-sm">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Cliente</th>
            <th>Status</th>
            <th>Data</th>
            <th>Previsto</th>
            <th>Receita</th>
            <th>Despesa</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($osRelatorio as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->cliente }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->data_entrada->format('d/m/Y') }}</td>
            <td class="text-right" >R$ {{ number_format($item->valor_total, 2, ',', '.') }} </td>
            <td class="text-right" >R$ {{ number_format($item->credito, 2, ',', '.') }} </td>
            <td class="text-right" >R$ {{ number_format($item->debito, 2, ',', '.') }} </td>
            <td class="text-right" >R$ {{ number_format($item->saldo, 2, ',', '.') }} </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">TOTAL</th>
            <th class="text-right" >R$ {{ number_format($osRelatorio->sum('valor_total'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$ {{ number_format($osRelatorio->sum('credito'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$ {{ number_format($osRelatorio->sum('debito'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$ {{ number_format($osRelatorio->sum('saldo'), 2, ',', '.')}}  </th>
        </tr>
    </tfoot>
</table>
@endif
