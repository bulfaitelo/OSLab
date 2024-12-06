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
        <div class="col-md-4">
            <div class="card custom-border">
                <div class="card-body"p-3>
                    <h3>dasdsadasd 4</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body"p-3>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-body p-3">
                    <h3>dasdsadasd 3</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-body"p-3>
                    <h3>dasdsadasd 3</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body"p-3>
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
