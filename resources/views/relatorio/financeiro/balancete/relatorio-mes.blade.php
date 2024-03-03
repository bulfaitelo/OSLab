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
            <td >R$ <span class="float-right" > {{ number_format($receita->receita, 2, ',', '.') }} </span> </td>
            @endforeach
            <th >R$ <span class="float-right" > {{ number_format($mesRelatorio->sum('receita'), 2, ',', '.') }} </span> </th>
        </tr>
        <tr>
            <th>Despesa</th>
            @foreach ($mesRelatorio as $despesa)
            <td >R$ <span class="float-right" > {{ number_format($despesa->despesa, 2, ',', '.') }} </span> </td>
            @endforeach
            <th >R$ <span class="float-right" > {{ number_format($mesRelatorio->sum('despesa'), 2, ',', '.') }} </span> </th>
        </tr>
        <tr>
            <th>Saldo</th>
            @foreach ($mesRelatorio as $saldo)
            <td >R$ <span class="float-right" > {{ number_format($saldo->saldo, 2, ',', '.') }} </span> </td>
            @endforeach
            <th >R$ <span class="float-right" > {{ number_format($mesRelatorio->sum('saldo'), 2, ',', '.') }} </span> </th>
        </tr>
    </tbody>

</table>
@endif
