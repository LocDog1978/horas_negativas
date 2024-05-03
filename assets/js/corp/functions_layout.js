$(document).ready(function () {


    /* habilita o tooltip nos elementos com a propriedade data-bs-toggle='tooltip' */
    /* $("[data-bs-toggle='tooltip']").tooltip(); */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })


    /* habilita o popover nos elementos com a propriedade data-bs-toggle='popover' */
    $("[data-bs-toggle='popover']").popover();

    /*
    * Menu Vertical com subníveis colapsáveis
    * fonte: https://www.codehim.com/bootstrap/bootstrap-vertical-menu-with-submenu-on-click/
    */
    $('.offcanvas-body .sub-menu ul').hide();
    $(".offcanvas-body .sub-menu a").click(function () {
        $(this).parent(".offcanvas-body .sub-menu").children("ul").slideToggle("100");
        $(this).toggleClass("opened");
    });

    ajusteHeader();
    ajusteFooter();
});

$(window).resize(function () {
    ajusteHeader();
    ajusteFooter();
});

/* Ajuste da altura da página para exibir o rodapé sempre no final */
function ajusteFooter() {

    if ($('body').height() < window.innerHeight) {

        let isLogged = $(".is-logged");
        let heightHeader, heightFooter, margins, diferenca;
        let heightIsLogged = 0;

        if (isLogged.length == 1) {
            heightIsLogged = isLogged.height()
        }

        heightHeader = $("header").height();
        heightFooter = $("footer").height() + parseInt($("footer").css('padding-top')) + parseInt($("footer").css('padding-bottom'));
        margins = parseInt($("main#pageContent").css('margin-top')) + parseInt($("main#pageContent").css('margin-bottom'));
        diferenca = heightHeader + heightFooter + margins + heightIsLogged + "px";
        $("main#pageContent").css({minHeight: "calc(100vh - " + diferenca + ")"});
    }

    // Ajuste de margens do <body> para quando utilizar Header fixo no topo (.fixed-top) ou Footer fixo na base (.fixed-bottom)
    $("body").css({
        marginTop: $(".fixed-top").height() + parseInt($(".fixed-top").css('padding-top'), 10) + parseInt($(".fixed-top").css('padding-bottom'), 10) + 12,
        marginBottom: $(".fixed-bottom").height() + parseInt($(".fixed-bottom").css('padding-top'), 10) + parseInt($(".fixed-bottom").css('padding-bottom'), 10) + 12
    });

}


/*
* Ajusta os tamanhos de fonte e espeçamento do cabeçalho em função do tamanho da logo,
* seguindo o manual de uso da marca Uerj
*/
function ajusteHeader() {

    let logo_uerj = $(".marca .logo-uerj");
    let logo_uerj_img = $(".marca .logo-uerj > img");
    if (logo_uerj_img.length == 0){
        logo_uerj_img = $(".marca .logo-uerj > svg");
    }
    let logo = $(".marca .logo");
    let logo_img = $(".marca .logo > img");
    let titulo = $(".marca .titulo");
    let sigla = $(".marca .sigla");
    let nome = $(".navbar .nome");
    let z, x;
    z = logo_uerj_img.height();
    x = z / 5;

    logo_uerj.css({
        paddingTop: z / 10 + "px",
        paddingBottom: z / 10 + "px",
        // paddingLeft: 0,
        paddingRight: x + "px",
        borderRightWidth: x / 5 + "px",
        borderRightStyle: "solid"
    });
    logo.css({
        height: 3 * z / 5 + "px",
        marginTop: 3 * z / 10 + "px",
        marginBottom: 3 * z / 10 + "px",
        marginLeft: x + "px"

    });
    logo_img.css({
        height: 3 * z / 5 + "px"
    });
    titulo.css({
        paddingTop: 3 * z / 10 + "px",
        paddingBottom: z / 5 + "px",
        paddingLeft: x + "px",
        // paddingRight: 0
    });
    sigla.css({
        fontSize: 3 * z / 10 + "px",
        marginBottom: z / 5 + "px",
        lineHeight: 3 * z / 10 + "px"
    });
    nome.css({
        fontSize: z / 5 + "px",
        lineHeight: z / 5 + "px"
    });

    if (window.innerWidth < 576) {
        $("#menu-idiomas .fflag").addClass('ff-app');
    //     nome.detach();
    //     nome.appendTo($("header > *"));
    //     $("header .marca").css({
    //         marginLeft: "auto",
    //         marginRight: "auto"
    //     });
    //     sigla.css({
    //         marginTop: z / 5 + "px"
    //     });
    //     nome.css({
    //         margin: "5px auto",
    //         textTransform: "uppercase",
    //         textAlign: "center"
    //     });
    } else {
        $("#menu-idiomas .fflag").removeClass('ff-app');
    //     nome.detach();
    //     nome.appendTo(titulo);
    //     $("header .marca").css({
    //         margin: "0 1rem 0 0",
    //     });
    //     sigla.css({
    //         marginTop: 0
    //     });
    //     nome.css({
    //         margin: 0,
    //         textTransform: "initial",
    //         textAlign: "left"
    //     });
    }
}