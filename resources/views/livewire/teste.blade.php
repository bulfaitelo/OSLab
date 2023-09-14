<div>

    <form method="POST"  wire:submit.prevent="create">
        <div class="rendered-form">
            <div id="fb-render"><div class="rendered-form"><div class="formbuilder-checkbox-group form-group field-checkbox-group-1694643742264-0"><label for="checkbox-group-1694643742264-0" class="formbuilder-checkbox-group-label">Grupo de seleção<span class="formbuilder-required">*</span></label><div class="checkbox-group"><div class="formbuilder-checkbox-inline"><input name="checkbox-group-1694643742264-0[]" id="checkbox-group-1694643742264-0-0" required="required" aria-required="true" value="opo-1" type="checkbox"><label for="checkbox-group-1694643742264-0-0">Opção 1</label></div><div class="formbuilder-checkbox-inline"><input name="checkbox-group-1694643742264-0[]" id="checkbox-group-1694643742264-0-1" required="required" aria-required="true" value="opo-2" type="checkbox"><label for="checkbox-group-1694643742264-0-1">Opção 2</label></div></div></div></div></div>
        </div>
    <input type="submit" value="salvar">
    </form>

{{--
    {{ $texto}} {{ $descricao }}
    <form wire:submit.prevent="addTexto" method="POST">
        <select wire:model="texto">
            <option value="texto_a">texto_a</option>
            <option value="texto_b">texto_b</option>
            <option value="texto_cx">texto_cx</option>

        </select>
        <input wire:model.defer="descricao" value="{{ $descricao }}">
        <input type="submit" value="asdsad">

    </form>

<table>
    @foreach ($collection as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->descricao }}</td>
        </tr>
    @endforeach

</table> --}}
</div>
