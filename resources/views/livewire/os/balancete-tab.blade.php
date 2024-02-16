<div>
    @if ($showDisplay === true)
    @dump($os->balancete())
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered table-sm">
                <thead>
                    {{-- <tr>
                        <th style=""  colspan="3">Total de crédito previsto</th>
                        <th style="" >
                            R$ <span class="float-right " >620,00</span>
                        </th>
                    </tr> --}}
                    <tr>
                        <th>Tipo</th>
                        <th>Centro de Custo</th>
                        <th class="text-right">Previsto</th>
                        <th class="text-right">Executado</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="badge bg-success">CRÉDITO</span>
                        </td>
                        <td> Manutenção Console </td>
                        <td>
                            R$ <span class="balancete-credito float-right " >200,00</span>
                        </td>
                        <td>
                            R$ <span class="balancete-credito float-right " >200,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="badge bg-danger">DÉBITO</span>
                        </td>
                        <td> Material </td>
                        <td>
                            R$ <span class="balancete-debito float-right " >-100,00</span>
                        </td>
                        <td>
                            R$ <span class="balancete-debito float-right " >-100,00</span>
                        </td>
                    </tr>

                </tbody>
                {{-- <tfoot style=" border-top: 2px solid #dee2e6;">
                    <tr>
                        <td colspan="2">Total Crédito</td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Total Débito</td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Saldo</b></td>
                        <td colspan="2" >
                           <b> R$ <span class="balancete-credito float-right " >100,00</span></b>
                        </td>
                    </tr>
                </tfoot> --}}
            </table>

            <table class="table table-bordered table-sm">
                <thead>
                    {{-- <tr>
                        <th style=""  colspan="3">Total de crédito previsto</th>
                        <th style="" >
                            R$ <span class="float-right " >620,00</span>
                        </th>
                    </tr> --}}
                    <tr>
                        <th colspan="2">Totais </th>

                        <th class="text-right">Previsto</th>
                        <th class="text-right">Executado</th>

                    </tr>
                </thead>
                {{-- <tbody>
                    <tr>
                        <td>
                            <span class="badge bg-success">CRÉDITO</span>
                        </td>
                        <td> Manutenção Console </td>
                        <td>
                            R$ <span class="balancete-credito float-right " >200,00</span>
                        </td>
                        <td>
                            R$ <span class="balancete-credito float-right " >200,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="badge bg-danger">DÉBITO</span>
                        </td>
                        <td> Material </td>
                        <td>
                            R$ <span class="balancete-debito float-right " >-100,00</span>
                        </td>
                        <td>
                            R$ <span class="balancete-debito float-right " >-100,00</span>
                        </td>
                    </tr>

                </tbody> --}}
                <tfoot style=" border-top: 2px solid #dee2e6;">
                    <tr>
                        <td colspan="2">Total Crédito</td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Total Débito</td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Saldo</b></td>
                        <td colspan="2" >
                           <b> R$ <span class="balancete-credito float-right " >100,00</span></b>
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

    {{-- <script>
        // document.addEventListener('livewire:load', function () {

            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
        // });
      </script> --}}
</div>
