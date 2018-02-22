window.exibeMsgGlobais = function() {
    if ($('#_success').length > 0 && $('#_success').val() !== '') {
        toastSucesso($('#_success').val());
        $('#_success').val('');
    }
    var contadorErro = 0;
    var MAX_MSG_ERRO = 5;
    $('input[name^="_errors"]').each(function() {
        if ($(this).val() !== '') {
            if (contadorErro < MAX_MSG_ERRO) {
                toastErro($(this).val());
                $(this).val('');
                contadorErro++;
            }
        }
    });
}

$(document).ready(function() {
    exibeMsgGlobais();
});