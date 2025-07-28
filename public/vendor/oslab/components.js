// Help Popover Custom Element
// Define um novo elemento customizado chamado <help-popover>
// Este elemento pode ser usado para exibir popovers de ajuda com conteúdo dinâmico
// Exemplo de uso: <help-popover content="Seu conteúdo aqui" title="Seu título aqui"></help-popover>
class HelpPopover extends HTMLElement {
    constructor() {
        super(); // Sempre chame super() primeiro
    }

    // Chamado quando o elemento é adicionado ao DOM
    connectedCallback() {
        // Pega os atributos 'content' e 'title' da tag
        const content = this.getAttribute('content') || 'Conteúdo não definido.';
        const title = this.getAttribute('title') || ''; // O título é opcional

        // Cria o elemento <i> interno
        const icon = document.createElement('i');

        // Define os atributos para o popover do Bootstrap
        icon.setAttribute('data-container', 'body');
        icon.setAttribute('data-toggle', 'popover');
        icon.setAttribute('data-placement', 'top');
        icon.setAttribute('data-content', content);
        if (title) {
            icon.setAttribute('title', title);
        }

        // Adiciona as classes para o ícone
        icon.className = 'label_help fa-solid fa-circle-question';

        // Adiciona o ícone ao nosso elemento customizado
        this.appendChild(icon);

        // Inicializa o popover do Bootstrap no ícone que acabamos de criar
        new bootstrap.Popover(icon, {
             trigger: 'hover focus'
        });
    }
}

// Registra a nova tag <help-popover> no navegador
customElements.define('help-popover', HelpPopover);
