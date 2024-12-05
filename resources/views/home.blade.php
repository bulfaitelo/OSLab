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
                <div class="card-body ">
                    <h3>dasdsadasd 2</h3>
                </div>
            </div>
            <div class="card custom-border">
                <div class="card-body ">
                    <h3>dasdsadasd 2</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-border">
                <div class="card-body">
                    <h3>dasdsadasd 4</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body">
                    <h3>dasdsadasd 6</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-body ">
                    <h3>dasdsadasd 3</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-border">
                <div class="card-body">
                    <h3>dasdsadasd 3</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body">
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

@stop

@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
