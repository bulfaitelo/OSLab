<?php

namespace App\Livewire\Os\Informacoes;

use App\Models\Os\Os;
use Livewire\Component;

class DeleteButton extends Component
{
    public $confirmacaoDelete;

    public $item_id;

    public $os_id;

    public function render()
    {
        return view('livewire.os.informacoes.delete-button');
    }

    /**
     * Exibe botão, para excluir item.
     */
    public function confirmDelete($id): void
    {
        $this->confirmacaoDelete = $id;
    }

    /**
     * Cancela exibição do botão de excluir.
     */
    public function cancelDelete(): void
    {
        $this->confirmacaoDelete = '';
    }

    /**
     * Deleta informação e caso exista arquivo o exclui também.
     */
    public function delete($informacao_id): void
    {
        try {
            $informacao = Os::find($this->os_id)->informacoes->find($informacao_id);
            if ($informacao->tipo == 3) { // tipo 3 é arquivo
                $delete = \Storage::disk('public')->delete($informacao->informacao);
            }
            $informacao->delete();
            $this->dispatch('closeModal');
            flasher('Anotação removida com sucesso.');
            $this->dispatch('updateInformacoesTable');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
