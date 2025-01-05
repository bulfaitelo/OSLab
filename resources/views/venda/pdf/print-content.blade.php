@section('os-print-content')
    {{-- @dump($os->toArray()) --}}
    <div class="content" >
        {!! $emitente !!}
        {{-- Cabesalho, grantia e status --}}
        <table class=" mt-1 mb-1 table-border-none">
            <thead class="header">
                <tr>
                    <td class="pl-1 pt-0 pb-0" ><b>OS: {{ $os->id }}</b></td>
                    <td class="pt-0 pb-0" ><b>Status: {{ $os->status->name }}</b></td>
                    <td class="pt-0 pb-0" >
                        @if ($os->prazo_garantia)
                            <b>Venc. Garantia: {{ $os->prazo_garantia?->format('d/m/Y') }}</b>
                        @endif
                    </td>
                    <td class="pt-0 pb-0" ><b>Entrada: {{ $os->data_entrada?->format('d/m/Y') }}</b></td>
                    <td class="pt-0 pb-0" >
                        @if ($os->data_saida)
                            <b>Saída: {{ $os->data_saida?->format('d/m/Y') }}</b>
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
                    <td  class="pt-0 pb-0 pl-1  "   colspan="3"> {{ $os->cliente->name }} </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        <b>
                        @if ($os->cliente->pessoa_juridica)
                            CNPJ:
                        @else
                            CPF:
                        @endif
                        </b>
                    </td>
                    <td  class="pt-0 pb-0 pl-1  "  >{{ $os->cliente->registro }}</td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Endereço:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        @if ($os->cliente->logradouro)
                        {{ $os->cliente->logradouro }}, N.:{{ $os->cliente->numero }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>CEP:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >{{ $os->cliente->cep }}</td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Cidade/UF</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        @if ($os->cliente->cidade)
                        {{$os->cliente->cidade}}/{{$os->cliente->uf}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Telefone:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >
                        {{ $os->cliente->telefone }}@if (($os->cliente->telefone != "") && ($os->cliente->celular != "")), @endif {{ $os->cliente->celular }}
                    </td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>e-mail:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >{{ $os->cliente->email }}</td>
                </tr>
            </tbody>
        </table>
        {{-- FIM - Dados do cliente --}}

        {{-- Dados do equipamento ou do serviço --}}
        <table class=" mt-1 mb-1">
            <thead class="header">
                <tr>
                    <td colspan="4" class=" pl-1 pt-0 pb-0" >
                        @if ($os->modelo_id)
                            <b>DADOS DO EQUIPAMENTO</b>
                        @else
                            <b>INFORMAÇÕES DA OS</b>
                        @endif
                    </td>
                </tr>
            </thead>
            @if ($os->modelo_id)
                <tbody>
                    <tr>
                        <td class="pl-1  pt-0 ">
                            <span class="text-dark" style="font-size: 11px" ><b>Equipamento</b></span><br>
                            <span>{{ $os->modelo->wiki->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 11px"  ><b>Fabricante</b></span><br>
                            <span>{{ $os->modelo->wiki->fabricante->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 11px"  ><b>Modelo</b></span><br>
                            <span>{{ $os->modelo->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 11px"  ><b>Serial/Imei</b></span><br>
                            <span>{{ $os->serial }}</span>
                        </td>
                    </tr>
                </tbody>
            @endif
            <tbody>
                @if ($os->descricao)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 10px"  ><b>Descrição</b></span><br>
                        {!! $os->descricao !!}
                    </td>
                </tr>
                @endif
                @if ($os->defeito)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 10px"  ><b>Defeito</b></span><br>
                        {!! $os->defeito !!}
                    </td>
                </tr>
                @endif
                @if ($os->observacoes)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 10px"  ><b>Observações</b></span><br>
                        {!! $os->observacoes !!}
                    </td>
                </tr>
                @endif
                @if ($os->laudo)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 10px"  ><b>Laudo</b></span><br>
                        {!! $os->laudo !!}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        {{-- FIM - Dados do equipamento ou do serviço --}}

        {{-- Produtos --}}
        @if ($os->produtos->count() > 0)
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
                @foreach ($os->produtos as $item)
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
                           <b>R$ {{ number_format($os->produtos->sum('valor_venda_total'),2,",",".")}}</b>
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
        {{-- FIM - Produtos --}}

        {{-- SERVIÇOS --}}
        @if ($os->servicos->count() > 0)
        <table class=" mt-1 mb-1">
            <thead>
                <tr>
                    <td colspan="5" class="pl-1 pt-0 pb-0 header" >SERVIÇOS</td>
                </tr>
                <tr>
                    <td class="bold pt-0 pb-0 pl-1" ><b>ITEM</b></td>
                    <td class="bold pt-0 pb-0 pl-1" ><b>NOME</b></td>
                    <td class="bold pt-0 pb-0 pr-1 text-right" ><b>QTD.</b></td>
                    <td class="bold pt-0 pb-0 pr-1 text-right" ><b>Preço Unit.</b></td>
                    <td class="bold pt-0 pb-0 pr-1 text-right" ><b>SUBTOTAL</b></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1
                @endphp
                @foreach ($os->servicos as $item)
                    <tr>
                        <td  class="pt-0 pb-0 pl-1 " > {{ $count++ }} </td>
                        <td  class="pt-0 pb-0 pl-1 " > {{$item->servico->name}} </td>
                        <td  class="pt-0 pb-0 pr-1 text-right" > {{ $item->quantidade }} </td>
                        <td  class="pt-0 pb-0 pr-1 text-right" > R$ {{ number_format($item->valor_servico,2,",",".") }} </td>
                        <td  class="pt-0 pb-0 pr-1 text-right" > R$ {{ number_format($item->valor_servico_total,2,",",".") }} </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="header">
                    <td class="pt-0 pr-1 pb-0" colspan="5">
                        <b>TOTAL</b>
                        <span class="float-right">
                            <b>R$ {{ number_format($os->servicos->sum('valor_servico_total'),2,",",".")}}</b>
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
        {{-- FIM - SERVIÇOS --}}

        <table class=" radius mt-1 mb-1">
            <thead>
                {{-- <tr>
                    <th  class="pt-0 pb-0 header text-right" ><b>DESCONTO: - 123,00</b></th>
                </tr> --}}
                <tr class="header">
                    <td  class="pt-0 pr-1 pb-0 text-right" ><b>VALOR TOTAL DA OS: {{ number_format($os->valorTotal(),2,",",".") }}</b></td>
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
