@if ( isset($relatorio) && ($relatorio->count() > 0))
<table class="table table-bordered text-nowrap table-sm">
    <thead>
        <tr>
            <th>Descrição </th>
            <th>Cliente / Fornecedor </th>
            <th>Centro de Custo</th>
            <th>Parcela </th>
            <th>Valor </th>
            <th>Forma de Pagto.</th>
            <th>Vencimento</th>
            <th>Data de Pagto.</th>
            <th>Usuário</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($relatorio as $item)
        <tr>
            <td title="{{ $item->descricao }}">{{ Str::limit($item->descricao, 40) }}</td>
            <td>{{ $item->cliente }}</td>
            <td>{{ $item->centro_custo }}</td>
            <td class="text-right" >{{ $item->parcela }} / {{ $item->total_parcela }}</td>
            <td class="text-right" >R$ {{ number_format($item->valor, 2, ',', '.') }} </td>
            <td>{{ $item->forma_pagamento }}</td>
            <td>{{ $item->vencimento->format('d/m/Y') }} </td>
            <td>{{ $item->data_pagamento->format('d/m/Y') }} </td>
            <td>{{ $item->usuario }}</td>
            {{-- <td>{{ $item->data_entrada->format('d/m/Y') }}</td> --}}

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">TOTAL</th>
            <th class="text-right" >R$ {{ number_format($relatorio->sum('valor'), 2, ',', '.')}}  </th>
            <th colspan="4"></th>

            {{-- <th class="text-right" >R$ {{ number_format($relatorio->sum('credito'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$ {{ number_format($relatorio->sum('debito'), 2, ',', '.')}}  </th>
            <th class="text-right" >R$ {{ number_format($relatorio->sum('saldo'), 2, ',', '.')}}  </th> --}}
        </tr>
    </tfoot>
</table>
@endif
