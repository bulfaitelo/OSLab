@section('os-print-content')
    {{-- @dump($os->toArray()) --}}
    <div class="content " >
        {!! $emitente !!}
        {{-- Cabesalho, grantia e status --}}
        <table class=" mt-2 mb-2">
            <thead class="header">
                <tr>
                    <th class="pl-1 pt-0 pb-0" >OS Nº: {{ $os->id }}</th>
                    <th class="pt-0 pb-0" >Status: {{ $os->status->name }}</th>
                    <th class="pt-0 pb-0" >
                        @if ($os->prazo_garantia)
                            Venc. Garantia: {{ $os->prazo_garantia?->format('d/m/Y') }}
                        @endif
                    </th>
                    <th class="pt-0 pb-0" >Entrada: {{ $os->data_entrada?->format('d/m/Y') }}</th>
                    <th class="pt-0 pb-0" >
                        @if ($os->data_saida)
                            Saída: {{ $os->data_saida?->format('d/m/Y') }}
                        @endif
                    </th>
                </tr>
            </thead>
        </table>
        {{-- FIM - Cabesalho, grantia e status --}}

        {{-- Dados do cliente --}}
        <table class=" mt-2 mb-2 ">
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
        <table class=" mt-2 mb-2">
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
                            <span class="text-dark" style="font-size: 13px" ><b>Equipamento</b></span><br>
                            <span>{{ $os->modelo->wiki->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 13px"  ><b>Fabricante</b></span><br>
                            <span>{{ $os->modelo->wiki->fabricante->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 13px"  ><b>Modelo</b></span><br>
                            <span>{{ $os->modelo->name }}</span>
                        </td>
                        <td  class="pl-1  pt-0 " >
                            <span  class="text-dark" style="font-size: 13px"  ><b>Serial/Imei</b></span><br>
                            <span>{{ $os->serial }}</span>
                        </td>
                    </tr>
                </tbody>
            @endif
            <tbody>
                @if ($os->descricao)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        {!! $os->descricao !!}
                    </td>
                </tr>
                @endif
                @if ($os->defeito)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Defeito</b></span><br>
                        {!! $os->defeito !!}
                    </td>
                </tr>
                @endif
                @if ($os->observacoes)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Observações</b></span><br>
                        {!! $os->observacoes !!}
                    </td>
                </tr>
                @endif
                @if ($os->laudo)
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Laudo</b></span><br>
                        {!! $os->laudo !!}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        {{-- FIM - Dados do equipamento ou do serviço --}}

        {{-- Produtos --}}
        @if ($os->produtos->count() > 0)
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
                    <td class="pt-0 pb-0 pr-1 pl-1 font-weight-bold" colspan="5">
                        <div class="col-md-12 p-0">
                           <div class="row">
                            <div class="col-md-6">
                                    TOTAL
                            </div>
                            <div class="col-md-6 text-right">
                                   R$ {{ number_format($os->produtos->sum('valor_venda_total'),2,",",".")}}
                            </div>
                           </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
        {{-- FIM - Produtos --}}

        <table class=" mt-2 mb-2">
            <thead>
                <tr>
                    <th colspan="5" class="pl-1 pt-0 pb-0 header" ><b>SERVIÇOS</b></th>
                </tr>
                <tr>
                    <th class="pt-0 pb-0 pl-1  " >ITEM</th>
                    <th class="pt-0 pb-0 pl-1  " >NOME</th>
                    <th class="pt-0 pb-0 pr-1   text-right" >QTD.</th>
                    <th class="pt-0 pb-0 pr-1   text-right" >Preço Unit.</th>
                    <th class="pt-0 pb-0 pr-1   text-right" >SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  > 1 </td>
                    <td  class="pt-0 pb-0 pl-1  "  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 pr-1   text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 pr-1   text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 pr-1   text-right "  > 350,00 </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="header">
                    <td class="pt-0 pb-0 pr-1 pl-1 font-weight-bold" colspan="5">
                        <div class="col-md-12 p-0">
                           <div class="row">
                            <div class="col-md-6">
                                    TOTAL
                            </div>
                            <div class="col-md-6 text-right">
                                    350,00
                            </div>
                           </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

        <table class=" radius mt-2 mb-2">
            <thead>
                {{-- <tr>
                    <th  class="pt-0 pb-0 header text-right" ><b>DESCONTO: - 123,00</b></th>
                </tr> --}}
                <tr>
                    <th  class="pt-0 pr-1 pb-0 header text-right" ><b>VALOR TOTAL DA OS: 1.123,00</b></th>
                </tr>
            </thead>

        </table>

        <table class="mt-2 mb-2 table-rounded">
            <thead class="header">
                <tr>
                    <td colspan="4" class="pl-1 pt-0 pb-0" ><b>INFORMAÇÕES</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                        <BR>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste incidunt ab eum voluptatibus architecto minus debitis quas dicta ex. Ab consectetur nihil et necessitatibus mollitia. Exercitationem harum nisi blanditiis veniam.
                    </td>
                </tr>
            </tbody>
        </table>
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
