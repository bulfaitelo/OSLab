@if ( isset($mesRelatorio) && ($mesRelatorio->count() > 0))
<table class="table table-bordered table-sm text-nowrap">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            @foreach ($mesRelatorio as $title)
                <th>{{ $title->mes }}/{{ $title->ano }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Receita</th>
            @foreach ($mesRelatorio as $receita)
            <td class="text-right" >R$  {{ number_format($receita->receita, 2, ',', '.') }}  </td>
            @endforeach
            <th class="text-right" >R$ {{ number_format($mesRelatorio->sum('receita'), 2, ',', '.') }}  </th>
        </tr>
        <tr>
            <th>Despesa</th>
            @foreach ($mesRelatorio as $despesa)
            <td class="text-right" >R$  {{ number_format($despesa->despesa, 2, ',', '.') }}  </td>
            @endforeach
            <th class="text-right" >R$ {{ number_format($mesRelatorio->sum('despesa'), 2, ',', '.') }}  </th>
        </tr>
        <tr>
            <th>Saldo</th>
            @foreach ($mesRelatorio as $saldo)
            <td class="text-right" >R$  {{ number_format($saldo->saldo, 2, ',', '.') }}  </td>
            @endforeach
            <th class="text-right" >R$ {{ number_format($mesRelatorio->sum('saldo'), 2, ',', '.') }}  </th>
        </tr>
    </tbody>

</table>
@endif
