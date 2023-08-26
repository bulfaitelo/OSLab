<div>
    {{-- @dump($produto) --}}
    @include('adminlte::partials.form-alert')
    <form method="POST" wire:submit.prevent="addProduto">
        <div class="row " style="background-color: rgb(238, 238, 238); border-radius: 5px;" >
            <div class="col-md-4">
                <div class="form-group">
                    <label for="produto">Produto</label>
                    <div wire:ignore >
                        <select id="os-produto" wire:model="produto" placeholder="Selecione um produto"></select>
                    </div>
                    {{-- <select wire:model="produto" placeholder="Selecione um produto">
                        <option value="1">aaaa</option>
                        <option value="2">bbbbb</option>
                        <option value="3">cccc</option>
                    </select> --}}

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_custo">Custo</label>
                    <input class="form-control decimal"  value="{{$valor_custo}}" wire:model.defer="valor_custo" type="text" name="busca" id="valor_custo" placeholder="Custo do produto" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_venda">Preço</label>
                    <input class="form-control decimal" value="{{$valor_venda}}"  wire:model.defer="valor_venda" type="text" name="busca" id="valor_venda" placeholder="Preço de venda" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input class="form-control numero" wire:model.defer="quantidade" type="text" name="quantidade" id="quantidade" placeholder="Quantidade" @required(true)>
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

    @if ($produtos->count() > 0)
        <div class="row">
            <table class="table table-sm">
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
                    @foreach ($produtos as $i => $item)
                        <tr wire:key="{{ $loop->index }}" >
                            <td>{{ $item->produto->name }}</td>
                            <td>{{ $item->quantidade }}</td>
                            <td>R$ {{ number_format($item->valor_venda,2,",",".") }}</td>
                            <td>R$ {{ number_format($item->valor_venda_total,2,",",".") }}</td>
                            <td> botao</td>
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
                        <td>R$ {{ number_format($produtos->sum('valor_venda_total'),2,",",".")  }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif
</div>
<link href="{{ url('') }}/vendor/tom-select/tom-select.bootstrap4.min.css" rel="stylesheet" />
<script src="{{ url('') }}/vendor/tom-select/tom-select.complete.min.js"></script>
<script>
    new TomSelect("#os-produto",{
        // allowEmptyOption: true,
        // create: true,
        valueField: 'id',
		labelField: 'name',
		searchField: 'name',
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
</script>
