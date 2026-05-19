
function formatModelText(text) {
  let formattedText = text
    .replace(/\*([^\*]+)\*/g, "<b>$1</b>")
    .replace(/\_([^\_]+)\_/g, "<i>$1</i>")
    .replace(/\~([^\~]+)\~/g, "<strike>$1</strike>")
    .replace(/\`([^`]+)\`(?![^<]*<\/code>)/g, "<code>$1</code>")
    .replace(/\n\-\s/g, "<br>- ")
    .replace(/\n\d+\.\s/g, "<br>1. ")
    .replace(/`/g, "")
    .replace(/\n/g, "<br>");

  return formattedText;
}



function addFormatting(mark) {
  let inputWhatsApp = document.getElementById("inputWhatsApp");
  let start = inputWhatsApp.selectionStart;
  let end = inputWhatsApp.selectionEnd;
  let selectedText = inputWhatsApp.value.substring(start, end);
  let formattedText = mark + selectedText + mark;
  inputWhatsApp.value = inputWhatsApp.value.substring(0, start) + formattedText + inputWhatsApp.value.substring(end);

  updatePreview();
}
function addList(type) {
  let inputWhatsApp = document.getElementById("inputWhatsApp");
  let start = inputWhatsApp.selectionStart;
  let end = inputWhatsApp.selectionEnd;
  let selectedText = inputWhatsApp.value.substring(start, end);
  let listItems = selectedText.split('\n');
  let formattedText = "";

  if (type === "ul") {
    formattedText = listItems.map(item => "- " + item).join("\n");
  } else if (type === "ol") {
    let index = 1;
    formattedText = listItems.map(item => {
      if (item.startsWith(index + ".")) {
        index++;
        return item.replace(/^\d+\./, index - 1 + ".");
      } else if (item.startsWith((index - 1) + ".")) {
        return item.replace(/^\d+\./, index - 1 + ".1.");
      } else if (item.startsWith((index - 1) + ".1.")) {
        return item.replace(/^\d+\.\d+\./, index - 1 + ".2.");
      } else {
        index++;
        return index - 1 + ". " + item;
      }
    }).join("\n");
  }

  inputWhatsApp.value = inputWhatsApp.value.substring(0, start) + formattedText + inputWhatsApp.value.substring(end);

  updatePreview();
}

function updatePreview() {
  let inputWhatsApp = document.getElementById("inputWhatsApp");
  let previewText = document.getElementById("previewText");

  let formattedText = inputWhatsApp.value
    .replace(/\*([^\*]+)\*/g, "<b>$1</b>")
    .replace(/\_([^\_]+)\_/g, "<i>$1</i>")
    .replace(/\~([^\~]+)\~/g, "<strike>$1</strike>")
    .replace(/\`([^`]+)\`(?![^<]*<\/code>)/g, "<code>$1</code>")
    .replace(/\n\-\s/g, "<br>- ")
    .replace(/\n\d+\.\s/g, "<br>1. ")
    .replace(/`/g, "")
    .replace(/\n/g, "<br>");

  previewText.innerHTML = formattedText;
}


function clearFormatting() {
  let inputWhatsApp = document.getElementById("inputWhatsApp");
  let unformattedText = inputWhatsApp.value.replace(/\*|_|~/g, "");

  inputWhatsApp.value = unformattedText;

  updatePreview();
}

$(document).ready(function() {

    function gerenciarCampos() {
        var tipoSelecionado = $('#canal').val();

        var blocoWhatsApp = $('#bloco-whatsapp');
        var inputWhatsApp = $('#inputWhatsApp');

        var blocoSummernote = $('#bloco-summernote');
        var inputSummernote = $('#inputSummernote');

        // --- Reset Geral ---
        // Primeiro, oculta ambos os blocos e desabilita os campos.
        blocoWhatsApp.hide();
        inputWhatsApp.prop('disabled', true);

        blocoSummernote.hide();
        inputSummernote.prop('disabled', true);

        // Destrói a instância do Summernote se ela existir
        if (inputSummernote.hasClass('note-editor')) {
            inputSummernote.summernote('destroy');
        }

        // --- Lógica de Exibição ---
        if (tipoSelecionado === 'whatsapp') {
            blocoWhatsApp.show();
            // Habilita o campo para que ele seja enviado no formulário
            inputWhatsApp.prop('disabled', false);
        }
        else if (tipoSelecionado === 'notificacao' || tipoSelecionado === 'email') {
            blocoSummernote.show();
            // Habilita o campo
            inputSummernote.prop('disabled', false);

            // Inicia o Summernote
            inputSummernote.summernote({
                placeholder: 'Escreva o conteúdo do email ou da notificação aqui...',
                lang: 'pt-BR',
                height: 300,
                toolbar: [
                    // [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'clear'] ],
                    // [ 'fontname', [ 'fontname' ] ],
                    // [ 'fontsize', [ 'fontsize' ] ],
                    // [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', ] ],
                    [ 'insert', ['link', ]],
                    [ 'view', [ 'undo', 'redo', 'codeview', 'help' ] ]
                ]
            });
        }
    }

    // --- Event Listeners ---
    $('#canal').on('change', gerenciarCampos);

    // Executa na inicialização da página
    gerenciarCampos();
});
