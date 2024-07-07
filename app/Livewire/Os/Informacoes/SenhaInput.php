<?php

namespace App\Livewire\Os\Informacoes;

use Livewire\Component;

class SenhaInput extends Component
{
    public $senha;
    public $senha_id;
    public $checkPass;
    public $public = false;

    public function render()
    {
        return view('livewire.os.informacoes.senha-input', [
            'senha' => $this->senha,
            'senha_id' => $this->senha_id,
            'public' => $this->public,
        ]);
    }

    /**
     * Exibe ou oculta botão.
     *
     * @param  int  $id  id
     * @return void
     **/
    public function showPass($id) {
        if ($this->checkPass == $id) {
            $this->checkPass = '';
        } else {
            $this->checkPass = $id;
        }
    }
}
