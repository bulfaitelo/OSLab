@section('venda-print-content')
    {{-- @dump($venda->toArray()) --}}
    <div class="content " >
        {!! $emitente !!}
        {{-- Cabesalho, grantia e status --}}
        <table class=" mt-2 mb-2">
            <thead class="header">
                <tr>
                    <th class="pl-1 pt-0 pb-0" >Venda Nº: {{ $venda->id }}</th>
                    <th class="pt-0 pb-0" >Status: {{ $venda->status->name }}</th>
                    <th class="pt-0 pb-0" >
                        @if ($venda->prazo_garantia)
                            Venc. Garantia: {{ $venda->prazo_garantia?->format('d/m/Y') }}
                        @endif
                    </th>
                    <th class="pt-0 pb-0" >Entrada: {{ $venda->created_at?->format('d/m/Y') }}</th>
                    <th class="pt-0 pb-0" >
                        @if ($venda->data_saida)
                            Saída: {{ $venda->data_saida?->format('d/m/Y') }}
                        @endif
                    </th>
                </tr>
            </thead>
        </table>
        {{-- FIM - Cabesalho, grantia e status --}}

        {{-- Dadvenda do cliente --}}
        <table class=" mt-2 mb-2 ">
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
        {{-- FIM - Dadvenda do cliente --}}

        {{-- Dadvenda do equipamento ou do serviço --}}
        <table class=" mt-2 mb-2">
            <thead class="header">
                <tr>
                    <td colspan="4" class=" pl-1 pt-0 pb-0" >
                        @if ($venda->modelo_id)
                            <b>DADOS DO EQUIPAMENTO</b>
                        @else
                            <b>INFORMAÇÕES DA OS</b>
                        @endif
                    </td>
                </tr>
            </thead>
            <tbody>
                @if ($venda->descricao)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        {!! $venda->descricao !!}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        {{-- FIM - Dadvenda do equipamento ou do serviço --}}

        {{-- Produtos --}}
        @if ($venda->produtos->count() > 0)
        <table class=" mt-2 mb-2">
            <thead>
                <tr>
                    <th colspan="5" class="pl-1 pt-0 pb-0 header" ><b>PRODUTOS</b></th>
                </tr>
                <tr>
                    <th class="pt-0 pb-0 pl-1" >ITEM</th>
                    <th class="pt-0 pb-0 pl-1" >NOME</th>
                    <th class="pt-0 pb-0 pr-1 text-right" >QTD.</th>
                    <th class="pt-0 pb-0 pr-1 text-right" >Preço Unit.</th>
                    <th class="pt-0 pb-0 pr-1 text-right" >SUBTOTAL</th>
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
                    <td class="pt-0 pb-0 pr-1 pl-1 font-weight-bold" colspan="5">
                        <div class="col-md-12 p-0">
                           <div class="row">
                                <div class="col-md-12">
                                        TOTAL
                                        <span class="float-right">
                                            R$ {{ number_format($venda->produtos->sum('valor_venda_total'),2,",",".")}}
                                        </span>
                                </div>
                           </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
        {{-- FIM - Produtos --}}

        <table class=" radius mt-2 mb-2">
            <thead>
                {{-- <tr>
                    <th  class="pt-0 pb-0 header text-right" ><b>DESCONTO: - 123,00</b></th>
                </tr> --}}
                <tr>
                    <th  class="pt-0 pr-1 pb-0 header text-right" ><b>VALOR TOTAL DA OS: {{ number_format($venda->valorTotal(),2,",",".") }}</b></th>
                </tr>
            </thead>

        </table>

        @if (strlen(getConfig('venda_informacao')) > 5)

        <table class="mt-2 mb-2 table-rounded">
            <thead class="header">
                <tr>
                    <td colspan="4" class="pl-1 pt-0 pb-0" ><b>INFORMAÇÕES</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="pl-1 " >
                        {!! getConfig('venda_informacao') !!}
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
        <div class="footer  rounded">
            <div class="row">
                <div class="col-sm-2">
                    Data
                    <hr class="-small">
                </div>
                <div class="col-sm-5">
                    Assinatura Cliente
                    <hr class="-small">
                </div>
                <div class="col-sm-5">
                    Assinatura Técnico Responsavel
                    <hr class="-small">
                </div>
            </div>
        </div>

    </div>


@endsection

@section('css')
    <style>
        .header {
            background-color: #d5d6d7 !important;
        }

        @media print {
            .header {
                background-color: #d5d6d7 !important;
            }
        }

        .footer {
            padding: .3rem;
            border: 2px solid rgb(146, 146, 146);
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

@section('js')
    <script>
        // alert('teste');
        // window.print();

    </script>
@stop
