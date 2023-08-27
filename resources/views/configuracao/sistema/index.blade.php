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
            <form action="">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                            GERAl
                        </div>
                        <div class="tab-pane fade" id="servicos" role="tabpanel" aria-labelledby="servicos-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Status Padrão OS</label>
                                        {!! html()->select('default_os_create_status', App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
                                        <i>Status que sera carregado por padrão na criação de uma nova Os </i>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="default_os_create_status">Centro de custo padrão</label>
                                        {!! html()->select('default_os_create_', App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
                                        <i>Esse centro centro de custo já será selecionado ao criar um novo.  </i>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @can('config_sistema_edit')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Salvar
                        </button>
                    @endcan
                </div>
            </form>
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
