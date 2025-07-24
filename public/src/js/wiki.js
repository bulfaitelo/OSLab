// Confs
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var id = route().params.wiki

// WIKI
function editWiki() {
    $('.texto_wiki').summernote({
        focus: true,
        lang: 'pt-BR',
        height: 300,
    });
    $('#edit_wiki').css('display', 'none');
    $('#save_wiki').css('display', '');
};
function saveWiki() {
    var texto = $("#texto_wiki").summernote("code");
    $.ajax({
        url: route('wiki.text.update', id),
        method: 'PUT',
        data: {
            texto: texto,
        },
        success: function(response) {
            // Primeiro, renderize a notificação
            if (response.flash) {
                // Chama a função global do flasher, passando os dados
                // que o controller preparou para nós.
                window.flasher.render(response.flash);
            }

            // AGORA, atualize a interface
            $('.texto_wiki').summernote('destroy');
            $('#edit_wiki').css('display', '');
            $('#save_wiki').css('display', 'none');
        },
        error: function(xhr, status, error) {
            flasher.error('Ouve um erro, recarregue a pagina e tente novamente');
        }
    });

    // Remova as linhas daqui para que não executem imediatamente
};




    // Validação - LINK
    $(function () {

        $('#linkForm').validate({
            rules: {
                link: {
                    required: true,
                    url: true
                },

            },
            messages: {
                link: {
                    required: "Por favor preencha o Link",
                    url: "Por favor preencha um link valido"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

