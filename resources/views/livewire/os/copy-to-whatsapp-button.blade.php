<button
    type="button"
    title="Copiar orçamento para area de transferência"
    class="btn btn-sm btn-success"
    wire:click="copyToClipboard">
    <i class="fa-solid fa-share"></i>
    @if (!$iconOnly)
        <span class="d-none d-sm-inline">WhatsApp</span>
    @endif
</button>

<script>
    document.addEventListener('livewire:init', function() {
        // Registra o listener global apenas uma vez
        Livewire.on('copyToClipboard', (text) => {
            copyWhatsappText(text);
        });
    });

    function copyWhatsappText(text) {
        // Cria um elemento temporário para copiar o texto
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();

        try {
            document.execCommand('copy');
        } catch (err) {
            // Fallback usando Clipboard API se disponível
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).catch(() => {
                    console.error('Erro ao copiar texto');
                });
            }
        } finally {
            document.body.removeChild(textarea);
        }
    }
</script>

