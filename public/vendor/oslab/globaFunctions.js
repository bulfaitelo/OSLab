
$('#modal-excluir').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var name = button.data('name') // Extract info from data-* attributes
    var url = button.data('url') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-body span').text(name)
    modal.find('form').attr('action', url);
})
