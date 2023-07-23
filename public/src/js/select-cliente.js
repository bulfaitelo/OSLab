
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".cliente").select2({
        theme: 'bootstrap4',
        // dropdownParent: $('#modal-despesa'),
        language: "pt-BR",
        ajax: {
            url: route('cliente.select'),
            dataType: 'json',
            method: 'post',
            delay: 250,
            data: function (params) {
            return {
                q: params.term, // search term
            };
            },
            processResults: function (data, params) {
            return {
                results: data,
            };
            },
            cache: true
        },
        placeholder: 'Pesquise pelo cliente',
        minimumInputLength: 3,
    });
});
