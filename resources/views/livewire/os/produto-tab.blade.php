<div>
    <form method="POST" wire:submit.prevent="addProduto">
        <div class="row " style="background-color: rgb(238, 238, 238); border-radius: 5px;" >
            <div class="col-md-4">
                <div class="form-group">
                    <label for="produto">Produto</label>
                    {{-- <div wire:ignore >
                        <select id="os-produto" wire:model="produto" placeholder="Selecione um produto"></select>
                    </div> --}}
                    <select wire:model="produto" placeholder="Selecione um produto">
                        <option value="1">aaaa</option>
                        <option value="2">bbbbb</option>
                        <option value="3">cccc</option>
                    </select>

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_custo">Custo</label>
                    <input class="form-control decimal"   wire:model.defer="valor_custo" type="text" name="busca" id="valor_custo" placeholder="Custo do produto" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_venda">Preço</label>
                    <input class="form-control decimal"  wire:model.defer="valor_venda" type="text" name="busca" id="valor_venda" placeholder="Preço de venda" required>
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
</div>
