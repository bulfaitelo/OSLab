$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Select2 Clientes
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

     // Select2 Users
     $(".user").select2({
        theme: 'bootstrap4',
        // dropdownParent: $('#modal-despesa'),
        language: "pt-BR",
        ajax: {
            url: route('user.select'),
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
        placeholder: 'Pesquise pelo Técnico',
        minimumInputLength: 3,
    });

         // Select2 Modelos
         $(".modelo").select2({
            theme: 'bootstrap4',
            // dropdownParent: $('#modal-despesa'),
            language: "pt-BR",
            ajax: {
                url: route('modelo.select'),
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
            placeholder: 'Pesquise pelo Modelo',
            minimumInputLength: 3,
        });
});
