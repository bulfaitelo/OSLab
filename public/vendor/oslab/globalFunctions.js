
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
$('.cep').mask('00000-000');
$('.cnpj').mask('00.000.000/0000-00');

var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };

  $('.telefone').mask(SPMaskBehavior, spOptions);

// Adicionando * automaticamente quando existe Required em um input
$("[required]").prev('label').append("<span class='required-span' title='Este campo é obrigatório'>*</span>");

// Adicionando poopover
$('.help_popover').popover({
    trigger: 'hover'
});

// Adicionando auto Focus para os campos de busca.
$('#collapseFiltros').on('shown.bs.collapse', function () {
    $('#busca').trigger('focus');
});
