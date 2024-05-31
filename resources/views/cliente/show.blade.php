@extends('adminlte::page')

@section('title', 'Visualizando Clientes')

@section('content_header')
    <h1><i class="fa-solid fa-users "></i> Visualizando Clientes</h1>
@stop

@section('content')


    <div class="">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
                </a>
                <div class="btn-group btn-group-sm">
                    <a href="http://oslab.teste/cliente/7/edit" title="Editar" class="btn btn-left btn-info">
                        <i class="fa-solid fa-users "></i>
                        Detalhes
                    </a>
                    <a href="http://oslab.teste/cliente/7" title="Editar" class="btn btn-left btn-default">
                        <i class="fa-regular fa-rectangle-list "></i>
                        OS
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            @livewire('cliente.show-cliente', ['cliente' => $cliente], key('detalhes-tab'))

            {{-- Minimal with icon only --}}
            <!-- /.card-body -->
        </div>
      <!-- /.card -->

    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- MASCARA  --}}
    {{-- <script>
        $(document).ready(function(){
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 0000#-0000');
            $('.tel').mask('(00) 0000-0000');
            var CpfCnpjMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
                    },
                cpfCnpjpOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
                    }
                };
            $(function() {
                $(':input[name=registro]').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
            })


        });
    </script>     --}}
@stop
