{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Home')

@section('content_header')
    <h1>OSLAB - Home</h1>
@stop

@section('content')
    @livewire('home.show-user-favorites')
    <div class="row mt-3">
        <div class="col-md-2">
            @livewire('home.dashboard.os-status-count-card')
            @livewire('home.dashboard.balancete-card')
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0 pr-3 pl-3">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Receitas Recebidas</h3>
                        <a href="http://oslab.teste/os/create">
                            <button type="button" class="btn btn-sm btn-oslab">
                                {{-- <i class="fa-solid fa-plus"></i> --}}
                                Ver Todas
                            </button>
                        </a>
                    </div>
                </div>
                <div style="height:350px; " class="card-body pl-3 pr-3 pb-3 pt-1">
                    <canvas id="myChart" ></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @livewire('home.dashboard.estatisticas-do-sistema-card')
        </div>
    </div>
    <div class="row ">
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0 pr-3 pl-3">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Garantias Encerrando</h3>
                        <a href="http://oslab.teste/os/create">
                            <button type="button" class="btn btn-sm btn-oslab">
                                {{-- <i class="fa-solid fa-plus"></i> --}}
                                Ver Todas
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm " style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th class=" pr-3 pl-3"  >#</th>
                                <th>Cliente</th>
                                <th style="width: 70px">
                                    <span title="Vencimento" >Venc.</span>
                                </th>
                                <th scope="pr-3" style="width: 65px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pl-3" class="text-truncate" >9</td>
                                <td class="text-truncate">Joãizinho da silva alguma coisa adsdadd</td>
                                <td><span class="badge bg-danger">10/10/2024</span></td>
                                <td class="pr-3">
                                    <a href="#" title="Visualizar" class="btn btn-sm btn-default float-right"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td class="pl-3" >9</td>
                                <td class="text-truncate">Joãizinho da silva alguma coisa adsdadd</td>
                                <td><span class="badge bg-danger">10/10/2024</span></td>
                                <td class="pr-3">
                                    <a href="#" title="Visualizar" class="btn btn-sm btn-default float-right"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            @livewire('home.dashboard.meta-contabil-card')
        </div>
        <div class="col-md-5">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0 pr-3 pl-3">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Atendimentos por categoria</h3>
                        <a href="http://oslab.teste/os/create">
                            <button type="button" class="btn btn-sm btn-oslab">
                                {{-- <i class="fa-solid fa-plus"></i> --}}
                                Ver Todas
                            </button>
                        </a>
                    </div>
                </div>
                <div style="height: 285px;" class="card-body p-3">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .custom-border {
        border-radius: 1.0rem !important;
    }
</style>
@stop

@section('js')

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['janeiro', 'fevereiro', 'março', 'maio', 'abril', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
        datasets: [{
          label: 'Receitas R$',
          data: [12, -19, 3, 5, 2, 3, 10, 30, 50, 90, 20, 15],
          borderWidth: 1,
          borderRadius:10,
          borderColor: 'rgb(93, 82, 239)',
          backgroundColor: 'rgb(93, 82, 239)',
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
                display: false
            }
          },
          x: {
            grid: {
                display: false
            }
          }
        }
      }
    });

    const lines = document.getElementById('lineChart');

    new Chart(lines, {
      type: 'line',
      data: {
        labels: ['janeiro', 'fevereiro', 'março', 'maio', 'abril', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
        // datasets: [{
        //   label: '# of Votes',
        //   data: [12, -19, 3, 5, 2, 3, 10, 30, 50, 90, 20, 15],
        //   borderWidth: 1,
        //   borderRadius:10,
        //   borderColor: 'rgb(93, 82, 239)',
        //   backgroundColor: 'rgb(93, 82, 239)',
        // }]
        datasets: [
            {
                label: 'Acesso Remoto',
                data: [12, -19, 3, 5, 2, 3, 10, 30, 50, 90, 20, 15],
                tension: 0.4
            },
            {
                label: 'Notebook',
                data: [20, -9, 30, 50, 20, 30, 1, 10, 30, 9, 2, 35],
                tension: 0.4
            },
            {
                label: 'Console',
                data: [20, -9, 30, 50, 20, 30, 1, 10, 30, 9, 2, 35],
                tension: 0.4
            }
        ]

      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'left'
            }
        },

        scales: {
          y: {
            beginAtZero: true,
            grid: {
                display: false
            }
          },
          x: {
            grid: {
                display: false
            }
          }
        }
      }
    });
  </script>





@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
