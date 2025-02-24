@if (isset($relatorio) && count($relatorio) > 0)
    @if (isset($relatorio['R']))
        <table class="table table-bordered text-nowrap table-sm">
            <thead>
                <tr>
                    <th colspan="10">RECEITA</th>
                </tr>
                <tr>
                    <th>Descrição </th>
                    <th>Cliente / Fornecedor </th>
                    <th>Centro de Custo</th>
                    <th>Usuário</th>
                    <th>Forma de Pagto.</th>
                    <th>Vencimento</th>
                    <th>Data de Pagto.</th>
                    <th>Parcela </th>
                    <th>Valor </th>
                    <th style="width: 44px" class="d-print-none"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalReceita = 0;
                @endphp
                @foreach ($relatorio['R'] as $item)
                    <tr>
                        <td title="{{ $item->descricao }}">{{ Str::limit($item->descricao, 40) }}</td>
                        <td>{{ $item->cliente }}</td>
                        <td>{{ $item->centro_custo }}</td>
                        <td>{{ $item->usuario }}</td>
                        <td>{{ $item->forma_pagamento }}</td>
                        <td>{{ $item->vencimento->format('d/m/Y') }} </td>
                        <td>{{ $item->data_pagamento?->format('d/m/Y') }} </td>
                        <td class="text-right">{{ $item->parcela }} / {{ $item->total_parcela }}</td>
                        <td class="text-right">R$ {{ number_format($item->valor, 2, ',', '.') }} </td>
                        <td class="d-print-none">
                            @can('financeiro_despesa_show')
                                <a href="{{ route('financeiro.despesa.show', $item->id) }}" title="Visualizar" target="_blank"
                                    class="btn btn-left btn-default btn-sm"><i class="fas fa-eye"></i></a>
                            @endcan
                        </td>
                        @php
                            $totalReceita += $item->valor
                        @endphp
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8">TOTAL</th>
                    <th class="text-right">R$ {{ number_format($totalReceita, 2, ',', '.')}} </th>
                    <th class="d-print-none"></th>
                </tr>
            </tfoot>
        </table>
    @endif

    @if (isset($relatorio['D']))
        <table class="table table-bordered text-nowrap table-sm">
            <thead>
                <tr>
                    <th colspan="10">DESPESA</th>
                </tr>
                <tr>
                    <th>Descrição </th>
                    <th>Cliente / Fornecedor </th>
                    <th>Centro de Custo</th>
                    <th>Usuário</th>
                    <th>Forma de Pagto.</th>
                    <th>Vencimento</th>
                    <th>Data de Pagto.</th>
                    <th>Parcela </th>
                    <th>Valor </th>
                    <th style="width: 44px" class="d-print-none"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDespesa = 0;
                @endphp
                @foreach ($relatorio['D'] as $item)
                    <tr>
                        <td title="{{ $item->descricao }}">{{ Str::limit($item->descricao, 40) }}</td>
                        <td>{{ $item->cliente }}</td>
                        <td>{{ $item->centro_custo }}</td>
                        <td>{{ $item->usuario }}</td>
                        <td>{{ $item->forma_pagamento }}</td>
                        <td>{{ $item->vencimento->format('d/m/Y') }} </td>
                        <td>{{ $item->data_pagamento?->format('d/m/Y') }} </td>
                        <td class="text-right">{{ $item->parcela }} / {{ $item->total_parcela }}</td>
                        <td class="text-right">R$ {{ number_format($item->valor, 2, ',', '.') }} </td>
                        <td class="d-print-none">
                            @can('financeiro_despesa_show')
                                <a href="{{ route('financeiro.despesa.show', $item->id) }}" title="Visualizar" target="_blank"
                                    class="btn btn-left btn-default btn-sm"><i class="fas fa-eye"></i></a>
                            @endcan
                        </td>
                        @php
                            $totalDespesa += $item->valor
                        @endphp
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8">TOTAL</th>
                    <th class="text-right">R$ {{ number_format($totalDespesa, 2, ',', '.')}} </th>
                    <th class="d-print-none"></th>

                </tr>
            </tfoot>
        </table>
    @endif

    @if (isset($totalReceita) && isset($totalDespesa))
        <table class="table table-bordered text-nowrap table-sm">
            <thead>
                <tr>
                    <th colspan="8">SALDO</th>
                    <th class="text-right">R$ {{ number_format(($totalReceita - $totalDespesa), 2, ',', '.')}} </th> {{-- --}}
                    <th style="width: 44px" class="d-print-none"></th>
                </tr>
            </thead>
        </table>
    @endif
@endif
