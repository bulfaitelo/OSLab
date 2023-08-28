$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // tom-select Clientes
    var tomSelectCliente = new TomSelect(".cliente",{
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

    // tom-select Users
    var tomSelectUser = new TomSelect(".user",{
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        // fetch remote data
        load: function(query, callback) {
            var url = route('user.select') + '?q=' + encodeURIComponent(query);
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
                    '<span class="url"> <b> Quant. OS: </b> ' + escape(data.os_count) + '</span>' +
                '</div>';
            },
            item: function(data, escape) {
                return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
            }
        },
    });

    // tom-select Modelos
    var tomSelectModelo = new TomSelect(".modelo",{
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        // fetch remote data
        load: function(query, callback) {
            var url = route('modelo.select') + '?q=' + encodeURIComponent(query);
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
                    '<span class="url"> <b> ' + escape(data.wiki) + '</b> </span>' +
                '</div>';
            },
            item: function(data, escape) {
                return '<div title="' + escape(data.id) + '">' + escape(data.name) + '</div>';
            }
        },
    });

    tomSelectCliente.on('change', function (){
        $('#categoria_id').focus();
    });

    tomSelectModelo.on('change', function () {
        $('#status_id').focus();
    });

    tomSelectUser.on('change', function () {
        $('#categoria_id').focus();

    });

    $('#categoria_id').on('change', function () {
        tomSelectModelo.focus()
    });


    // // Select2 Modelos
    // $(".modelo").select2({
    //     theme: 'bootstrap4',
    //     // dropdownParent: $('#modal-despesa'),
    //     language: "pt-BR",
    //     ajax: {
    //         url: route('modelo.select'),
    //         dataType: 'json',
    //         method: 'post',
    //         delay: 250,
    //         data: function (params) {
    //         return {
    //             q: params.term, // search term
    //         };
    //         },
    //         processResults: function (data, params) {
    //         return {
    //             results: data,
    //         };
    //         },
    //         cache: true
    //     },
    //     placeholder: 'Pesquise pelo Modelo',
    //     minimumInputLength: 3,
    // });


});
