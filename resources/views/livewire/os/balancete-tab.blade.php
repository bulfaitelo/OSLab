<div>
    @dump($os->contas)
    @if ($showDisplay === true)
    <div class="row">
        <div class="col-md-7">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="border-top-color: white">Tipo</th>
                        <th style="border-top-color: white">Centro de Custo</th>
                        <th style="border-top-color: white" class="text-right">Valor</th>

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
                    </tr>
                    <tr>
                        <td>
                            <span class="badge bg-danger">DÉBITO</span>
                        </td>
                        <td> Material </td>
                        <td>
                            R$ <span class="balancete-debito float-right " >-100,00</span>
                        </td>
                    </tr>

                </tbody>
                <tfoot style=" border-top: 2px solid #dee2e6;">
                    <tr>
                        <td colspan="2">Crédito previsto</td>
                        <td>
                            R$ <span class="float-right " >620,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Crédito pendente</td>
                        <td>
                            R$ <span class="float-right " >400,00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Saldo</b></td>
                        <td>
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
