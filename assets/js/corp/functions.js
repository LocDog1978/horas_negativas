$(document).ready(function () {


    jQuery.fn.exists = function () {
        return jQuery(this).length > 0;
    };
    /* ======================================================================== */
    $.fn.invisible = function () {
        return this.each(function () {
            $(this).css("visibility", "hidden");
        });
    };
    /* ======================================================================== */
    $.fn.visible = function () {
        return this.each(function () {
            $(this).css("visibility", "visible");
        });
    };
    /* ======================================================================== */
    $.fn.removeClassRegex = function (regex) {
        return $(this).removeClass(function (index, classes) {
            return classes.split(/\s+/).filter(function (c) {
                return regex.test(c);
            }).join(' ');
        });
    };
    /* ======================================================================== */
    // let object = $('form').find('input[type=text],input[type=password],textarea,select').filter(':visible:first');
    // $(object).focus();
    // $('form :input:enabled:visible:first').get(0).focus();
    /* ======================================================================== */
});


/* ======================================================================== */
document.addEventListener('keypress', (event) => {
    var name = event.key;
    var code = event.code;
    // Alert the key name and key code on keydown
    // alert(`Key pressed ${name} \r\n Key code value: ${code}`);
    if (name == 'Enter') {
        if ($("button.btn.btn-primary:first").exists()) {
            // alert('button found');
            $("button.btn.btn-primary:first").click();
        } else if ($("a.btn.btn-primary:first").exists()) {
            // alert('link found');
            window.location.href = $("a.btn.btn-primary:first").attr('href');
        }
        // else{
        //     alert('nothing found');
        // }
    }
    // else if (name == 'Escape') {
    //     if ($("button.btn.btn-danger:first").exists()) {
    //         // alert('button found');
    //         $("button.btn.btn-danger:first").click();
    //     }
    // }
}, false);

/* ======================================================================== */

function resetFormMessages() {
    $("[id^='msg']").html("").hide();
    $("[id^='divNotice']").html("").hide();
    $("[id^='divError-']").html("").hide();
    $("*").removeClass("is-invalid");
    $("*").removeClassRegex(/^is-invalid/);
    $("*").removeClass("is-notice");
    $("#msgErroGeral").html("").hide();
    $("#msgSucessoGeral").html("").hide();
    $("#msgAvisoGeral").html("").hide();
}

/* ======================================================================== */

/**
 * joga o foco no primeiro item que deu erro
 *  ou Id fornecido
 */
function setFocusError(idDivError = null) {
    if (idDivError == null) {
        var idDivError = $('[id^="divError-"]:visible:first').prop("id");
    }

    if (idDivError) {
        var identificador = idDivError.substr(idDivError.indexOf("-") + 1)
        $('#' + identificador).focus();
    }

}

/* ======================================================================== */

/**
 * Exibe a senha do campo password ao clicar no ícone "olho"
 */
function exibeSenha(campo_senha, olho) {
    if (campo_senha.attr("type") == "password") {
        campo_senha.attr("type", "text");
        campo_senha.focus();
        olho.attr("data-bs-original-title", "Ocultar senha");
        olho.removeClass("bi-eye-fill");
        olho.addClass("bi-eye-slash-fill");
    } else {
        campo_senha.attr("type", "password");
        campo_senha.focus();
        olho.attr("data-bs-original-title", "Exibir senha");
        olho.removeClass("bi-eye-slash-fill");
        olho.addClass("bi-eye-fill");
    }
}

/* ======================================================================== */

/**
 * Permite somente digitação de números em um campo
 */
function somenteNumero(field) {
    var digits = "0123456789";
    var field_temp = '';
    var field_test
    for (var i = 0; i < field.val().length; i++) {
        field_test = field.val().substring(i, i + 1)
        if (digits.indexOf(field_test) != -1) {
            field_temp += field_test;
        }
    }
    field.val(field_temp);
}

// campo_temp = campo.val().substring(i, i + 1)
// if (digits.indexOf(campo_temp) == -1) {
//     campo.val(campo.val().substring(0, i));
// }
/* ======================================================================== */

/* ======================================================================== */
function isCpfValido(cpf) {
    if (cpf.indexOf('.') != -1) cpf = cpf.replace(/\./g, "");
    if (cpf.indexOf('-') != -1) cpf = cpf.replace(/\-/g, "");
    if (cpf.indexOf('_') != -1) cpf = cpf.replace(/\_/g, "");
    if (cpf.indexOf(' ') != -1) cpf = cpf.replace(/\ /g, "");

    if (cpf.length < 11)
        return false;
    var nonNumbers = /\D/;
    if (nonNumbers.test(cpf))
        return false;
    if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222"
        || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555"
        || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888"
        || cpf == "99999999999")
        return false;

    var a = [];
    var b = new Number;
    var c = 11;
    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) {
        a[9] = 0;
    } else {
        a[9] = 11 - x;
    }
    b = 0;
    c = 11;
    for (y = 0; y < 10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) {
        a[10] = 0;
    } else {
        a[10] = 11 - x;
    }
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]))
        return false;

    return true;
} /* end of function isCpfValido(cpf)  */

/* ======================================================================== */
function isValidPisPasepNis(value) {
    var multiplicadorBase = "3298765432";
    var total = 0;
    var resto = 0;
    var multiplicando = 0;
    var multiplicador = 0;
    var digito = 99;

// Retira a mascara
    var numeroPIS = value.replace(/[^\d]+/g, '');
    var nonNumbers = /\D/;
    if (nonNumbers.test(numeroPIS)) {
        return false;
    }

    if (numeroPIS.length !== 11 ||
        numeroPIS === "00000000000" ||
        numeroPIS === "11111111111" ||
        numeroPIS === "22222222222" ||
        numeroPIS === "33333333333" ||
        numeroPIS === "44444444444" ||
        numeroPIS === "55555555555" ||
        numeroPIS === "66666666666" ||
        numeroPIS === "77777777777" ||
        numeroPIS === "88888888888" ||
        numeroPIS === "99999999999") {
        return false;
    }

    for (var i = 0; i < 10; i++) {
        multiplicando = parseInt(numeroPIS.substring(i, i + 1));
        multiplicador = parseInt(multiplicadorBase.substring(i, i + 1));
        total += multiplicando * multiplicador;
    }
    resto = 11 - (total % 11);
    resto = resto === 10 || resto === 11 ? 0 : resto;
    digito = parseInt("" + numeroPIS.charAt(10));
    return resto === digito;

} /* end of function isValidPisPasepNis(value) */

/* ======================================================================== */

function isDate(stringData) {
    var blnDay, blnMonth, blnYear;
    var blnBarra1, blnBarra2;
    var barra1, barra2;

    var checkDate = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
    if (checkDate.test(stringData)) {
        var arraydata = stringData.split('/');
        var day = parseInt(arraydata[0], 10);
        var month = parseInt(arraydata[1], 10);
        var year = parseInt(arraydata[2], 10);

        var newDate = new Date(year, month - 1, day);
        if ((newDate.getFullYear() == year) && (newDate.getMonth() == month - 1) && (newDate.getDate() == day)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
} /* function IsDate(stringData) */

/* ======================================================================== */

function isEmail(emailAddress) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    reEmail1 = /^[\w!#$%&'*+\/=?^`{|}~-]+(\.[\w!#$%&'*+\/=?^`{|}~-]+)*@(([\w-]+\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
    return reEmail1.test(emailAddress);
}

/* ======================================================================== */

function isPasswordValid(password) {
    rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@#!%*&+-])(?!.*[.])[A-Za-z\d$@#!%*&+-]{10,}/;
    return rePassword.test(password);
}

/* ======================================================================== */
/**
 * Show a "confirm" dialog to the user (using jQuery UI's dialog)
 *
 * @param {string} message The message to display to the user
 * @param {string} okButtonText OPTIONAL - The OK button text, defaults to "Yes"
 * @param {string} cancelButtonText OPTIONAL - The Cancel button text, defaults to "No"
 * @param {string} title OPTIONAL - The title of the dialog box, defaults to "Confirm..."
 * @returns {Q.Promise<boolean>} A promise of a boolean value
 */
function infoDialog(message, title, okButtonText, altura, largura) {
    message = message || 'Mensagem padrão';
    okButtonText = okButtonText || "Ok";
    title = title || "Confirmação...";
    altura = altura || 400;
    largura = largura || 600;

    $('<div></div>')
        .html(message)
        .dialog({
            autoOpen: true,
            height: altura,
            width: largura,
            resizableType: false,
            resizable: false,
            modal: true,
            closeOnEscape: false,
            dialogClass: 'bringToFront',
            title: title,
            buttons: [
                // The OK button
                {
                    text: okButtonText,
                    click: function () {
                        // Resolve the promise as true indicating the user clicked "OK"
                        $(this).dialog("close");
                    },
                },
                // The Cancel button
                {
                    text: 'Cancelar',
                    click: function () {
                        $(this).dialog("close");
                    }
                },
            ],
            close: function (event, ui) {
                // Destroy the jQuery UI dialog and remove it from the DOM
                $(this).dialog("destroy").remove();
            }
        });
} /* fim function infoDialog(message, title, okButtonText) */

/* ======================================================================== */

function formatDate(date, format) {
    const map = {
        m: date.getMonth() + 1,
        d: date.getDate(),
        y: date.getFullYear().toString().slice(-2),
        Y: date.getFullYear()
    }
    return format.replace(/m|d|y|Y/gi, matched => map[matched])
}

/* ======================================================================== */
function dataAtual(format) {
    const now = new Date();
    return formatDate(now, format);
}

/* ======================================================================== */
