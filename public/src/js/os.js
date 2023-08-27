$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // tom-select Clientes
    var tomSelect = new TomSelect(".cliente",{
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        // fetch remote data
        load: function(query, callback) {
            var url = route('cliente.select') + '?q=' + encodeURIComponent(query);
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    callback(json);
                }).catch(()=>{
                    callback();
                });
        },
        render: {
            option: function(data, escape) {
            return '<div>' +
                    '<span class="title">' + escape(data.name) + '</span>' +
                    '<span class="url"> <b> Tipo Cliente: </b> ' + escape(data.tipo) + ' | <b> Quant. OS: </b> ' + escape(data.os_count) + '</span>' +
                '</div>';
            },
            item: function(data, escape) {
                return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
            }
        },
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
