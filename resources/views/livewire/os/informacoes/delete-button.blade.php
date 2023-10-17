<div class="btn-group btn-group-sm float-right" role="group">
    @if($confirmacaoDelete===$item_id)
        <button wire:click="delete({{ $item_id }})" title="Excluir"
            class="btn btn-left bg-olive " >
            <i class="fa-solid fa-check"></i>
        </button>
        <button wire:click="cancelDelete()" title="Cancelar"
            class="btn btn-left bg-maroon" >
            <i class="fa-solid fa-ban"></i>
        </button>
    @else
        <button wire:click="confirmDelete({{ $item_id }})"
            class="btn btn-left  btn-danger" >
            <i class="fas fa-trash"></i>
        </button>
    @endif
</div>
