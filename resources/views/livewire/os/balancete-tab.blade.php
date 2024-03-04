<div>
    @if ($showDisplay === true)
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Centro de Custo</th>
                        <th class="text-right">Previsto</th>
                        <th class="text-right">Executado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($balancete['detalhes'] as $item)
                        <tr>
                            <td>
                                @if ($item['tipo'] == 'R')
                                    <span class="badge bg-success">RECEITA</span>
                                @else
                                    <span class="badge bg-danger">DESPESA</span>
                                @endif
                            </td>
                            <td>{{ $item['centro_custo'] }}</td>
                            @if ($item['tipo'] == 'R')
                                <td class="balancete-credito ">
                                    R$ <span class="float-right " >{{ number_format($item['valor_previsto'],2,",",".") }}</span>
                                </td>
                                <td class="balancete-credito ">
                                    R$ <span class=" float-right " >{{ number_format($item['valor_executado'],2,",",".") }}</span>
                                </td>
                            @else
                                <td class="balancete-debito ">
                                    R$ <span class="float-right " >-{{ number_format($item['valor_previsto'],2,",",".") }}</span>
                                </td>
                                <td class="balancete-debito ">
                                    R$ <span class=" float-right " >-{{ number_format($item['valor_executado'],2,",",".") }}</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th colspan="2">Totais </th>

                        <th class="text-right">Previsto</th>
                        <th class="text-right">Executado</th>

                    </tr>
                </thead>
                <tfoot style=" border-top: 2px solid #dee2e6;">
                    <tr>
                        <td colspan="2">Total Crédito</td>
                        <td class="balancete-credito ">
                            R$ <span class="float-right " >{{ number_format($balancete['total_credito_previsto'],2,",",".") }}</span>
                        </td>
                        <td class="balancete-credito ">
                            R$ <span class="float-right " >{{ number_format($balancete['total_credito_executado'],2,",",".") }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Total Débito</td>
                        <td class="balancete-debito ">
                            R$ <span class="float-right " >-{{ number_format($balancete['total_debito_previsto'],2,",",".") }}</span>
                        </td>
                        <td class="balancete-debito ">
                            R$ <span class="float-right " >-{{ number_format($balancete['total_debito_executado'],2,",",".") }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Saldo</b></td>
                        <td colspan="2" @class([
                            'balancete-credito' => ($balancete['saldo'] > 0),
                            'balancete-debito' => ($balancete['saldo'] < 0),
                        ])>
                           <b> R$ <span class=" float-right " >{{ number_format($balancete['saldo'],2,",",".") }}</span></b>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        {{-- <div class="col-md-5">
            <canvas id="myChart"></canvas>
        </div> --}}
    </div>
    @endif
</div>
