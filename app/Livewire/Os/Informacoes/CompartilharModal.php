<?php

namespace App\Livewire\Os\Informacoes;

use App\Models\Os\Os;
use Carbon\Carbon;
use Livewire\Component;

class CompartilharModal extends Component
{
    public $item;

    public $os_id;

    public $informacao_id;

    protected $listeners = ['open' => 'loadCompartilharModal'];

    public function loadCompartilharModal($informacao_id, $os_id)
    {
        $this->informacao_id = $informacao_id;
        $this->os_id = $os_id;
        $this->dispatch('toggleCompartilharModal');
    }

    public function render()
    {
        $this->item = Os::find($this->os_id)?->informacoes->find($this->informacao_id);

        return view('livewire.os.informacoes.compartilhar-modal', [
            'item' => $this->item,
        ]);
    }

    /**
     * Cria a uuid para compartilhar item.
     *
     * @param  int  $id  id da informacao
     **/
    public function createShareUrl(int $id): void
    {
        $informacao = Os::find($this->os_id)->informacoes->find($id);
        $informacao->uuid = \Str::uuid();
        $informacao->validade_link = Carbon::now()->addMinutes((int) getConfig('os_link_time_limit'));
        $informacao->save();
        $this->dispatch('updateInformacoesTable');
    }

    /**
     * Delete a uuid para do item.
     *
     * @param  int  $id  id da informacao
     **/
    public function deleteShareUrl(int $id): void
    {
        $informacao = Os::find($this->os_id)->informacoes->find($id);
        $informacao->uuid = null;
        $informacao->validade_link = null;
        $informacao->save();
        $this->dispatch('updateInformacoesTable');
    }
}
