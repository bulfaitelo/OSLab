<div>
    @include('adminlte::partials.form-alert')
    {!! html()->form('put', route('os.update', $os))->acceptsFiles()->open() !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    {!! html()->select('cliente_id', $os->getClienteForSelect(), $os->cliente_id)->class('form-control cliente')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tecnico_id">Tecnico Responsavel </label>
                    {!! html()->select('tecnico_id', $os->getTecnicoForSelect(), $os->tecnico_id)->class('form-control user')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), $os->categoria_id )->class('form-control')->placeholder('Selecione') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="modelo_id">Modelo</label>
                    {!! html()->select('modelo_id', $os->getModeloForSelect(), $os->modelo_id)->class('form-control modelo')->placeholder('Selecione') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    {!! html()->select('status_id', \App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), $os->status_id)->class('form-control')->placeholder('Selecione') !!}
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
            <div class="col-md-5 d-flex align-items-end">
                <div class="form-group text-right">
                    @if ($os->modelo_id)
                        <a target="_blank" href="{{route('wiki.show', $os->modelo->wiki->id)}}">
                            <button type="button"  class="btn bg-primary">
                                <i class="fa-solid fa-book"></i>
                                Wiki
                            </button>
                        </a>
                    @endif
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


        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Salvar
        </button>
    {!! html()->form()->close() !!}
    <script>
        document.addEventListener('livewire:load', function () {
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
            $(document).ready(function() {
                // tom-select Clientes
                var tomSelectCliente = new TomSelect(".cliente",{
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name',
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
                        no_results:function(data,escape){
                            return '<div class="no-results">' +
                                        '<p>Não foram encontrados Clientes </p>' +
                                        '<a href="'+ route('cliente.create')+'">' +
                                            '<button type="button"  class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i>Criar Cliente</button>' +
                                        '</a>' +
                                    '</div>';
                        },
                    },
                });

                // tom-select Users
                var tomSelectUser = new TomSelect(".user",{
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name',
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
                    searchField: 'name',
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
                        }
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

        });


    </script>
</div>
