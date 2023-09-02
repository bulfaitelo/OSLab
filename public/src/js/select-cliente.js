
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
});
