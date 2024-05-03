$(document).ready(function () {
	$("#btnValidatePessoa").click(function () {
		validatePessoa();
	});
	$("#btnCancel").click(function () {
		let confirmacao = confirm("Tem certeza que deseja cancelar?");
		if (confirmacao) {
			window.location.href = baseUrl + 'cadastro/pessoas/add';
		}
	});
	$("#numero").keyup(function () {
		somenteNumero($(this));
	});
	$("#btnLimpar").hide();
});

function resetFormPessoasMessages() {
	$("[id^='msg']").html("").hide();
	$("[id^='divNotice']").html("").hide();
	$("[id^='divError-']").html("").hide();
	$("*").removeClass("is-invalid");
	$("*").removeClass("is-notice");
	$("*").removeClass("red");
}

function validatePessoa() {
	$("#btnValidatePessoa").prop("disabled", true);
	$('#divLoading').show();
	let id_pessoa = $("#id_pessoa").val();
	let cpf = $("#cpf").val();
	$.ajax({
		url: baseUrl+'cadastro/pessoas/tryCpf',
		type: "POST",
		data: {cpf: cpf, update: id_pessoa},
		success: function(response) {
			if (response.count > 0 && response.fk_pessoa !== id_pessoa) {
				$("#cpf-response-after").html('<div class="alert alert-danger" role="alert">Este CPF já está cadastrado no sistema para: <b>' + response.pessoa + '</b></div>');
				$("#btnValidatePessoa").prop("disabled", false);
				$('#divLoading').hide();
			} else if (response.count > 0 && response.fk_pessoa === id_pessoa) {
				$("#cpf-response-after").html('');
				$("#cpf-response-after").hide();
				$("#btnValidatePessoa").prop("disabled", false);
				continueFormValidation();
			} else {
				$("#cpf-response-after").html('');
				$("#cpf-response-after").hide();
				$("#btnValidatePessoa").prop("disabled", false);
				continueFormValidation();
			}
		}
	});
}

function continueFormValidation() {
	if (!dataValidation()) {
		$("#btnValidatePessoa").prop("disabled", false);
		$('#divLoading').hide();
		return;
	}
	resetFormPessoasMessages();
	let form = $("#formPessoas")[0];
	let formData = new FormData(form);
	$.ajax({
		type: 'post',
		url: baseUrl+'cadastro/pessoas/savePessoa',
		data: formData,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$("#divLoading").show();
		},
		success: function (retorno) {
			if (retorno.update) {
				$("#msgSucessoGeral").html("Pessoa Atualizada com sucesso").show();
				$("#btnLimpar").show();
			} else {
				$("#msgSucessoGeral").html("Pessoa Cadastrada com sucesso").show();
				$("#btnLimpar").show();
				$("#formPessoas :input").prop("readonly", true);
				$("#formPessoas select").prop("disabled", true);
				$("#formPessoas select").trigger("chosen:updated");
				$("#btnLimpar").prop("disabled", true);
				$("#btnCancel").prop("disabled", true);
				$("#btnValidatePessoa").prop("disabled", true);
				$("#btns").show();
				$("#btnCadastrarNovaPessoa").show();
				let editButton = $("<a>", {
					id: "btnEditarPessoa",
					class: "btn btn-warning",
					href: baseUrl + 'cadastro/pessoas/edit/' + retorno.insertid,
					text: "Editar Este Cadastro"
				});
				let addButton = $("<a>", {
					id: "btnCadastrarNovaPessoa",
					class: "btn btn-primary",
					href: baseUrl + 'cadastro/pessoas/add',
					text: "Cadastrar Outra Pessoa"
				});
				let listButton = $("<a>", {
					id: "btnListagem",
					class: "btn btn-primary",
					href: baseUrl + 'cadastro/pessoas',
					text: "Voltar Para a Listagem"
				});
				$("#ext_buttons").append("<hr>");
				$("#ext_buttons").append(editButton);
				$("#ext_buttons").append(listButton);
				$("#ext_buttons").append(addButton);
			}
		},
		error: function (teste) {
			console.log('error');
		},
		complete: function () {
			$('#divLoading').hide();
		}
	});
}

function dataValidation() {
	let totalErros = 0;
	let totalPessoaRequiredMissing = 0;
	let totalDadosProfissionaisRequiredMissing = 0;
	let totalDocumentosRequiredMissing = 0;
	let totalDadosBancariosRequiredMissing = 0;
	resetFormPessoasMessages();
	if ($.trim($("#nome").val()) == "") {
		totalErros++;
		totalPessoaRequiredMissing++;
		$('#nome').addClass("is-invalid");
		$('#divError-nome').html("O campo NOME é obrigatório.").show();
	}
	if ($.trim($("#telefone1").val()) == "") {
		totalErros++;
		totalPessoaRequiredMissing++;
		$('#telefone1').addClass("is-invalid");
		$('#divError-telefone1').html("O campo TELEFONE 1 é obrigatório.").show();
	}
	if ($("#servidor").prop("selectedIndex") == 0) {
		totalErros++;
		totalDadosProfissionaisRequiredMissing++;
		$("#servidor").addClass("is-invalid");
		$("#divError-servidor").html("O campo SERVIDOR é obrigatório.").show();
	}
	if ($.trim($("#matricula").val()) == "") {
		totalErros++;
		totalDadosProfissionaisRequiredMissing++;
		$('#matricula').addClass("is-invalid");
		$('#divError-matricula').html("O campo MATRÍCULA é obrigatório.").show();
	}
	if ($("#situacao").prop("selectedIndex") == 0) {
		totalErros++;
		totalDadosProfissionaisRequiredMissing++;
		$("#situacao").addClass("is-invalid");
		$("#divError-situacao").html("O campo SITUAÇÃO é obrigatório.").show();
	}
	if ($("#departamento").prop("selectedIndex") == 0) {
		totalErros++;
		totalDadosProfissionaisRequiredMissing++;
		$("#departamentoAux").addClass("red");
		$("#divError-departamento").html("O campo DEPARTAMENTO é obrigatório.").show();
	}
	if ($.trim($("#cpf").val()) == "") {
		totalErros++;
		totalDocumentosRequiredMissing++;
		$('#cpf').addClass("is-invalid");
		$('#divError-cpf').html("O campo CPF é obrigatório.").show();
	}
	if ($.trim($("#rg").val()) == "") {
		totalErros++;
		totalDocumentosRequiredMissing++;
		$('#rg').addClass("is-invalid");
		$('#divError-rg').html("O campo RG é obrigatório.").show();
	}
	if ($.trim($("#orgao").val()) == "") {
		totalErros++;
		totalDocumentosRequiredMissing++;
		$('#orgao').addClass("is-invalid");
		$('#divError-orgao').html("O campo ÓRGÃO EXPEDITOR é obrigatório.").show();
	}
	if ($.trim($("#data_emissao").val()) == "") {
		totalErros++;
		totalDocumentosRequiredMissing++;
		$('#data_emissao').addClass("is-invalid");
		$('#divError-data_emissao').html("O campo DATA DE EMISSÃO é obrigatório.").show();
	}
	if ($.trim($("#pis_pasep").val()) == "") {
		totalErros++;
		totalDocumentosRequiredMissing++;
		$('#pis_pasep').addClass("is-invalid");
		$('#divError-pis_pasep').html("O campo PIS / PASEP é obrigatório.").show();
	}
	if ($("#banco").prop("selectedIndex") == 0) {
		totalErros++;
		totalDadosBancariosRequiredMissing++;
		$("#bancoAux").addClass("red");
		$("#divError-banco").html("O campo BANCO é obrigatório.").show();
	}
	if ($.trim($("#agencia").val()) == "") {
		totalErros++;
		totalDadosBancariosRequiredMissing++;
		$('#agencia').addClass("is-invalid");
		$('#divError-agencia').html("O campo AGÊNCIA é obrigatório.").show();
	}
	if ($.trim($("#conta").val()) == "") {
		totalErros++;
		totalDadosBancariosRequiredMissing++;
		$('#conta').addClass("is-invalid");
		$('#divError-conta').html("O campo CONTA é obrigatório.").show();
	}
	if (!$("#flg_confirmacao_envio").is(":checked")) {
		totalErros++;
		$('#divError-flg_confirmacao_envio').html("É necessário concordar com os termos.").show();
	}
	function atualizarAbaComErros(aba, totalErros) {
		if (totalErros > 0) {
			aba.css({'border-bottom-color': 'red', 'border-width': '2px'});
		} else {
			aba.removeAttr('style');
		}
		if (totalErros > 0) {
			aba.find('span').text('(' + totalErros + ')').css({'color': 'red', 'font-weight': 'bold'});
		} else {
			aba.find('span').empty();
		}
	}
	atualizarAbaComErros($('#pessoa-tab'), totalPessoaRequiredMissing);
	atualizarAbaComErros($('#dados_profissionais-tab'), totalDadosProfissionaisRequiredMissing);
	atualizarAbaComErros($('#documentos-tab'), totalDocumentosRequiredMissing);
	atualizarAbaComErros($('#dados_bancarios-tab'), totalDadosBancariosRequiredMissing);
	if (totalErros > 0) {
		$("#msgErroGeral").html("Verifique os erros informados antes de tentar salvar novamente.").show();
		// infoDialog("Verifique os erros informados antes de tentar salvar novamente.", 'Erros na validação do formulário');
		setFocusError();
	}
	return !(totalErros > 0);
} /* end of function dataValidation() */
$("#btnLimpar").click(function () {
	$("#formPessoas")[0].reset();
});