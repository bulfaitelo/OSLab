@if ( isset($centroCustoRelatorio) && ($centroCustoRelatorio->count() > 0))
<table class="table table-bordered table-sm text-nowrap">
    <thead>
        <tr>
            <th>Centro de Custo</th>
            <th>Receita</th>
            <th>Despesa</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($centroCustoRelatorio as $item)
        <tr>
            <td><strong>{{ $item->centro_custo }}</strong></td>
            <td class="text-right" >R$  {{ number_format($item->receita, 2, ',', '.') }}  </td>
            <td class="text-right" >R$  {{ number_format($item->despesa, 2, ',', '.') }}  </td>
            <td class="text-right" >R$  {{ number_format($item->saldo, 2, ',', '.') }}  </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL</th>
            <th class="text-right" >R$  {{ number_format($centroCustoRelatorio->sum('receita'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$  {{ number_format($centroCustoRelatorio->sum('despesa'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$  {{ number_format($centroCustoRelatorio->sum('saldo'), 2, ',', '.')}}  </th>
        </tr>
    </tfoot>
</table>
@endif
