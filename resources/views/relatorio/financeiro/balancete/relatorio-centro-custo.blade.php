@if ( isset($centroCustoRelatorio) && ($centroCustoRelatorio->count() > 0))
<table class="table table-bordered table-sm">
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
            <td >R$ <span class="float-right" > {{ number_format($item->receita, 2, ',', '.') }} </span> </td>
            <td >R$ <span class="float-right" > {{ number_format($item->despesa, 2, ',', '.') }} </span> </td>
            <td >R$ <span class="float-right" > {{ number_format($item->saldo, 2, ',', '.') }} </span> </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL</th>
            <th class="" >R$ <span class="float-right" > {{ number_format($centroCustoRelatorio->sum('receita'), 2, ',', '.')}} </span> </th>
            <th class="" >R$ <span class="float-right" > {{ number_format($centroCustoRelatorio->sum('despesa'), 2, ',', '.')}} </span> </th>
            <th class="" >R$ <span class="float-right" > {{ number_format($centroCustoRelatorio->sum('saldo'), 2, ',', '.')}} </span> </th>
        </tr>
    </tfoot>
</table>
@endif
