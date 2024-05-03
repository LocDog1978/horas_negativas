$(document).ready(function () {

    $("#btnValidateLogin").click(function () {
        validateLogin();
    });

    $("#btnCreateAccount").click(function () {
        window.location.href = $("[name=baseUrl]").val() + '/account_create';
    });

    $("#btnForgotPassword").click(function () {
        window.location.href = $("[name=baseUrl]").val() + '/forgot_password';
    });

    $("#passwordEye").click(function () {
        exibeSenha($("#password"), $(this));
    });
});

    function validateLogin() {
        $("#btnValidateLogin").prop("disabled", true);
        $('#divLoading').show();

        if (!dataValidation()) {
            $("#btnValidateLogin").prop("disabled", false);
            $('#divLoading').hide();
            return;
        }

        var params = $("#formLogin").serialize();

        $("[id^=msg]").html("").hide();
        $.ajax({
            type: 'post',
            url: $("[name=baseUrl]").val() + '/login_validate',
            data: params,
            dataType: 'json',
            beforeSend: function () {
                $("#divLoading").show();
            },
            success: function (retorno) {
                $("[name='csrf_test_name']").val(retorno.csrf_hash);
                // $("#msgErroGeral").html((retorno.status)).show();

                var id, message, x;
                if (retorno.status == "SUCCESS") {
                    // window.location.href = $("[name=baseUrl]").val() + '/inicio';
                    $("[id^='divError-']").html("").hide();
                    $("input").removeClass("is-invalid");
                    $("#msgSucessoGeral").html(retorno.message).show();
                    setTimeout(function(){
                        window.location.href = $("[name=baseUrl]").val() + '/';
                    }, 2000);
                } else if (retorno.status.substr(0, 5) == "ERROR") {
                    $("[id^='divError-']").html("").hide();
                    $("input").removeClass("is-invalid");
                    for (x in retorno.errors) {
                        id = retorno.errors[x].id;
                        message = retorno.errors[x].message;
                        $('#' + id).addClass("is-invalid");
                        $("#divError-" + id).html(message).show();
                    }
                    $("[id^=msg]").html("").hide();
                    $("#msgErroGeral").html(retorno.message).show();
                    $('html, body').animate({scrollTop: $(document).height()});
                } else if (retorno.status.substr(0, 6) == "NOTICE") {
                    for (x in retorno.errors) {
                        id = retorno.errors[x].id;
                        message = retorno.errors[x].message;
                        $("#divNotice-" + id).html(message).show();
                    }
                    $("[id^=msg]").html("").hide();
                    $("#msgAvisoGeral").html(retorno.message).show();
                    $('html, body').animate({scrollTop: $(document).height()});
                } else {
                    $("[id^=msg]").html("").hide();
                    $("#msgErroGeral").html(debug(retorno)).show();
                    $('html, body').animate({scrollTop: $(document).height()});
                }
            },
            error: function (xhr) { //erro
                $("#divLoading").hide();
                $("[id^=msg]").html("").hide();
                $("#msgErroGeral").html("Código do erro: " + xhr.status + "<br />Erro: " + xhr.statusText).fadeIn(300);
                $('html, body').animate({scrollTop: $(document).height()});
            },
            complete: function () {
                $('#divLoading').hide();
                $("#btnValidateLogin").prop("disabled", false);
            }
        });
    } /* fim function validateLogin() */


    function dataValidation() {
        var totalErros = 0;
        $("[id^='divError-']").html("").hide();
        $("input").removeClass("is-invalid");
        if (jQuery.trim($('#login').val()) == "") {
            totalErros++;
            $('#login').addClass("is-invalid");
            $('#divError-login').html("Este campo é obrigatório.").show();
        }
        if (jQuery.trim($("#password").val()) == "") {
            totalErros++;
            $('#password').addClass("is-invalid");
            $('#divError-password').html("Este campo é obrigatório.").show();
        }
        if (totalErros > 0) {
            setFocusError();
        }
        return !(totalErros > 0);
    }

// var app = new Vue({
//     el: "#app",
//     data: {
//         user: null,
//     },
//     methods: {
//         loginValidate: function () {
//             const params = new URLSearchParams();
//             params.append('user', this.user);
//             params.append('param2', 'value2');
//
//             let url = this.$refs.baseUrlTest.value+'/login_validate';
//             // let xhttp = axios.post(url,params)
//             //     .then(function (response) {
//             //         /* handle success */
//             //         console.log(response);
//             //     })
//             //     .catch(function (error) {
//             //         /* handle error */
//             //         console.log(error);
//             //     })
//             //     .then(function () {
//             //         /* always executed */
//             //     });
//         } /* end of loginValidate: function () */
//     } /* end of methods: */
// });
//
