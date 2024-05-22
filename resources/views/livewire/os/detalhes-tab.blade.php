<div>
    @include('adminlte::partials.form-alert')
    {!! html()->form('put', route('os.update', $os))->acceptsFiles()->open() !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tecnico_id">Tecnico Responsavel </label>
                    {!! html()->select('tecnico_id')->class('form-control user')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    {!! html()->select('categoria_id', \App\Models\Configuracao\Os\OsCategoria::orderBy('name')->pluck('name', 'id'), $os->categoria_id )->class('form-control')->placeholder('Selecione') !!}
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
                    {!! html()->select('status_id', \App\Models\Configuracao\Os\OsStatus::orderBy('name')->pluck('name', 'id'), $os->status_id)->class('form-control')->placeholder('Selecione') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_entrada">Data Entrada</label>
                    {!! html()->date('data_entrada', $os->data_entrada)->class('form-control') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_saida">Data Saída</label>
                    {!! html()->date('data_saida', $os->data_saida)->class('form-control') !!}
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-end">

            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="serial">Serial</label>
                    {!! html()->text('serial', $os->serial)->class('form-control')->placeholder('Serial') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->textarea('descricao', $os->descricao)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defeito">Defeito</label>
                    {!! html()->textarea('defeito', $os->defeito)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    {!! html()->textarea('observacoes', $os->observacoes)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="laudo">Laudo</label>
                    {!! html()->textarea('laudo', $os->laudo)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-oslab">
            <i class="fas fa-save"></i>
            Salvar
        </button>
    {!! html()->form()->close() !!}

</div>
<script>
    document.addEventListener('livewire:init', function () {
        $(document).ready(function() {
            // tom-select Clientes
            tomSelectCliente = new TomSelect(".cliente",{
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
            // selecionando os dados do cliente
            tomSelectCliente.addOption(@js($os->getClienteForSelect()));
            tomSelectCliente.addItem(@js($os->cliente_id));

            // tom-select tecnico responsavel
            var tomSelectTecnico = new TomSelect(".user",{
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
            tomSelectTecnico.addOption(@js($os->getTecnicoForSelect()));
            tomSelectTecnico.addItem(@js($os->tecnico_id));

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
                    @canany(['wiki_create','config_wiki_modelo_create'])
                    no_results:function(data,escape){
                        return '<div class="no-results">' +
                                    '<p>Modelo não Encontrado</p>' +
                                    @can('wiki_create')
                                    '<a href="'+ route('wiki.create')+'" target="_blank" >' +
                                        '<button type="button"  class="mr-2 btn btn-sm btn-oslab"><i class="fa-solid fa-plus"></i> Wiki </button>' +
                                    '</a>' +
                                    @endcan
                                    @can('config_wiki_modelo_create')
                                    '<a href="'+ route('configuracao.wiki.modelo.create')+'" target="_blank" >' +
                                        '<button type="button"  class=" btn btn-sm btn-oslab"><i class="fa-solid fa-plus"></i> Modelo</button>' +
                                    '</a>' +
                                    @endcan
                                '</div>';
                    },
                    @endcanany
                },
            });
            tomSelectModelo.addOption(@js($os->getModeloForSelect()));
            tomSelectModelo.addItem(@js($os->modelo_id));

            tomSelectCliente.on('change', function (){
                $('#categoria_id').focus();
            });

            tomSelectModelo.on('change', function () {
                $('#status_id').focus();
            });

            tomSelectTecnico.on('change', function () {
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
                    // [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'clear'] ],
                    // [ 'fontname', [ 'fontname' ] ],
                    // [ 'fontsize', [ 'fontsize' ] ],
                    // [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', ['link', 'picture',]],
                    [ 'view', [ 'undo', 'redo', 'codeview', 'fullscreen', 'help' ] ]
                ]
            });
        });
    });
</script>


