// Busca CNPJ
$(document).ready(function() {
    $('#busca_cnpj').click(function() {
        var cnpj = $('#registro').val().replace(/\D/g, '');

        if (validateCnpj(cnpj)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#name").val("...");
            $("#email").val("...");
            $("#cep").val("...");
            $("#logradouro").val("...");
            $("#numero").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");
            $("#complemento").val("...");
            $("#telefone").val("...");
            //Consulta o webservice receitaws.com.br/
            $.ajax({
                url: "https://www.receitaws.com.br/v1/cnpj/" + cnpj,
                dataType: 'jsonp',
                crossDomain: true,
                contentType: "text/javascript",
                success: function (dados) {

                    if (dados.status == "OK") {
                        //Atualiza os campos com os valores da consulta.
                        if ($("#name").val() != null) {
                            $("#name").val(capital_letter(dados.nome));
                        }
                        if ($("#nomeEmitente").val() != null) {
                            $("#nomeEmitente").val(capital_letter(dados.nome));
                        }
                        $("#cep").val(dados.cep.replace(/\./g, ''));
                        $("#email").val(dados.email.toLocaleLowerCase());
                        $("#telefone").val(dados.telefone.split("/")[0].replace(/\ /g, ''));
                        $("#logradouro").val(capital_letter(dados.logradouro));
                        $("#numero").val(dados.numero);
                        $("#bairro").val(capital_letter(dados.bairro));
                        $("#cidade").val(capital_letter(dados.municipio));
                        $("#uf").val(dados.uf);
                        if (dados.complemento != "") {
                            $("#complemento").val(capital_letter(dados.complemento));
                        } else{
                            $("#complemento").val("");
                        }

                        // Força uma atualizacao do endereco via cep
                        //document.getElementById("cep").focus();
                        if ($("#name").val() != null) {
                            document.getElementById("name").focus();
                        }
                        if ($("#nomeEmitente").val() != null) {
                            document.getElementById("nomeEmitente").focus();
                        }
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        if ($("#name").val() != null) {
                            $("#name").val("");
                        }
                        if ($("#nomeEmitente").val() != null) {
                            $("#nomeEmitente").val("");
                        }
                        $("#cep").val("");
                        $("#email").val("");
                        $("#numero").val("");
                        $("#complemento").val("");
                        $("#telefone").val("");

                        Swal.fire({
                            type: "warning",
                            title: "Atenção",
                            text: "CNPJ não encontrado."
                        });
                    }
                },
                error: function () {
                    ///CEP pesquisado não foi encontrado.
                    if ($("#name").val() != null) {
                        $("#name").val("");
                    }
                    if ($("#nomeEmitente").val() != null) {
                        $("#nomeEmitente").val("");
                    }
                    $("#cep").val("");
                    $("#email").val("");
                    $("#numero").val("");
                    $("#complemento").val("");
                    $("#telefone").val("");

                    Swal.fire({
                        type: "warning",
                        title: "Atenção",
                        text: "CNPJ não encontrado."
                    });
                },
                timeout: 2000,
            });
        } else {
            $('#registro').addClass('is-invalid');
            $('#msg_cpnj_error').text('CNPJ Invalido');
        }
    });

    $('#registro').keyup(function() {
        var registro = $('#registro').val().replace(/\D/g, '');
        if(registro.length> 0){
            if (validateCpfCnpj(registro)) {
                $('#registro').addClass('is-valid').removeClass('is-invalid');
                $('#msg_cpnj_error').text('');
                if (registro.length == 14) {
                    $('#busca_cnpj').attr("disabled", false);
                }

            } else {
                $('#registro').addClass('is-invalid').removeClass('is-valid');
                $('#msg_cpnj_error').text('CPF ou CNPJ Invalido');
                $('#busca_cnpj').attr("disabled", true);
            }
        } else {
            $('#registro').removeClass('is-valid').removeClass('is-invalid');
            $('#msg_cpnj_error').text('');
            $('#busca_cnpj').attr("disabled", true);
        }
    });

    function validateCpfCnpj(registro){
        registro = registro.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

        if (registro.length == 14) {
            return validateCnpj(registro);
        } else if (registro.length == 11) {
            return validateCpf(registro);
        }
    }

    function capital_letter(str) {
        if (typeof str === 'undefined') { return; }
        str = str.toLocaleLowerCase().split(" ");

        for (var i = 0, x = str.length; i < x; i++) {
            str[i] = str[i][0].toUpperCase() + str[i].substr(1);
        }

        return str.join(" ");
    }
    function validateCnpj(cnpj) {
        cnpj = cnpj.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

        if (cnpj.length !== 14) {
            return false;
        }
        // Verifica se todos os dígitos são iguais
        if (/^(\d)\1+$/.test(cnpj)) {
            return false;
        }
        // Calcula os dígitos verificadores
        var tamanho = cnpj.length - 2;
        var numeros = cnpj.substring(0, tamanho);
        var digitos = cnpj.substring(tamanho);
        var soma = 0;
        var pos = tamanho - 7;
        for (var i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) {
            pos = 9;
            }
        }
        var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) {
            return false;
        }

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (var i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) {
            pos = 9;
            }
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)) {
            return false;
        }

        return true;

    }
    function validateCpf(cpf) {
        cpf = cpf.replace(/\D/g, '');
        console.log(cpf);
        if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
        var result = true;
        [9,10].forEach(function(j){
            var soma = 0, r;
            cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
                soma += parseInt(e) * ((j+2)-(i+1));
            });
            r = soma % 11;
            r = (r <2)?0:11-r;
            if(r != cpf.substring(j, j+1)) result = false;
        });
        return result;
    }

});
// BUSCA CEP
$(document).ready(function() {
    $('#cep').blur(function() {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep.length == 8) {
        $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
        if (!("erro" in data)) {
            $('#logradouro').val(data.logradouro);
            $('#bairro').val(data.bairro);
            $('#cidade').val(data.localidade);
            $('#uf').val(data.uf);
            $('#cep').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
            $('#numero').focus();
        } else {
            $('#cep').removeClass('is-valid').removeClass('is-invalid').addClass('is-invalid');
        }
        });
    }
    });
});

