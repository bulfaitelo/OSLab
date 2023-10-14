<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithFileUploads;

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

    /**
     * Cria uma nova anotação
     */
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

    /**
     * Cria uma nova senha (texto ou padrão)
     */
    public function senhaCreate($senha_padrao) : void {
        $this->senha_padrao = $senha_padrao;
        $this->validate([
            'tipo_senha' => 'required',
            // 'senha_texto' => 'required_if:tipo_senha,texto',
            'senha_padrao' => '|min:4|nullable'
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

        $arquivo = $this->arquivo->storeAs('os/'.$this->os_id, $this->createFileName($this->arquivo), 'public');
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

    /**
     * Download do arquivo
     */
    public function getFile($id) {
        $arquivo = Os::find($this->os_id)
                    ->informacoes
                    ->where('tipo', 3)
                    ->find($id);
        return \Storage::disk('public')->download($arquivo->informacao);
    }

    /**
     * Exibe botão, para excluir item
     */
    public function confirmDelete($id) : void {
        $this->confirmacaoDelete = $id;
    }

    /**
     * Cancela exibição do botão de excluir
     */
    public function cancelDelete() : void {
        $this->confirmacaoDelete = '';
    }


    /**
     * Deleta informação e caso exista arquivo o exclui também
     */
    public function delete($informacao_id) : void {
        try {
            $informacao = Os::find($this->os_id)->informacoes->find($informacao_id);
            if ($informacao->tipo == 3) { // tipo 3 é arquivo
                $delete = \Storage::disk('public')->delete($informacao->informacao);
            }
            $informacao->delete();
            $this->dispatchBrowserEvent('closeModal');
            flasher('Anotação removida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Cria a uuid para compartilhar item
     *
     * @param int $id id da informacao
     * @return void
     **/
    public function createShareUrl(int $id) : void {
        $informacao = Os::find($this->os_id)->informacoes->find($id);
        $informacao->uuid = \Str::uuid();
        $informacao->validade_link = Carbon::now()->addMinutes(getConfig('os_link_time_limit'));
        $informacao->save();
    }

    /**
     * delete a uuid para do item
     *
     * @param int $id id da informacao
     * @return void
     **/
    public function deleteShareUrl(int $id) : void {
        $informacao = Os::find($this->os_id)->informacoes->find($id);
        $informacao->uuid = null;
        $informacao->validade_link = null;
        $informacao->save();
    }

     /**
     * Cria o nome do arquivo enviado
     *
     * Cria o nome do arquivo de forma que remova caracteres especiais e adiciona um uuid curto.
     *
     * @param File $arquivo
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
     * @param Integer $length Tamanho do uuid
     * @return String uuid
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
     * @param String $str
     * @return String
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
