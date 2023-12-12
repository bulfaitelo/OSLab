@section('os-print-content')
    <div class="content" >
        {!! $emitente !!}
        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead class="bloco-div">
                <tr>
                    <th class="pt-0 pb-0" >OS Nº: 123456</th>
                    <th class="pt-0 pb-0" >Status: Faturada</th>
                    <th class="pt-0 pb-0" >Venc. Garantia: 12/12/2023</th>
                    <th class="pt-0 pb-0" >Entrada: 12/12/2023</th>
                    <th class="pt-0 pb-0" >Saída: 12/12/2023</th>
                </tr>
            </thead>
        </table>

        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead class="bloco-div">
                <tr>
                    <td colspan="4" class="pt-0 pb-0" ><b>DADOS DO CLIENTE</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  class="pt-0 pb-0"  ><b>Cliente</b></td>
                    <td  class="pt-0 pb-0"   colspan="3"> thiafo fodfodosfos sdofdofdoof sfodoof</td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  ><b> CNPJ/CPF: </b></td>
                    <td  class="pt-0 pb-0"  >126.123.123-83</td>
                    <td  class="pt-0 pb-0"  ><b>Endereço:</b></td>
                    <td  class="pt-0 pb-0"  >Av porto do rosa n40 boladão </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  ><b>CEP:</b></td>
                    <td  class="pt-0 pb-0"  >24470-000</td>
                    <td  class="pt-0 pb-0"  ><b>Cidade/UF</b></td>
                    <td  class="pt-0 pb-0"  > São gonçalo/RJ </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  ><b>Telefone:</b></td>
                    <td  class="pt-0 pb-0"  > (21) 98765-4321, (21) 98765-4321 </td>
                    <td  class="pt-0 pb-0"  ><b>e-mail:</b></td>
                    <td  class="pt-0 pb-0"  >oslab@oslab.com.br</td>
                </tr>
            </tbody>
        </table>

        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead class="bloco-div">
                <tr>
                    <td colspan="4" class="pt-0 pb-0" ><b>DADOS DO EQUIPAMENTO</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pt-0">
                        <span class="text-dark" style="font-size: 13px" ><b>Equipamento</b></span><br>
                        <span>iphone 12 pro </span>
                    </td>
                    <td  class="pt-0" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Fabricante</b></span><br>
                        <span>iphone 12 pro </span>
                    </td>
                    <td  class="pt-0" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Modelo</b></span><br>
                        <span>A1259</span>
                    </td>
                    <td  class="pt-0" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Serial/Imei</b></span><br>
                        <span>123123213213 1232321 213123 21321 </span>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Defeito</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Observações</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Laudo</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
            </tbody>
        </table>

        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead>
                <tr>
                    <th colspan="5" class="pt-0 pb-0 bloco-div" ><b>PRODUTOS</b></th>
                </tr>
                <tr>
                    <th class="pt-0 pb-0" >ITEM</th>
                    <th class="pt-0 pb-0" >NOME</th>
                    <th class="pt-0 pb-0 text-right" >QTD.</th>
                    <th class="pt-0 pb-0 text-right" >Preço Unit.</th>
                    <th class="pt-0 pb-0 text-right" >SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  class="pt-0 pb-0"  > 1 </td>
                    <td  class="pt-0 pb-0"  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  > 1 </td>
                    <td  class="pt-0 pb-0"  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  > 1 </td>
                    <td  class="pt-0 pb-0"  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="bloco-div">
                    <td  class="pt-0 pb-0 font-weight-bold" colspan="2">
                        TOTAL
                    </td>
                    <td  class="pt-0 pb-0 text-right font-weight-bold " colspan="3">
                        350,00
                    </td>
                </tr>
            </tfoot>
        </table>

        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead>
                <tr>
                    <th colspan="5" class="pt-0 pb-0 bloco-div" ><b>SERVIÇOS</b></th>
                </tr>
                <tr>
                    <th class="pt-0 pb-0" >ITEM</th>
                    <th class="pt-0 pb-0" >NOME</th>
                    <th class="pt-0 pb-0 text-right" >QTD.</th>
                    <th class="pt-0 pb-0 text-right" >Preço Unit.</th>
                    <th class="pt-0 pb-0 text-right" >SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  class="pt-0 pb-0"  > 1 </td>
                    <td  class="pt-0 pb-0"  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  > 1 </td>
                    <td  class="pt-0 pb-0"  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  > 1 </td>
                    <td  class="pt-0 pb-0"  > Bateria iphone pro 15 A1265 </td>
                    <td  class="pt-0 pb-0 text-right "  > 1 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                    <td  class="pt-0 pb-0 text-right "  > 350,00 </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="bloco-div">
                    <td  class="pt-0 pb-0 font-weight-bold" colspan="2">
                        TOTAL
                    </td>
                    <td  class="pt-0 pb-0 text-right font-weight-bold " colspan="3">
                        350,00
                    </td>
                </tr>
            </tfoot>
        </table>

        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead>
                {{-- <tr>
                    <th  class="pt-0 pb-0 bloco-div text-right" ><b>DESCONTO: - 123,00</b></th>
                </tr> --}}
                <tr>
                    <th  class="pt-0 pb-0 bloco-div text-right" ><b>VALOR TOTAL DA OS: 1.123,00</b></th>
                </tr>
            </thead>

        </table>

        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead class="bloco-div">
                <tr>
                    <td colspan="4" class="pt-0 pb-0" ><b>INFORMAÇÕES</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                        <BR>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste incidunt ab eum voluptatibus architecto minus debitis quas dicta ex. Ab consectetur nihil et necessitatibus mollitia. Exercitationem harum nisi blanditiis veniam.
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <div class="row">
                <div class="col-sm-2">
                    Data
                    <hr>
                </div>
                <div class="col-sm-5">
                    Assinatura Cliente
                    <hr>
                </div>
                <div class="col-sm-5">
                    Assinatura Técnico Responsavel
                    <hr>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .bloco-div {
            background-color: #d5d6d7 ;
        }

        @media print {
            .bloco-div {
                background-color: #d5d6d7 ;
            }

        }

        .footer {
            border: 1px solid #dee2e6;
            padding: .3rem;
        }

        .borda {
            border: 2px solid black
        }

    </style>
@stop

@section('js')
    <script>
        // alert('teste');
        // window.print();

    </script>
@stop
