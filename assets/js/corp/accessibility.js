/*  Alto contraste  */
var contrast = 0;

if (localStorage.getItem("contrast") == 1) {
    $('body').addClass('alto_contraste');
    contrast++;
}

$('#menuAcessibilidade .contrast').click(function () {
    if ($('body.alto_contraste').length > 0) {
        $('body').removeClass('alto_contraste');
        localStorage.setItem("contrast", 0);
    } else {
        if (contrast == 0) {
            contrast++;
        }
        $('body').addClass('alto_contraste');
        localStorage.setItem("contrast", 1);
    }
});

/* tamanho da fonte */
var tamanho_minimo = parseInt($('html').css('font-size'));
var tamanho_maximo = tamanho_minimo + 5;

if (localStorage.getItem("fontSize")) {
    var tamanho = localStorage.getItem("fontSize");
    $('html').css('font-size', tamanho + 'px');
}

$('#menuAcessibilidade .font-plus').click(function () {
    var tamanho_fonte = parseInt($('html').css('font-size'));
    if (tamanho_maximo === tamanho_fonte) {
        return false;
    }
    var tamanho_novo_fonte = tamanho_fonte + 1;
    $('html').css('font-size', tamanho_novo_fonte + 'px');
    localStorage.setItem("fontSize", tamanho_novo_fonte);
});

$('#menuAcessibilidade .font-minus').click(function () {
    var tamanho_fonte = parseInt($('html').css('font-size'));
    if (tamanho_minimo === tamanho_fonte) {
        return false;
    }
    var tamanho_novo_fonte = tamanho_fonte - 1;
    $('html').css('font-size', tamanho_novo_fonte + 'px');
    localStorage.setItem("fontSize", tamanho_novo_fonte);
});

$('#menuAcessibilidade .font-reset').click(function () {
    $('html').removeAttr('style');
    localStorage.removeItem("fontSize");
});

$("#btnAcessibilidade").click(function () {
    let menu = $("#menuAcessibilidade");

    if (menu.width() == 0) {
        $("#menuAcessibilidade > *").show();
        menu.css({width: "auto"});
    } else {
        $("#menuAcessibilidade > *").hide();
        menu.css({width: 0});
    }
    $(this).toggleClass("opened");
    
})