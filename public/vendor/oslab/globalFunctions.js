
$('#modal-excluir').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var name = button.data('name') // Extract info from data-* attributes
    var url = button.data('url') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-body span').text(name)
    modal.find('form').attr('action', url);
})

// Formatação padrão
$('.decimal').mask('#.##0,00', { reverse: true });
$('.hora').mask('00:00', { reverse: true });
$('.int').mask('#0', { reverse: true });

// Adicionando * automaticamente quando existe Required em um input
$("[required]").prev('label').append("<span class='required-span' title='Este campo é obrigatório'>*</span>");
