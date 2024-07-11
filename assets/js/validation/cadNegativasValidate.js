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
	let posto = ($('#posto').val());

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
			$("#tabelaHorasNegativas").load(baseUrl+'cad_negativas/tabelaHorasNegativas', {periodo:retorno, posto:posto});
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

	if ($("#mes").val() == "") {
		totalErros++;
		$('#mes').addClass("is-invalid");
		$("#mesAux").addClass("red");
		$('#divError-mes').html("O campo MÊS é obrigatório.").show();
	}

	if ($("#ano").val() == "") {
		totalErros++;
		$('#ano').addClass("is-invalid");
		$("#anoAux").addClass("red");
		$('#divError-ano').html("O campo ANO é obrigatório.").show();
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