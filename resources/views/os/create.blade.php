@extends('adminlte::page')

@section('title', 'Nova Ordem de Serviço')

@section('content_header')
    <h1><i class="fa-regular fa-rectangle-list "></i> Nova Ordem de Serviço</h1>
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
            {!! html()->form('post', route('os.store'))->acceptsFiles()->open() !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cliente_id">Cliente</label>
                        {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tecnico_id">Técnico Responsavel </label>
                        {!! html()->select('tecnico_id', [Auth()->id() => Auth()->user()->name], Auth()->id())->class('form-control user')->placeholder('Selecione')->required() !!}

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        {!! html()->select('categoria_id', \App\Models\Configuracao\Os\OsCategoria::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione')->required() !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="modelo_id">Modelo</label>
                        {!! html()->select('modelo_id')->class('form-control modelo')->placeholder('Selecione') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        {!! html()->select('status_id', \App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), getConfig('default_os_create_status'))->class('form-control')->placeholder('Selecione') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_entrada">Data Entrada</label>
                        {!! html()->date('data_entrada', Carbon\Carbon::now()->format('d-m-Y'))->class('form-control') !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_saida">Data Saída</label>
                        {!! html()->date('data_saida')->class('form-control') !!}
                    </div>
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_saida">Serial</label>
                        {!! html()->text('serial')->class('form-control')->placeholder('Serial') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        {!! html()->textarea('descricao')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="defeito">Defeito</label>
                        {!! html()->textarea('defeito')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        {!! html()->textarea('observacoes')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="laudo">Laudo</label>
                        {!! html()->textarea('laudo')->class('texto')->placeholder('Status') !!}
                    </div>
                </div>
            </div>
          </div>
          {{-- Minimal with icon only --}}
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
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
                                    '<button type="button"  class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Criar</button>' +
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

        // tom-select Modelos
        var tomSelectModelo = new TomSelect(".modelo",{
            valueField: 'id',
            labelField: 'name',
            searchField: ['name', 'wiki'],
            selectOnTab: true,
            placeholder: 'Selecione o Modelo',
            // fetch remote data
            load: function(query, callback) {
                var url = route('modelo.select') + '?q=' + encodeURIComponent(query);
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
                        '<span class="url"> <b> ' + escape(data.wiki) + '</b> </span>' +
                    '</div>';
                },
                item: function(data, escape) {
                    return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
                },
                @canany(['wiki_create', 'config_wiki_modelo_create'])
                no_results:function(data,escape){
                    return '<div class="no-results">' +
                                '<p>Modelo não Encontrado</p>' +
                                @can('wiki_create')
                                '<a href="'+ route('wiki.create')+'" target="_blank" >' +
                                    '<button type="button"  class="mr-2 btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Wiki </button>' +
                                '</a>' +
                                @endcan
                                @can('config_wiki_modelo_create')
                                '<a href="'+ route('configuracao.wiki.modelo.create')+'" target="_blank" >' +
                                    '<button type="button"  class=" btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Modelo</button>' +
                                '</a>' +
                                @endcan
                            '</div>';
                },
                @endcan
            },
        });

        tomSelectCliente.on('change', function (){
            $('#categoria_id').focus();
        });

        tomSelectModelo.on('change', function () {
            $('#status_id').focus();
        });

        tomSelectUser.on('change', function () {
            $('#categoria_id').focus();

        });

        $('#categoria_id').on('change', function () {
            tomSelectModelo.focus()
        });
    });

    $(document).ready(function() {
        $('.texto').summernote({
            lang: 'pt-BR',
            height: 300,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'clear'] ],
                // [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', ['link', 'picture',]],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    });
</script>
@stop
