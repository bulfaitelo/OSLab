<div>
    {{-- @include('adminlte::partials.form-alert') --}}
    @if (!$os->conta_id)
    <form method="POST" wire:submit="create">
        <div class="row" style="background-color: #f7f7f7; border-radius: 5px 5px 0px 0px" >
            <div class="col-md-6">
                <div class="form-group">
                    <label for="servico_id">Serviço</label>
                    <div wire:ignore >
                        <select id="os-servico" wire:model="servico_id" wire:change="getServicoData" placeholder="Selecione um Serviço"></select>
                    </div>
                    @error('servico_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_servico">Preço</label>
                    <input
                        class="form-control decimal"
                        wire:model="valor_servico"
                        type="text" name="busca"
                        id="valor_servico"
                        inputmode="numeric"
                        placeholder="Preço do serviço"
                    >
                    @error('valor_servico') <span class="error">{{ $message }}</span> @enderror

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="servico_quantidade">Quantidade</label>
                    <input
                        class="form-control numero"
                        wire:model="quantidade"
                        type="text"
                        name="quantidade"
                        id="servico_quantidade"
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
                        Adicionar Serviço
                    </button>
                </div>
            </div>
        </div>
    </form>
    @endif
    @if ($os_servico->count() > 0)
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm text-nowrap">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Quantidade</th>
                            <th>Preço Unit.</th>
                            <th>Subtotal</th>
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($os_servico as $i => $item)
                            <tr wire:key="{{ $loop->index }}" >
                                <td>{{ $item->servico->name }}</td>
                                <td>{{ $item->quantidade }}</td>
                                <td>R$ {{ number_format($item->valor_servico,2,",",".") }}</td>
                                <td>R$ {{ number_format($item->valor_servico_total,2,",",".") }}</td>
                                <td>
                                    @if (!$os->conta_id)
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
                            <td>R$ {{  number_format($os_servico->sum('valor_servico_total'),2,",",".")  }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif


</div>
<script>
if (!@js($os->conta_id)) {
    var tomSelectServico = new TomSelect("#os-servico",{
        // allowEmptyOption: true,
        // create: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        selectOnTab: true,
        // fetch remote data
        load: function(query, callback) {
            var url = route('servico.select') + '?q=' + encodeURIComponent(query);
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
                    '<span class="url"> <b> Valor Serviço: </b> R$ ' + escape(data.valor_servico) + ' <b>  </span>' +
                '</div>';
            },
            item: function(data, escape) {
                return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
            }
        },
    });
    window.addEventListener('clear', event => {
        tomSelectServico.clear();
        tomSelectServico.clearOptions();
    })
    tomSelectServico.on('change', function (e) {
        $('#servico_quantidade').focus();
    });
}
</script>

