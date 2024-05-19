<?php

namespace App\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class InformacoesTab extends Component
{
    use WithFileUploads;

    protected $listeners = ['updateInformacoesTable' => '$refresh'];

    public $anotacao;
    public $posts;
    public $os;
    public $descricao_senha;
    public $tipo_senha = 'texto';
    public $senha_texto;
    public $senha_padrao;
    public $arquivo;
    public $descricao_arquivo;


    public function render()
    {
        $informacoes = $this->os->informacoes()->get();
        return view('livewire.os.informacoes-tab', [
            'informacoes'=> $informacoes
        ]);
    }

    /**
     * Cria uma nova anotação
     */
    public function anotacaoCreate() : void {

        $this->validate([
            'anotacao' => 'required|',
        ]);
        DB::beginTransaction();
        try {
            $this->os->informacoes()->create([
                'user_id' => auth()->id(),
                'tipo' => 1,
                'informacao' => $this->anotacao,
                'status'=> 1,
            ]);
            DB::commit();
            $this->dispatch('closeModal');
            $this->anotacao = "";
            flasher('Anotação adicionada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Cria uma nova senha (texto ou padrão)
     */
    public function senhaCreate() : void {
        // $this->senha_padrao = $senha_padrao;
        $this->validate([
            'tipo_senha' => 'required',
            // 'senha_texto' => 'required_if:tipo_senha,texto',
            'senha_padrao' => '|min:4|nullable'
        ]);
        dd($this->senha_texto, $this->senha_padrao);
        DB::beginTransaction();
        try {

            if ($this->tipo_senha == 'texto') {
                $infomacao = $this->senha_texto;
            } else {
                $infomacao = $this->senha_padrao;

            }
            $this->os->informacoes()->create([
                'user_id'=> auth()->id(),
                'descricao' => $this->descricao_senha,
                'tipo'=> 2,
                'tipo_informacao' => $this->tipo_senha,
                'informacao'=> $infomacao,
                'status'=> 1,
            ]);
            DB::commit();
            $this->descricao_senha = "";
            $this->senha_texto = "";
            $this->tipo_senha = "texto";

            $this->dispatch('closeModal');
            flasher('Senha adicionada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Pré validação do arquivo
     */
    public function updatedArquivo()  {
        $this->validate([
            'arquivo' => 'required|max:5120|mimes:zip,pdf,jpg,png,jpeg,bmp',
        ]);
    }

    /**
     * Cria um novo arquivo.
     */
    public function arquivoCreate() : void {
        $this->validate([
            'arquivo' => 'required|max:5120|mimes:zip,pdf,jpg,png,jpeg,bmp',
        ]);

        $arquivo = $this->arquivo->storeAs('os/'.$this->os->id, $this->createFileName($this->arquivo), 'public');
        DB::beginTransaction();
        try {
            $this->os->informacoes()->create([
                'user_id'=> auth()->id(),
                'descricao' => $this->descricao_arquivo,
                'tipo'=> 3,
                'tipo_informacao' => $this->arquivo->extension(),
                'informacao'=> $arquivo,
                'status'=> 1,
            ]);
            $this->descricao_arquivo = '';
            $this->dispatch('closeModal');
            flasher('Arquivo adicionad com sucesso.');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Download do arquivo
     */
    public function getFile($id) {
        $arquivo = $this->os
                    ->informacoes
                    ->where('tipo', 3)
                    ->find($id);
        return \Storage::disk('public')->download($arquivo->informacao);
    }



    /**
     * Cria o nome do arquivo enviado
     *
     * Cria o nome do arquivo de forma que remova caracteres especiais e adiciona um uuid curto.
     *
     * @param $arquivo
     * @return string $fileName
     **/
    private function createFileName($arquivo)
    {
        $fileName = $this->removeSpecialChars($arquivo->getClientOriginalName()).'_'.$this->generateRandomLetters(7).'.'.$arquivo->extension();
        return $fileName;
    }

    /**
     * Gera letras aleatórias para upload de arquivos.
     *
     * @param integer $length Tamanho do uuid
     * @return string uuid
     **/
    private function generateRandomLetters($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }

    /**
     * Tratando caracteres par remover possíveis caracteres inválidos.
     *
     * @param string $str
     * @return string
     **/
    private function removeSpecialChars($str) {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
        $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
        return $str;
    }

}
