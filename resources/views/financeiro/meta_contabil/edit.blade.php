@extends('adminlte::page')

@section('title', 'Editar Meta Contábil')

@section('content_header')
    <h1> <i class="fa-regular fa-chart-bar "></i> Editar Meta Contábil</h1>
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
            {!! html()->form('put', route('financeiro.meta_contabil.update', $metaContabil))->open() !!}
                <div class="form-group">
                    <label for="name">Meta Contábil</label>
                    {!! html()->text('name', $metaContabil->name)->class('form-control')->placeholder('Nome do serviço')->required() !!}
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição da Meta</label>
                    {!! html()->text('descricao',$metaContabil->descricao)->class('form-control')->placeholder('descrição da meta (opcional)') !!}
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="valor_meta">
                            Valor da Meta
                            <span class="required-span" title="Este campo é obrigatório">*</span>
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            {!! html()->text('valor_meta', $metaContabil->valor_meta)->class('form-control decimal')->placeholder('Valor da Meta Contábil')->attributes(['inputmode' => 'numeric'])->required() !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">
                                Tipo de Meta
                                <span
                                    class="help_popover h5 d-inline"
                                    data-container="body"
                                    data-toggle="popover"
                                    data-placement="bottom"
                                    data-content="Define o objetivo da meta, se é focada em Receita ou Despesa."
                                    data-original-title=""
                                    title=""
                                >
                                <i class="fa-regular fa-circle-question"></i>
                                </span>
                            </label>
                            <div class="custom-control custom-radio ">
                                {!! html()->radio('tipo_meta')->class('custom-control-input custom-control-input-success')->value('R')->attribute('id', 'receita')->checked($metaContabil->tipo_meta == 'R') !!}
                                <label for="receita" class="custom-control-label">Receita</label>
                            </div>
                            <div class="custom-control custom-radio ">
                                {!! html()->radio('tipo_meta')->class('custom-control-input custom-control-input-danger')->value('D')->attribute('id', 'despesa')->checked($metaContabil->tipo_meta == 'D') !!}
                                <label for="despesa" class="custom-control-label">Despesa</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="meta_liquida">
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
                        <div class="custom-control custom-switch custom-switch-md">
                            {!! html()->checkbox('meta_liquida', $metaContabil->meta_liquida)->class('custom-control-input') !!}
                            <label class="custom-control-label" for="meta_liquida"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="centro_custo_id">Centro de Custo</label>
                            {!! html()->select('centro_custo_id', $centroCustoSelect, $metaContabil->centro_custo_id)->class('form-control')->placeholder('Selecione o Centro de Custo') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="intervalo">Intervalo</label>
                            {!! html()->select('intervalo', $intervalo, $metaContabil->getRawOriginal('intervalo'))->class('form-control')->placeholder('Selecione o intervalo')->required() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                       <label for="exibir_dashboard">Exibir No Dashboard</label>
                        <div class="custom-control custom-switch custom-switch-md">
                            {!! html()->checkbox('exibir_dashboard', $metaContabil->exibir_dashboard)->class('custom-control-input') !!}
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
