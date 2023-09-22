<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

// use LivewireUI\Modal\ModalComponent;

class InformacoesTab extends Component
{

    public $anotacao;
    public $posts;
    public $os_id;
    public $descricao_senha;
    public $tipo_senha;
    public $senha_texto;
    public $senha_padrao;

    public function render()
    {
        $informacoes = Os::find($this->os_id)->informacoes;
        return view('livewire.os.informacoes-tab', [
            'informacoes'=> $informacoes
        ]);
    }


    public function anotacaoCreate() : void {

        $validatedData = $this->validate([
            'anotacao' => 'required|',
        ]);


        DB::beginTransaction();
        try {
            $os = Os::find($this->os_id);
            $os->informacoes()->create([
                'user_id' => auth()->id(),
                'tipo' => 'Anotação',
                'informacao' => $this->anotacao
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('closeModal');
            $this->anotacao = "";
            flasher('Anotação adicionada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function senhaCreate() : void {
        dd($this->descricao_senha, $this->tipo_senha, $this->senha_texto, $this->senha_texto, $this->senha_padrao);

    }
}
