@extends('adminlte::page')

@section('title', 'Dados da Ordem de Serviço')

@section('content_header')
    <h1><i class="fa-regular fa-rectangle-list "></i> Dados da Ordem de Serviço</h1>
@stop

@section('content')

<div class="card card-primary card-outline">
    <div class="card-header border-0 pb-0">
        <a href="{{ url()->previous() }}">
            <button type="button" title="Voltar" class="btn btn-sm btn-default">
                <i class="fa-solid fa-chevron-left"></i>
                Voltar
            </button>
        </a>
        @can('os_edit')
        <a href="{{ route('os.edit', $os) }}">
            <button type="button" title="Editar" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                Editar
            </button>
        </a>
        @endcan
        @can('os_print')
        <a href="{{ route('os.edit', $os) }}">
            <button type="button" title="Imprimir" class="btn btn-sm bg-navy">
                <i class="fa-solid fa-print"></i>
                Imprimir
            </button>
        </a>
        @endcan

    </div>
    <div class="card-body pt-2">

        {!! $emitente !!}
        <div class="col-md-12 mt-2 mb-2 bloco-div">
            <div class="row">
                <div class="col-md-6">
                    <b>OS Nº: 123456</b>
                </div>
                <div class="col-md-6 text-right">
                    <b>Emissão: 12/12/2023</b>
                </div>
            </div>
        </div>
        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead class="bloco-div">
                <tr>
                    <td colspan="4" class="pt-0 pb-0" ><b>DADOS DO CLIENTE</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  class="pt-0 pb-0"  ><b>Cliente</b></td>
                    <td  class="pt-0 pb-0"   colspan="3"> thiafo fodfodosfos sdofdofdoof sfodoof</td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  ><b> CNPJ/CPF: </b></td>
                    <td  class="pt-0 pb-0"  >126.123.123-83</td>
                    <td  class="pt-0 pb-0"  ><b>Endereço:</b></td>
                    <td  class="pt-0 pb-0"  >Av porto do rosa n40 boladão </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  ><b>CEP:</b></td>
                    <td  class="pt-0 pb-0"  >24470-000</td>
                    <td  class="pt-0 pb-0"  ><b>Cidade/UF</b></td>
                    <td  class="pt-0 pb-0"  > São gonçalo/RJ </td>
                </tr>
                <tr>
                    <td  class="pt-0 pb-0"  ><b>Telefone:</b></td>
                    <td  class="pt-0 pb-0"  > (21) 98765-4321, (21) 98765-4321 </td>
                    <td  class="pt-0 pb-0"  ><b>e-mail:</b></td>
                    <td  class="pt-0 pb-0"  >oslab@oslab.com.br</td>
                </tr>
            </tbody>
        </table>
        <table class=" mt-2 mb-2 table table-sm table-bordered ">
            <thead class="bloco-div">
                <tr>
                    <td colspan="4" class="pt-0 pb-0" ><b>DADOS DO EQUIPAMENTO</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pt-0">
                        <span class="text-dark" style="font-size: 13px" ><b>Equipamento</b></span><br>
                        <span>iphone 12 pro </span>
                    </td>
                    <td  class="pt-0" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Fabricante</b></span><br>
                        <span>iphone 12 pro </span>
                    </td>
                    <td  class="pt-0" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Modelo</b></span><br>
                        <span>A1259</span>
                    </td>
                    <td  class="pt-0" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Serial/Imei</b></span><br>
                        <span>123123213213 1232321 213123 21321 </span>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Descrição</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Defeito</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Observações</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <span  class="text-dark" style="font-size: 13px"  ><b>Laudo</b></span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo voluptas eos inventore modi quae eum dicta magnam sit voluptatem, aspernatur ut ea nisi ex accusamus eveniet repellat, provident cupiditate.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="{{ url('') }}/vendor/patternlock/patternlock.css">
<style>

    .icon{
        width: 3rem;
    }
    .item{
        width: 100%;
    }

    .ts-wrapper .option .title {
        display: block;
    }
    .ts-wrapper .option .url {
        font-size: 15px;
        display: block;
        color: #7c7c7c;
    }

    .ts-wrapper::after {
        display: none;
    }

    .bloco-div {
        background-color: #d5d6d7 ;
    }

</style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script src="{{ url('') }}/vendor/patternlock/patternlock.js"></script>
<script src="{{ url('') }}/vendor/form-builder/form-render.min.js"></script>

{{-- <script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script> --}}
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
    $('.numero').mask('#', { reverse: true });
</script>
@stop
