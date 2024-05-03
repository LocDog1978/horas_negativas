$(document).ready(function () {
	$("#btnValidateEvento").click(function () {
		validateEvento();
	});

	$("#btnCancel").click(function () {
		//resetar o formulário
	});
});

/* ==================================================================================== */
/* ==================================================================================== */

/* ==================================================================================== */

function resetFormEventoMessages() {
	$("[id^='msg']").html("").hide();
	$("[id^='divNotice']").html("").hide();
	$("[id^='divError-']").html("").hide();
	$("*").removeClass("is-invalid");
	$("*").removeClass("is-notice");
	$("*").removeClass("red");
	// $("#msgErroGeral").html("").hide();

}

/* ==================================================================================== */
function validateEvento() {
	$("#btnValidateEvento").prop("disabled", true);
	$('#divLoading').show();

	if (!dataValidation()) {
		$("#btnValidateEvento").prop("disabled", false);
		$('#divLoading').hide();
		return;
	}

	resetFormEventoMessages();
	//let params = $("#formEvento").serialize();
	let form = $("#formEvento")[0]; // Obtém o formulário DOM
	let formData = new FormData(form); // Cria um objeto FormData

	$.ajax({
		type: 'post',
		url: baseUrl + '/eventos/eventoValidate',
		data: formData,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("#divLoading").show();
		},
		success: function (retorno) {
			if (retorno.validation) {
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
			}
		},
		error: function () {
			console.log('Erro durante a requisição AJAX.');
		},
		complete: function () {
			$('#divLoading').hide();
			$("#btnValidateEvento").prop("disabled", false);
		}
	});



} /* fim function validateEvento() */


function dataValidation() {
	let totalErros = 0;

	resetFormEventoMessages();

	if ($("#tipoEvento").val() == "") {
		totalErros++;
		$('#tipoEvento').addClass("is-invalid");
		$("#tipoEventoAux").addClass("red");
		$('#divError-tipoEvento').html("O campo Tipo de Evento é obrigatório.").show();
	}

	if ($.trim($("#nome").val()) == "") {
		totalErros++;
		$('#nome').addClass("is-invalid");
		$('#divError-nome').html("O campo NOME é obrigatório.").show();
	}

	if ($("#local").prop("selectedIndex") == 0) {
		totalErros++;
		$("#local").addClass("is-invalid");
		$("#localAux").addClass("red");
		$("#divError-local").html("O campo LOCAL é obrigatório.").show();
	}

	if ($("#portao").prop("selectedIndex") == 0) {
		totalErros++;
		$("#portao").addClass("is-invalid");
		$("#portaoAux").addClass("red");
		$("#divError-portao").html("O campo PORTÃO é obrigatório.").show();
	}

	if ($.trim($("#data_inicio").val()) == "") {
		totalErros++;
		$('#data_inicio').addClass("is-invalid");
		$('#divError-data_inicio').html("O campo DATA INÍCIO é obrigatório.").show();
	}

	if ($.trim($("#hora_inicio").val()) == "") {
		totalErros++;
		$('#hora_inicio').addClass("is-invalid");
		$('#divError-hora_inicio').html("O campo HORA INÍCIO é obrigatório.").show();
	}

	if ($.trim($("#data_fim").val()) == "") {
		totalErros++;
		$('#data_fim').addClass("is-invalid");
		$('#divError-data_fim').html("O campo DATA FIM é obrigatório.").show();
	}

	if ($.trim($("#hora_fim").val()) == "") {
		totalErros++;
		$('#hora_fim').addClass("is-invalid");
		$('#divError-hora_fim').html("O campo HORA FIM é obrigatório.").show();
	}

	if ($.trim($("#uso_taloes").val()) == "") {
		totalErros++;
		$('#uso_taloes').addClass("is-invalid");
		$("#uso_taloesAux").addClass("red");
		$('#divError-uso_taloes').html("O campo USO DE TALÕES é obrigatório.").show();
	}

	if ($.trim($("#valorTkt").val()) == "" && $("#uso_taloes").val() == "Sim") {
		totalErros++;
		$('#valorTkt').addClass("is-invalid");
		$('#divError-valotTkt').html("O campo Valor do Ticket é obrigatório.").show();
	}

	if (!$("#flg_confirmacao_envio").prop("checked")) {
		totalErros++;
		$('#flg_confirmacao_envio').addClass("is-invalid");
		$('#divError-flg_confirmacao_envio').html("A confirmação é obrigatória.").show();
	}

	if (totalErros > 0) {
		$("#msgErroGeral").html("Verifique os erros informados antes de tentar salvar novamente.").show();
		// infoDialog("Verifique os erros informados antes de tentar salvar novamente.", 'Erros na validação do formulário');
		setFocusError();
	}

	return !(totalErros > 0);
} /* end of function dataValidation() */


	$("#btnLimpar").click(function () {
		$("#formEvento")[0].reset();
	});