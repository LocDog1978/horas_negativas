$(document).ready(function () {
	$("#btnValidateHorasNegativas").click(function () {
		validateHorasNegativas();
	});

	$("#btnCancel").click(function () {
		//resetar o formulário
	});
});

/* ==================================================================================== */
/* ==================================================================================== */

/* ==================================================================================== */

function resetFormHorasNegativas() {
	$("[id^='msg']").html("").hide();
	$("[id^='divNotice']").html("").hide();
	$("[id^='divError-']").html("").hide();
	$("*").removeClass("is-invalid");
	$("*").removeClass("is-notice");
	$("*").removeClass("red");
	// $("#msgErroGeral").html("").hide();

}

/* ==================================================================================== */
function validateHorasNegativas() {
	$("#btnValidateHorasNegativas").prop("disabled", true);
	$('#divLoading').show();

	if (!dataValidation()) {
		$("#btnValidateHorasNegativas").prop("disabled", false);
		$('#divLoading').hide();
		return;
	}

	resetFormHorasNegativas();
	//let params = $("#formCadNegativas").serialize();
	let form = $("#formCadNegativas")[0]; // Obtém o formulário DOM
	let formData = new FormData(form); // Cria um objeto FormData

	$.ajax({
		type: 'post',
		url: baseUrl + '/cad_negativas/validate',
		data: formData,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("#divLoading").show();
		},
		success: function (retorno) {
			console.log(retorno);
			/*if (retorno.validation) {
				$("#msgErroGeral").html("Este evento já está cadastrado no sistema.").show();
			} else {
				if (retorno.update) {
					$("#msgSucessoGeral").html("Evento Atualizado com Sucesso").show();
				} else {
					$("#msgSucessoGeral").html("Evento Cadastrado com Sucesso").show();
				}
				$("#btnLimpar").show();

				$("#divParaOBotao").empty();

				// Requisição para obter o número da página
				$.ajax({
					type: 'post',
					url: baseUrl + '/eventos/getPaginateNumber',
					data: { id_evento: retorno.insertid },
					success: function (pageNumber) {
						if (pageNumber && !isNaN(pageNumber)) {
							// Criação do botão
							let btnDetalhes = $('<a/>', {
								'class': 'btn btn-primary',
								'href': baseUrl + '/eventos/cadastrados?page=' + pageNumber,
								'html': 'Gerenciar Evento'
							});

							// Adiciona o botão à sua div ou aonde preferir
							$("#divParaOBotao").append(btnDetalhes);
						} else {
							console.log('Número de página inválido.');
						}
					},
					error: function () {
						console.log('Erro ao obter o número da página.');
					}
				});
			}*/
		},
		error: function () {
			console.log('Erro durante a requisição AJAX.');
		},
		complete: function () {
			$('#divLoading').hide();
			$("#btnValidateHorasNegativas").prop("disabled", false);
		}
	});



} /* fim function validateEvento() */


function dataValidation() {
	let totalErros = 0;

	resetFormHorasNegativas();

	if ($("#posto").val() == "") {
		totalErros++;
		$('#posto').addClass("is-invalid");
		$("#postoAux").addClass("red");
		$('#divError-posto').html("O campo Posto é obrigatório.").show();
	}

	if ($("#mes").val() == "") {
		totalErros++;
		$('#mes').addClass("is-invalid");
		$("#mesAux").addClass("red");
		$('#divError-mes').html("O campo Mês é obrigatório.").show();
	}

	if ($("#ano").val() == "") {
		totalErros++;
		$('#ano').addClass("is-invalid");
		$("#anoAux").addClass("red");
		$('#divError-ano').html("O campo Ano é obrigatório.").show();
	}

	if (totalErros > 0) {
		$("#msgErroGeral").html("Verifique os erros informados antes de tentar salvar novamente.").show();
		// infoDialog("Verifique os erros informados antes de tentar salvar novamente.", 'Erros na validação do formulário');
		setFocusError();
	}

	return !(totalErros > 0);
} /* end of function dataValidation() */


	$("#btnLimpar").click(function () {
		$("#formCadNegativas")[0].reset();
	});