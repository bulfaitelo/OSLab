@extends('adminlte::page')

@section('title', 'Criar Meta Contábil')

@section('content_header')
    <h1> <i class="fa-regular fa-chart-bar "></i> Criar Meta Contábil</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-9 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
              </a>
            </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            @include('adminlte::partials.form-alert')
            {!! html()->form('post', route('servico.store'))->acceptsFiles()->open() !!}


                <div class="form-group">
                    <label for="name">Meta Contábil</label>
                    {!! html()->text('name')->class('form-control')->placeholder('Nome do serviço')->required() !!}
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição da Meta</label>
                    {!! html()->text('descricao')->class('form-control')->placeholder('descrição do serviço (opcional)') !!}
                </div>
                <label for="valor_servico">Valor da Meta</label>
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            {!! html()->text('valor_servico')->class('form-control decimal')->placeholder('Valor do serviço')->attributes(['inputmode' => 'numeric']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-switch custom-switch-md">
                            {!! html()->checkbox('chek_ativo', true)->class('custom-control-input') !!}
                            <label class="custom-control-label" for="chek_ativo">
                                Valor Liquido
                                <span
                                    class="help_popover h5 d-inline"
                                    data-container="body"
                                    data-toggle="popover"
                                    data-placement="bottom"
                                    data-content="Define se o valor será Liquido, isso é, em caso de que existam receitas e despesas para a mesmo centro de custo."
                                    data-original-title=""
                                    title="">
                                    <i class="fa-regular fa-circle-question"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="centro_custo_id">Centro de Custo</label>
                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('receita', '1')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione o Centro de Custo') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="intervalo">Intervalo</label>
                            {!! html()->select('intervalo', $intervalo)->class('form-control')->placeholder('Selecione o intervalo')->required() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                       <label for="exibir_dashboard">Exibir No Dashboard</label>
                        <div class="custom-control custom-switch custom-switch-md">
                            {!! html()->checkbox('exibir_dashboard', true)->class('custom-control-input') !!}
                            <label class="custom-control-label" for="exibir_dashboard"></label>
                        </div>
                    </div>
                </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-oslab">
                <i class="fas fa-save"></i>
                Salvar
            </button>
          </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}
      </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
@stop
