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
            <div class="card custom-border">
                <div class="card-body p-3">
                    <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>
                    <span class="display-1 text-oslab" ><b>3</b></span>
                </div>
            </div>
            <div class="card custom-border">
                <div class="card-body p-3">
                    <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>
                    <div class="row">
                        <div class="col-6" >Despesa</div>
                        <div class="col-6">
                            <span style="float: right" class="">R$ 100,00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6" >Receita</div>
                        <div class="col-6">
                            <span style="float: right" class="">R$ 100,00</span>
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="row">
                        <div class="col-6" >Saldo</div>
                        <div class="col-6">
                            <span style="float: right" class="">R$ 100,00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0">
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
                <div class="card-body p-3">
                    <canvas id="myChart" height="120px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Estatisticas do Sistema</h3>
                        {{-- <a href="http://oslab.teste/os/create">
                            <button type="button" class="btn btn-sm btn-oslab">
                                Ver Todas
                            </button>
                        </a> --}}
                    </div>
                </div>
                <div class="card-body p-3">
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon btn-oslab"><i class="fa-regular fa-rectangle-list"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Ordens de Serviços</span>
                                  <span class="info-box-number">99</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon btn-oslab"><i class="fa-solid fa-users "></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Clientes</span>
                                  <span class="info-box-number">60</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small-box btn-oslab">
                                <div class="inner pt-0 pb-0">
                                  <h3 class="mb-0">99</h3>
                                  <span>Ordens de Serviços</span>
                                </div>
                                <div class="icon">
                                  <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Adicionar OS <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box btn-oslab">
                                <div class="inner pt-0 pb-0">
                                  <h3 class="mb-0">60</h3>
                                  <span>Clientes</span>
                                </div>
                                <div class="icon">
                                  <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Adicionar Cliente <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small-box btn-oslab">
                                <div class="inner">
                                  <h3>99</h3>
                                  <span>Ordens de Serviços</span>
                                </div>
                                <div class="icon">
                                  <i class="fa-regular fa-rectangle-list"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Adicionar OS <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box btn-oslab">
                                <div class="inner">
                                  <h3>60</h3>

                                  <span>Clientes</span>
                                </div>
                                <div class="icon">
                                  <i class="fa-solid fa-users "></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                  Adicionar Cliente <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small-box btn-oslab">
                                <div class="inner">
                                  <h3>99</h3>
                                  <span>Ordens de Serviços</span>
                                </div>
                                <div class="icon">
                                  <i class="fa-regular fa-rectangle-list"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Adicionar OS <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box btn-oslab">
                                <div class="inner">
                                  <h3>60</h3>

                                  <span>Clientes</span>
                                </div>
                                <div class="icon">
                                  <i class="fa-solid fa-users "></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                  Adicionar Cliente <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0">
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
                    <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Cliente</th>
                            <th>Vencimento</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Joãizinho da silva alguma coisa</td>
                            <td><span class="badge bg-danger">10/10/2024</span></td>
                            <td>
                                <a href="#" title="Visualizar" class="btn btn-sm btn-default float-right"><i class="fas fa-eye"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-header pb-0 border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Metas Financeiras</h3>
                        <a href="http://oslab.teste/os/create">
                            <button type="button" class="btn btn-sm btn-oslab">
                                {{-- <i class="fa-solid fa-plus"></i> --}}
                                Ver Todas
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="">
                        {{-- <p class="text-center">
                          <strong>Metas Financeiras</strong>
                        </p> --}}

                        <div class="progress-group">
                            Meta Anual
                            <span class="float-right"><b>R$12.000,00</b>/ R$24.000,00</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            Meta Mensal
                            <span class="float-right"><b>R$680,00</b>/ R$2.000,00</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 30%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            Meta de investimentos
                            <span class="float-right"><b>R$1680,00</b>/ R$6.000,00</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body p-3">
                    <h3>dasdsadasd 6</h3>
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
          label: '# of Votes',
          data: [12, -19, 3, 5, 2, 3, 10, 30, 50, 90, 20, 15],
          borderWidth: 1,
          borderRadius:10,
          borderColor: 'rgb(93, 82, 239)',
          backgroundColor: 'rgb(93, 82, 239)',
        }]
      },
      options: {
        responsive: true,
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
