<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

// use LivewireUI\Modal\ModalComponent;

class InformacoesTab extends Component
{
    use WithFileUploads;

    public $anotacao;
    public $posts;
    public $os_id;
    public $descricao_senha;
    public $tipo_senha = 'texto';
    public $senha_texto;
    public $senha_padrao;
    public $arquivo;
    public $descricao_arquivo;
    public $confirmacaoDelete;

    public function render()
    {
        $informacoes = Os::find($this->os_id)->informacoes;
        return view('livewire.os.informacoes-tab', [
            'informacoes'=> $informacoes
        ]);
    }


    public function anotacaoCreate() : void {

        $this->validate([
            'anotacao' => 'required|',
        ]);
        DB::beginTransaction();
        try {
            $os = Os::find($this->os_id);
            $os->informacoes()->create([
                'user_id' => auth()->id(),
                'tipo' => 1,
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

    public function senhaCreate($senha_padrao) : void {
        $this->senha_padrao = $senha_padrao;
        $this->validate([
            'tipo_senha' => 'required',
            'senha_texto' => 'required_if:tipo_senha,texto',
            'senha_padrao' => 'required_if:tipo_senha,padrao|min:4|nullable'
        ]);
        DB::beginTransaction();
        try {
            $os = Os::find($this->os_id);

            if ($this->tipo_senha == 'texto') {
                $infomacao = $this->senha_texto;
            } else {
                $infomacao = $this->senha_padrao;

            }
            $os->informacoes()->create([
                'user_id'=> auth()->id(),
                'descricao' => $this->descricao_senha,
                'tipo'=> 2,
                'tipo_informacao' => $this->tipo_senha,
                'informacao'=> $infomacao,
            ]);
            DB::commit();
            $this->descricao_senha = "";
            $this->senha_texto = "";
            $this->tipo_senha = "texto";

            $this->dispatchBrowserEvent('closeModal');
            flasher('Senha adicionada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    function updatedArquivo()  {
        $this->validate([
            'arquivo' => 'required|max:5120|mimes:zip,pdf,jpg,png,jpeg,bmp',
        ]);
    }

    function arquivoCreate() : void {
        $this->validate([
            'arquivo' => 'required|max:5120|mimes:zip,pdf,jpg,png,jpeg,bmp',
        ]);
        $arquivo = $this->arquivo->store('os/'.$this->os_id);

        DB::beginTransaction();
        try {
            $os = Os::find($this->os_id);
            $os->informacoes()->create([
                'user_id'=> auth()->id(),
                'descricao' => $this->descricao_arquivo,
                'tipo'=> 3,
                'tipo_informacao' => $this->arquivo->extension(),
                'informacao'=> $arquivo,
            ]);
            $this->descricao_arquivo = '';
            $this->dispatchBrowserEvent('closeModal');
            flasher('Arquivo adicionad com sucesso.');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    function confirmDelete($id) : void {
        $this->confirmacaoDelete = $id;
    }

    function cancelDelete() : void {
        $this->confirmacaoDelete = '';
    }

    function delete($informacao_id) : void {
        try {
            $informacao = Os::find($this->os_id)->informacoes->find($informacao_id);
            if ($informacao->tipo == 3) { // tipo 3 é arquivo
                $delete = Storage::delete($informacao->informacao);
            }
            $informacao->delete();
            $this->dispatchBrowserEvent('closeModal');
            flasher('Anotação removida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
