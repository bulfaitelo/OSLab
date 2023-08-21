<div>
    {{-- @dump($produto_id) --}}
    @include('adminlte::partials.form-alert')
    <form method="POST" wire:submit.prevent="addProduto">
        <div class="row " style="background-color: rgb(238, 238, 238); border-radius: 5px;" >
            <div class="col-md-4">
                <div class="form-group">
                    <label for="produto_id">Produto</label>
                    {{-- <div wire:ignore>
                        <select name="produto_id" id="produto_id" wire:model="produto_id" class="form-control produto" aria-placeholder="Selecione" required>
                        </select>
                    </div> --}}
                    {{-- {!! html()->select('prpduto_id' )->class('form-control produto')->placeholder('')->required() !!} --}}




                    <select id="select-repo" class="form-control " placeholder="Pick a repository..."></select>




                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_custo">Custo</label>
                    <input class="form-control "  value="{{$valor_custo}}"  type="text" name="busca" id="valor_custo" placeholder="Custo do produto">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_venda">Preço</label>
                    <input class="form-control " value="{{$valor_venda}}"  type="text" name="busca" id="valor_venda" placeholder="Preço de venda">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input class="form-control " wire:model.defer="quantidade" type="text" name="quantidade" id="quantidade" placeholder="Quantidade">
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
        <tr>
            <td>TEla LCD bla bla bla bla bla blabla </td>
            <td>2</td>
            <td>R$ 10,00</td>
            <td>R$ 20,00</td>
        </tr>
        <tr>
            <td>TEla LCD bla bla bla bla bla  dsf dsf sdf sdf dsd f blabla </td>
            <td>2</td>
            <td>R$ 10,00</td>
            <td>R$ 20,00</td>
        </tr>
        <tfoot style=" border-top: 2px solid rgb(156, 156, 156)">
            <tr>

                <td colspan="2"></td>
                <td class="text-right">
                    <b>
                        Total:
                    </b>
                </td>
                <td>R$ 40,00</td>
            </tr>
          </tfoot>

        </tbody>
        </table>

</div>



</div>
