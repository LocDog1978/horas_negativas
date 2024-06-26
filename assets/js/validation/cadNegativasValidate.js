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
			if (retorno.update) {
				$("#msgSucessoGeral").html("Horas atualizadas com sucesso!").show();
			} else {
				$("#msgSucessoGeral").html("Horas cadastradas com sucesso!").show();
			}
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
		$('#divError-posto').html("O campo POSTO é obrigatório.").show();
	}

	if ($.trim($("#data").val()) == "") {
		totalErros++;
		$('#data').addClass("is-invalid");
		$('#divError-mes').html("O campo DATA é obrigatório.").show();
	}

	let diurno = $("#diurno").val();
	let noturno = $("#noturno").val();

	if (!noturno && !diurno) {
		totalErros++;
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