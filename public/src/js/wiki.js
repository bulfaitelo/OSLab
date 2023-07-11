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
    var texto = $("#texto_wiki").summernote("code")
    $.ajax({
        url: route('wiki.text.update', id),
        method: 'PUT',
        data: {
            texto: texto,
        },
        success: function(response) {
            // console.log(response);
            flasher.success(response.text);
        },
        error: function(xhr, status, error) {
            flasher.error('Ouve um erro, recarregue a pagina e tente novamente');
        }
    });

    $('.texto_wiki').summernote('destroy');
    $('#edit_wiki').css('display', '');
    $('#save_wiki').css('display', 'none');
};
// FIM - WIKI
// Links
    // function saveLink (){
    //     var name_link = $('#name_link').val();
    //     var link = $('#link').val();
    //     $.ajax({
    //         url: route('wiki.link.create', id),
    //         method: 'POST',
    //         data: {
    //             name_link : name_link,
    //             link : link
    //         },
    //         success: function(response) {
    //             $('#name_link').val('');
    //             $('#link').val('');
    //             $('#modal-link').modal('toggle');
    //             flasher.success(response.text);
    //             console.log(response);
    //         },
    //         erro: function (xhr, status, error){
    //             console.log(error);
    //         }
    //     });
    // }


    // Validação
    $(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                saveLink()
            }
        });
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
    // FIM - Validação

    // GErando listagem de links
    // function getLinks() {
    //     $.ajax({
    //         url: route('wiki.link.get', id),
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function (response) {
    //             console.log(response);
    //             $.each(response, function (index, value) {
    //                 $('#table_link').append('<tr><td class="p-2 text-truncate" ><a href="' + value.link + '" target="_blank" rel="noopener noreferrer">' + value.name + '</a></td><td class="text-right" style="width: 40px" ><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-excluir_' + value.id + '"><i class="fas fa-trash"></i></button></td></tr>')
    //                 // $('#table_link').append('<tr><td>' + value.link + '</td><td></td></tr>');
    //             });
    //         }
    //     });
    // }
    // Fim GErando listagem de links


// Fim - Links
