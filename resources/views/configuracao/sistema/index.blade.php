{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Sistema')

@section('content_header')
    <h1><i class="fa-solid fa-sitemap"></i> Sistema </h1>
@stop

@section('content')
<div class="row justify-content-md-center">
    <div class="col-12 col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="#produtos-tab" data-toggle="pill" href="#produtos" role="tab" aria-controls="produtos" aria-selected="true">
                            {{-- <i class="fas fa-box-open "></i> --}}
                            Geral
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="servicos-tab" data-toggle="pill" href="#servicos" role="tab" aria-controls="servicos" aria-selected="false">
                            {{-- <i class="fas fa-hand-holding-usd "></i> --}}
                            OS
                        </a>
                    </li>
                </ul>
            </div>
            {!! html()->form('post', route('configuracao.sistema.store'))->open() !!}
            <div class="card-body">
                    @include('adminlte::partials.form-alert')
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                            GERAl
                        </div>
                        <div class="tab-pane fade" id="servicos" role="tabpanel" aria-labelledby="servicos-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Status Padrão OS</label>
                                        {!! html()->select('sistema[default_os_create_status]', App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
                                        <i>Status que sera carregado por padrão na criação de uma nova Os </i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tempo_link">Tempo da validade do Link: <output id="tempo_link_label">{{getConfig('os_link_time_limit')}}</output> Minutos</label>
                                        <input type="range" name="sistema[os_link_time_limit]" value="{{getConfig('os_link_time_limit')}}" min="1" max="60" step="1" class="custom-range" id="tempo_link" oninput="tempo_link_label.value = tempo_link.value">
                                        <i>Esse parametro define o tempo maximo de validade do link caso o cliente não preencha</i>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Centro de custo padrão</label>
                                        {!! html()->select('default_os_create_', App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
                                        <i>Esse centro centro de custo já será selecionado ao criar um novo.  </i>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Tipo de despesa Padrão</label>
                                        {!! html()->select('sistema[default_os_faturar_produto_despesa]', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar_produto_despesa'))->class('form-control')->placeholder('Selecione') !!}
                                        <i>Tipo de despesa padrão para os produtos quando for faturada uma nova OS</i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Status OS Pagto. em Aberto</label>
                                        {!! html()->select('sistema[default_os_faturar_pagto_parcial]', App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar_pagto_parcial'))->class('form-control')->placeholder('Não alterar status') !!}
                                        <i>Quando a Os for faturada ela irá receber esse status se o valor do pagamento for menor do que o valor total da Os </i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Status OS ao ser Quitada</label>
                                        {!! html()->select('sistema[default_os_faturar_pagto_quitado]', App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), getConfig('default_os_faturar_pagto_quitado'))->class('form-control')->placeholder('Não alterar status') !!}
                                        <i>Quando a Os for faturada ela irá receber esse status se o valor do pagamento igual ou maior do que o valor da Os</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @can('config_sistema_edit')
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-save"></i>
                            Salvar
                        </button>
                    @endcan
                </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
