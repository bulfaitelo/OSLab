<div>
    @include('adminlte::partials.form-alert')
    {!! html()->form('put', route('venda.update', $venda))->acceptsFiles()->open() !!}
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="vendedor_id">Responsável pela venda</label>
                    {!! html()->select('vendedor_id', [Auth()->id() => Auth()->user()->name], Auth()->id())->class('form-control user')->placeholder('Selecione')->required() !!}

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_saida">Data Saída</label>
                    {!! html()->date('data_saida', $venda->data_saida)->class('form-control') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    {!! html()->select('status_id', \App\Models\Configuracao\Parametro\Status::where('os', 1)->orderBy('name')->pluck('name', 'id'), $venda->status_id)->class('form-control')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="termo_garantia_id">Garantia</label>
                    {!! html()->select('termo_garantia_id', \App\Models\Configuracao\Garantia\Garantia::where('venda', 1)->orderBy('name')->pluck('name', 'id'), $venda->termo_garantia_id)->class('form-control')->placeholder('Selecione')->required() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->textarea('descricao', $venda->descricao)->class('texto')->placeholder('Status') !!}
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
            tomSelectCliente.addOption(@js($venda->getClienteForSelect()));
            tomSelectCliente.addItem(@js($venda->cliente_id));

            // tom-select Vendedor
            var tomSelectVendedor = new TomSelect(".user",{
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                selectOnTab: true,
                placeholder: 'Selecione o Vendedor',
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
            tomSelectVendedor.addOption(@js($venda->getVendedorForSelect()));
            tomSelectVendedor.addItem(@js($venda->vendedor_id));

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
