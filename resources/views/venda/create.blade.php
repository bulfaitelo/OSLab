@extends('adminlte::page')

@section('title', 'Nova Venda')

@section('content_header')
    <h1><i class="fa-solid fa-store "></i> Nova Venda</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-outline card-primary">
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
                {!! html()->form('post', route('venda.store'))->acceptsFiles()->open() !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vendedor_id">Responsável pela venda</label>
                            {!! html()->select('vendedor_id', [Auth()->id() => Auth()->user()->name], Auth()->id())->class('form-control user')->placeholder('Selecione')->required() !!}

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_saida">Data Saída</label>
                            {!! html()->date('data_saida')->class('form-control') !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="termo_garantia_id">Garantia</label>
                            {!! html()->select('termo_garantia_id', \App\Models\Configuracao\Garantia\Garantia::where('venda', 1)->orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            {!! html()->textarea('descricao')->class('texto')->placeholder('Status') !!}
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
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
<link href="{{ url('') }}/vendor/tom-select/tom-select.bootstrap4.min.css" rel="stylesheet" />
<style>
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
    .ts-control::after {
        display: none!important;
    }

</style>
@stop

@section('js')
@routes
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script>


<script>
    $(document).ready(function() {
        // tom-select Clientes
        var tomSelectCliente = new TomSelect(".cliente",{
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            selectOnTab: true,
            placeholder: 'Selecione o Cliente',
            // fetch remote data
            load: function(query, callback) {
                var url = route('cliente.select') + '?q=' + encodeURIComponent(query);
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json);
                    }).catch(()=>{
                        callback();
                    });
            },
            render: {
                option: function(data, escape) {
                return '<div>' +
                        '<span class="title">' + escape(data.name) + '</span>' +
                        '<span class="url"> <b> Tipo Cliente: </b> ' + escape(data.tipo) + ' | <b> Quant. OS: </b> ' + escape(data.os_count) + '</span>' +
                    '</div>';
                },
                item: function(data, escape) {
                    return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
                },
                @can('cliente_create')
                no_results:function(data,escape){
                    return '<div class="no-results">' +
                                '<p>Cliente não encontrado</p>' +
                                '<a href="'+ route('cliente.create')+'" target="_blank">' +
                                    '<button type="button"  class="btn btn-sm btn-oslab"><i class="fa-solid fa-plus"></i> Criar</button>' +
                                '</a>' +
                            '</div>';
                },
                @endcan
            },
        });

        // tom-select Users
        var tomSelectUser = new TomSelect(".user",{
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            selectOnTab: true,
            placeholder: 'Selecione o Técnico',
            // fetch remote data
            load: function(query, callback) {
                var url = route('user.select') + '?q=' + encodeURIComponent(query);
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json);
                    }).catch(()=>{
                        callback();
                    });
            },
            render: {
                option: function(data, escape) {
                return '<div>' +
                        '<span class="title">' + escape(data.name) + '</span>' +
                        '<span class="url"> <b> Quant. OS: </b> ' + escape(data.os_count) + '</span>' +
                    '</div>';
                },
                item: function(data, escape) {
                    return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
                }
            },
        });

        tomSelectCliente.on('change', function (){
            $('#descricao').focus();
        });
    });

    $(document).ready(function() {
        $('.texto').summernote({
            lang: 'pt-BR',
            height: 200,
            toolbar: [
                // [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'clear'] ],
                // [ 'fontname', [ 'fontname' ] ],
                // [ 'fontsize', [ 'fontsize' ] ],
                // [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', ['link', 'picture',]],
                [ 'view', [ 'undo', 'redo', 'codeview', 'help' ] ]
            ]
        });
    });
</script>
@stop
