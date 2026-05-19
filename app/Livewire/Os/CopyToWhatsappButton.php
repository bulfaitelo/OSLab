<?php

namespace App\Livewire\Os;

use App\Models\Configuracao\Sistema\Emitente;
use Livewire\Component;

class CopyToWhatsappButton extends Component
{
    public $os;

    public $iconOnly = false;

    public function render()
    {
        return view('livewire.os.copy-to-whatsapp-button');
    }

    public function mount()
    {
        $this->dispatch('registerCopyListener');
    }

    /**
     * Gera o texto formatado para copiar para WhatsApp.
     */
    public function getWhatsappText(): string
    {
        $text = '';

        if (Emitente::first()->fantasia) {
            $text .= '*'.Emitente::first()->fantasia."*\n";
        } else {
            $text .= '*'.Emitente::first()->name."*\n";
        }
        // Número da OS
        $text .= '*OS #'.str_pad($this->os->id, 5, '0', STR_PAD_LEFT)."*\n";

        // Cliente
        if ($this->os->cliente) {
            $clienteName = substr($this->os->cliente->name, 0, 50);
            $text .= '*Cliente:* '.$clienteName."\n";
        }

        // Emitente (Técnico)
        if ($this->os->tecnico) {
            $tecnicoName = substr($this->os->tecnico->name, 0, 50);
            $text .= '*Técnico:* '.$tecnicoName."\n";
        }

        // Status
        if ($this->os->status) {
            $text .= '*Status:* '.$this->os->status->name."\n";
        }

        // // Categoria
        // if ($this->os->categoria) {
        //     $text .= 'Categoria: '.$this->os->categoria->name."\n";
        // }

        $text .= "\n*PRODUTOS E SERVIÇOS*\n";

        // Produtos
        $produtos = $this->os->produtos()->get();
        if ($produtos->count() > 0) {
            foreach ($produtos as $produto) {
                $nomeProd = substr($produto->produto->name, 0, 40);
                $qty = $produto->quantidade;
                $valor = number_format($produto->valor_venda, 2, ',', '.');
                $text .= '• '.$nomeProd.' x'.$qty.' - R$ '.$valor."\n";
            }
        }

        // Serviços
        $servicos = $this->os->servicos()->get();
        if ($servicos->count() > 0) {
            foreach ($servicos as $servico) {
                $nomeServ = substr($servico->servico->name, 0, 40);
                $qty = $servico->quantidade;
                $valor = number_format($servico->valor_servico, 2, ',', '.');
                $text .= '• '.$nomeServ.' x'.$qty.' - R$ '.$valor."\n";
            }
        }

        // Valor Total
        if ($this->os->valorTotal()) {
            $totalFormatado = number_format($this->os->valorTotal(), 2, ',', '.');
            $text .= "\n*Total: R$ ".$totalFormatado."*\n";
        }

        // Seção de Informações Adicionais (sem limite)
        // $temInfoAdicional = false;

        // if ($this->os->descricao && trim($this->os->descricao) !== '') {
        //     if (! $temInfoAdicional) {
        //         $text .= "\n*INFORMAÇÕES ADICIONAIS*\n";
        //         $temInfoAdicional = true;
        //     }
        //     $text .= "\n*Descrição:*\n".trim($this->os->descricao);
        // }

        // if ($this->os->defeito && trim($this->os->defeito) !== '') {
        //     if (! $temInfoAdicional) {
        //         $text .= "\n*INFORMAÇÕES ADICIONAIS*\n";
        //         $temInfoAdicional = true;
        //     } else {
        //         $text .= "\n";
        //     }
        //     $text .= "\n*Defeito:*\n".trim($this->os->defeito);
        // }

        // if ($this->os->observacoes && trim($this->os->observacoes) !== '') {
        //     if (! $temInfoAdicional) {
        //         $text .= "\n*INFORMAÇÕES ADICIONAIS*\n";
        //         $temInfoAdicional = true;
        //     } else {
        //         $text .= "\n";
        //     }
        //     $text .= "\n*Anotação:*\n".trim($this->os->observacoes);
        // }

        // if ($this->os->laudo && trim($this->os->laudo) !== '') {
        //     if (! $temInfoAdicional) {
        //         $text .= "\n*INFORMAÇÕES ADICIONAIS*\n";
        //         $temInfoAdicional = true;
        //     } else {
        //         $text .= "\n";
        //     }
        //     $text .= "\n*Laudo:*\n".trim($this->os->laudo);
        // }

        return $text;
    }

    /**
     * Action para copiar o texto para a área de transferência via JS.
     */
    public function copyToClipboard()
    {
        $this->dispatch('copyToClipboard', $this->getWhatsappText());
        flash('Texto copiado para a área de transferência!');
    }
}
