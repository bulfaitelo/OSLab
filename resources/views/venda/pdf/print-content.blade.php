@section('venda-print-content')
    {{-- @dump($venda->toArray()) --}}
    <div class="content" >
        {!! $emitente !!}
        {{-- Cabesalho, grantia e status --}}
        <table class=" mt-1 mb-1 table-border-none">
            <thead class="header">
                <tr>
                    <td class="pl-1 pt-0 pb-0" ><b>Venda: {{ $venda->id }}</b></td>
                    <td class="pt-0 pb-0" ><b>Status: {{ $venda->status->name }}</b></td>
                    <td class="pt-0 pb-0" >
                        @if ($venda->prazo_garantia)
                            <b>Venc. Garantia: {{ $venda->prazo_garantia?->format('d/m/Y') }}</b>
                        @endif
                    </td>
                    <td class="pt-0 pb-0" ><b>Entrada: {{ $venda->data_entrada?->format('d/m/Y') }}</b></td>
                    <td class="pt-0 pb-0" >
                        @if ($venda->data_saida)
                            <b>Saída: {{ $venda->data_saida?->format('d/m/Y') }}</b>
                        @endif
                    </td>
                </tr>
            </thead>
        </table>
        {{-- FIM - Cabesalho, grantia e status --}}

        {{-- Dados do cliente --}}
        <table class=" mt-1 mb-1 ">
            <thead class="header">
                <tr>
                    <td colspan="4" class="pl-1 pt-0 pb-0" ><b>DADOS DO CLIENTE</b></td>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Cliente</b></td>
                    <td  class="pt-0 pb-0 pl-1  "   colspan="3"> {{ $venda->cliente->name }} </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        <b>
                        @if ($venda->cliente->pessoa_juridica)
                            CNPJ:
                        @else
                            CPF:
                        @endif
                        </b>
                    </td>
                    <td  class="pt-0 pb-0 pl-1  "  >{{ $venda->cliente->registro }}</td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Endereço:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        @if ($venda->cliente->logradouro)
                        {{ $venda->cliente->logradouro }}, N.:{{ $venda->cliente->numero }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>CEP:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >{{ $venda->cliente->cep }}</td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Cidade/UF</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        @if ($venda->cliente->cidade)
                        {{$venda->cliente->cidade}}/{{$venda->cliente->uf}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Telefone:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        {{ $venda->cliente->telefone }}@if (($venda->cliente->telefone != "") && ($venda->cliente->celular != "")), @endif {{ $venda->cliente->celular }}
                    </td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>e-mail:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >{{ $venda->cliente->email }}</td>
                </tr>
            </tbody>
        </table>
        {{-- FIM - Dados do cliente --}}

        {{-- Dados do equipamento ou do serviço --}}
        <table class=" mt-1 mb-1">
            <thead class="header">
                <tr>
                    <td colspan="4" class=" pl-1 pt-0 pb-0" >
                        @if ($venda->modelo_id)
                            <b>DADOS DO EQUIPAMENTO</b>
                        @else
                            <b>INFORMAÇÕES DA VENDA</b>
                        @endif
                    </td>
                </tr>
            </thead>
            @if ($venda->modelo_id)
                <tbody>
                    <tr>
                        <td class="pl-1  pt-0 ">
                            <span class="text-dark" style="font-size: 11px" ><b>Equipamento</b></span><br>
                            <span>{{ $venda->modelo->wiki->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 11px"  ><b>Fabricante</b></span><br>
                            <span>{{ $venda->modelo->wiki->fabricante->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 11px"  ><b>Modelo</b></span><br>
                            <span>{{ $venda->modelo->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 11px"  ><b>Serial/Imei</b></span><br>
                            <span>{{ $venda->serial }}</span>
                        </td>
                    </tr>
                </tbody>
            @endif
            <tbody>
                @if ($venda->descricao)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 10px"  ><b>Descrição</b></span><br>
                        {!! $venda->descricao !!}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        {{-- FIM - Dados do equipamento ou do serviço --}}

        {{-- Produtos --}}
        @if ($venda->produtos->count() > 0)
        <table class=" mt-1 mb-1">
            <thead>
                <tr class="header">
                    <td colspan="5" class="pl-1 pt-0 pb-0" ><b>PRODUTOS</b></td>
                </tr>
                <tr>
                    <td class="pt-0 pb-0 pl-1" ><b>ITEM</b></td>
                    <td class="pt-0 pb-0 pl-1" ><b>NOME</b></td>
                    <td class="pt-0 pb-0 pr-1 text-right" ><b>QTD.</b></td>
                    <td class="pt-0 pb-0 pr-1 text-right" ><b>Preço Unit.</b></td>
                    <td class="pt-0 pb-0 pr-1 text-right" ><b>SUBTOTAL</b></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1
                @endphp
                @foreach ($venda->produtos as $item)
                    <tr>
                        <td  class="pt-0 pb-0 pl-1 " > {{ $count++ }} </td>
                        <td  class="pt-0 pb-0 pl-1 " > {{$item->produto->name}} </td>
                        <td  class="pt-0 pb-0 pr-1 text-right" > {{ $item->quantidade }} </td>
                        <td  class="pt-0 pb-0 pr-1 text-right" > R$ {{ number_format($item->valor_venda,2,",",".") }} </td>
                        <td  class="pt-0 pb-0 pr-1 text-right" > R$ {{ number_format($item->valor_venda_total,2,",",".") }} </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="header">
                    <td class="pt-0 pr-1 pb-0 header" colspan="5">
                        <b>TOTAL</b>
                        <span class="float-right">
                           <b>R$ {{ number_format($venda->produtos->sum('valor_venda_total'),2,",",".")}}</b>
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
        {{-- FIM - Produtos --}}

        <table class=" radius mt-1 mb-1">
            <thead>
                {{-- <tr>
                    <th  class="pt-0 pb-0 header text-right" ><b>DESCONTO: - 123,00</b></th>
                </tr> --}}
                <tr class="header">
                    <td  class="pt-0 pr-1 pb-0 text-right" ><b>VALOR TOTAL DA VENDA: {{ number_format($venda->valorTotal(),2,",",".") }}</b></td>
                </tr>
            </thead>

        </table>

        @if (strlen(getConfig('os_informacao')) > 5)

        <table class="mt-1 mb-1 table-rounded">
            <thead class="header">
                <tr>
                    <td colspan="4" class="pl-1 pt-0 pb-0" ><b>INFORMAÇÕES</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="pl-1 " >
                        {!! getConfig('os_informacao') !!}
                        @dump(count(preg_split('/\n|\r/',getConfig('os_informacao'))))
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
        <table class="mt-1 mb-1 table-rounded table-border-none">
            <tbody>
                <tr>
                    <td>
                        Data
                        <hr class="-small">
                    </td>
                    <td>
                        Assinatura Cliente
                        <hr class="-small">
                    </td>
                    <td>
                        Assinatura Técnico Responsavel
                        <hr class="-small">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


@endsection

@section('css')
    <style>
        .header {
            background-color: #d5d6d7 !important;
            font-family: 'metropolis-bold', 'sans-serif' !important;
        }

        @media print {
            .header {
                background-color: #d5d6d7 !important;
                font-family: 'metropolis-bold', 'sans-serif' !important;
            }
        }

        .footer {
            padding: .3rem;
            border: 2px solid rgb(146, 146, 146);
        }

        .table-border-none td {
            border: none;
            padding: 5px; /* Ajuste o padding conforme necessário */
        }

        table {
            display: inline-table;
            width: 100%;
            border: 2px solid rgb(146, 146, 146);

            border-spacing: 0;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border-collapse: separate;
        }

        table tr:first-child th {
            border-top: 0;
        }
        table tr:last-child td {
            border-bottom: 0;
        }
        table tr td:first-child,
        table tr th:first-child {
            border-left: 0;
        }
        table tr td:last-child,
        table tr th:last-child {
            border-right: 0;
        }

        tr  {
            /* border: 2px solid rgb(146, 146, 146); */
        }
        td  {
            border-top: 1px solid rgb(146, 146, 146);
            border-right: 1px solid rgb(146, 146, 146);
        }

    </style>
@stop
