<div>
    @if ($showDisplay === true)

    <div class="row">
        <div class="col-md-7">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Centro de Custo</th>
                        <th>Valor</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Despesa</td>
                        <td> Material </td>
                        <td>R$ 123,12</td>
                    </tr>
                    <tr>
                        <td>Despesa</td>
                        <td> passagem </td>
                        <td>R$ 23,12</td>
                    </tr>
                    <tr>
                        <td>Receita</td>
                        <td> Manutenção console </td>
                        <td>R$ 100,00</td>
                    </tr>
                    <tr>
                        <td>Pendente</td>
                        <td> </td>
                        <td>R$ 50,00</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Receita Lioquida</td>
                        <td>R$ 50,00</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-5">

            <script>


                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                console.log(donutChartCanvas);
              var donutData        = {
                  labels: [
                      'Passagem',
                      'Material',
                      'Receita Liquida',
                      'Pendente'

                  ],
                  datasets: [
                  {
                      data: [30,100,100,50],
                      backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#f29c12', '#f39c33'],
                  }
                  ]
              }
              var donutOptions     = {
                  maintainAspectRatio : false,
                  responsive : true,
              }
              //Create pie or douhnut chart
              // You can switch between pie and douhnut using the method below.
              new Chart(donutChartCanvas, {
                  type: 'doughnut',
                  data: donutData,
                  options: donutOptions




              })
      </script>


                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>





        </div>
    </div>




    @endif
</div>
