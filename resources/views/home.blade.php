{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'OSLab')

@section('content_header')
    <h1>OSLab</h1>
@stop

@section('content')
    @livewire('home.show-user-favorites')
    <div class="row mt-3">
        <div class="col-md-2">
            @livewire('home.dashboard.os-status-count-card')
            @livewire('home.dashboard.balancete-card')
        </div>
        <div class="col-md-6">
            @livewire('home.dashboard.receitas-chart-card')
        </div>
        <div class="col-md-4">
            @livewire('home.dashboard.estatisticas-do-sistema-card')
        </div>
    </div>
    <div class="row ">
        <div class="col-md-3">
            @livewire('home.dashboard.garantia-card')
        </div>
        <div class="col-md-4">
            @livewire('home.dashboard.meta-contabil-card')
        </div>
        <div class="col-md-5">
            @livewire('home.dashboard.atendimentos-categoria-chart-card')
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

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
