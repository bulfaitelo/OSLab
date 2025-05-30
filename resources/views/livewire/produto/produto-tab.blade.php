<div>
    {{-- @include('adminlte::partials.form-alert') --}}
    @if (!$conta_id)
    <form method="POST" wire:submit="create">
        <div class="row" style="background-color: #f7f7f7; border-radius: 5px 5px 0px 0px" >
            <div class="col-md-4">
                <div class="form-group">
                    <label for="produto_id">Produto</label>
                    <div wire:ignore >
                        <select id="os-produto" wire:model="produto_id" wire:change="getProdutoData" placeholder="Selecione um Produto"></select>
                    </div>
                    @error('produto_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_custo">Custo</label>
                    <input
                        class="form-control decimal"
                        wire:model="valor_custo"
                        type="text"
                        name="busca"
                        id="valor_custo"
                        placeholder="Custo do produto"
                        inputmode="numeric"
                    >
                    @error('valor_custo') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_venda">Preço</label>
                    <input
                        class="form-control decimal"
                        wire:model="valor_venda"
                        type="text"
                        name="busca"
                        id="valor_venda"placeholder="Preço de venda"
                        inputmode="numeric"
                    >
                    @error('valor_venda') <span class="error">{{ $message }}</span> @enderror

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="produto_quantidade">Quantidade</label>
                    <input
                        class="form-control numero"
                        wire:model="quantidade"
                        type="text"
                        name="quantidade"
                        id="produto_quantidade"
                        inputmode="numeric"
                        placeholder="Quantidade"
                    >
                    @error('quantidade') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-2 d-flex  text-right align-items-end">
                <div class="form-group">
                    <button type="submmit" class="btn  bg-teal">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar Produto
                    </button>
                </div>
            </div>
        </div>
    </form>
    @endif
    @if ($produto->count() > 0)
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm text-nowrap">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço Unit.</th>
                            <th>Subtotal</th>
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produto as $i => $item)
                            <tr wire:key="{{ $loop->index }}" >
                                <td>{{ $item->produto->name }}</td>
                                <td>{{ $item->quantidade }}</td>
                                <td>R$ {{ number_format($item->valor_venda,2,",",".") }}</td>
                                <td>R$ {{ number_format($item->valor_venda_total,2,",",".") }}</td>
                                <td>
                                    @if (!$conta_id)
                                    <a title="Excluir" wire:click="delete({{ $item->id }})" class="btn btn-block btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style=" border-top: 2px solid rgb(156, 156, 156)">
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-right">
                                <b>
                                    Total:
                                </b>
                            </td>
                            <td>R$ {{ number_format($produto->sum('valor_venda_total'),2,",",".")  }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif

</div>
    <script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script>

<script>
if (!@js($conta_id)) {
    var tomSelectProduto = new TomSelect("#os-produto",{
        // allowEmptyOption: true,
        // create: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        selectOnTab: true,
        sortField:[{field:'$order'},{field:'$score'}],
        // fetch remote data
        load: function(query, callback) {
            var url = route('produto.select') + '?q=' + encodeURIComponent(query);
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    callback(json);
                }).catch(()=>{
                    callback();
                });

        },
        // custom rendering function for options
        render: {
            option: function(data, escape) {
            return '<div>' +
                    '<span class="title">' + escape(data.name) + '</span>' +
                    '<span class="url"> <b> Custo: </b> R$ ' + escape(data.valor_custo) + ' | <b> Venda: </b> R$ ' + escape(data.valor_venda) + ' | <b> Estoque: </b> ' + escape(data.estoque) + '</span>' +
                '</div>';
            },
            item: function(data, escape) {
                return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
            }
        },
    });
    window.addEventListener('clear', event => {
        tomSelectProduto.clear();
        tomSelectProduto.clearOptions();
    })
    tomSelectProduto.on('change', function (e) {
        $('#produto_quantidade').focus();
    });
}
</script>


