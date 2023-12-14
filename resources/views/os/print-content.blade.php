@section('os-print-content')
    <div class="content " >
        {!! $emitente !!}
        <table class=" mt-2 mb-2">
            <thead class="header">
                <tr>
                    <th class="pl-1 pt-0 pb-0" >OS Nº: 123456</th>
                    <th class="pt-0 pb-0" >Status: Faturada</th>
                    <th class="pt-0 pb-0" >Venc. Garantia: 12/12/2023</th>
                    <th class="pt-0 pb-0" >Entrada: 12/12/2023</th>
                    <th class="pt-0 pb-0" >Saída: 12/12/2023</th>
                </tr>
            </thead>
        </table>

        <table class=" mt-2 mb-2 ">
            <thead class="header">
                <tr>
                    <td colspan="4" class="pl-1 pt-0 pb-0" ><b>DADOS DO CLIENTE</b></td>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Cliente</b></td>
                    <td  class="pt-0 pb-0 pl-1  "   colspan="3"> thiafo fodfodosfos sdofdofdoof sfodoof</td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b> CNPJ/CPF: </b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >126.123.123-83</td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Endereço:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >Av porto do rosa n40 boladão </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>CEP:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >24470-000</td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Cidade/UF</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  > São gonçalo/RJ </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>Telefone:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  > (21) 98765-4321, (21) 98765-4321 </td>
                    <td  class="pt-0 pb-0 pl-1  "  ><b>e-mail:</b></td>
                    <td  class="pt-0 pb-0 pl-1  "  >oslab@oslab.com.br</td>
                </tr>
            </tbody>
        </table>

        <table class=" mt-2 mb-2">
            <thead class="header">
                <tr>
                    <td colspan="4" class=" pl-1 pt-0 pb-0" ><b>DADOS DO EQUIPAMENTO</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pl-1  pt-0 ">
                        <span class="text-dark" style="font-size: 13px" ><b>Equipamento</b></span><br>
                        <span>iphone 12 pro </span>
                    </td>
                    <td  class="pl-1  pt-0 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Fabricante</b></span><br>
                        <span>iphone 12 pro </span>
                    </td>
                    <td  class="pl-1  pt-0 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Modelo</b></span><br>
                        <span>A1259</span>
                    </td>
                    <td  class="pl-1  pt-0 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Serial/Imei</b></span><br>
                        <span>123123213213 1232321 213123 21321 </span>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="4" class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4"  class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Defeito</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4"  class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Observações</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4"  class="pl-1 " >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Laudo</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
            </tbody>
        </table>

        <table class=" mt-2 mb-2">
            <thead>
                <tr>
                    <th colspan="5" class="pl-1 pt-0 pb-0 header" ><b>PRODUTOS</b></th>
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
