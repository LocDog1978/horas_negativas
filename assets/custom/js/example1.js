function alterarStatus(value, mainID, id_pessoa) {
	$.ajax({
		url: baseUrl + 'equipe/presenca',
		type: 'POST',
		data: { id_presenca: value, id_equipe: mainID, id_pessoa: id_pessoa },
		dataType: 'json',
		success: function (response) {
			$('#responsePresenca').html('<div class="alert alert-info" role="alert">' + response.message + '</div>').css('margin', '15px');
				setTimeout(function() {
					$('#responsePresenca').empty();
				}, 7000);
			$('#tableEquipe').DataTable().ajax.reload();
		}
	});
}

function excluirPessoa(id) {
	$.ajax({
		url: baseUrl+'equipe/excluir',
		type: 'POST',
		data: {id: id, id_evento: eventId},
		dataType: 'json',
		success: function(response) {
			if (response.success) {
				let selectPessoa = $('#selectPessoa');
				selectPessoa.empty();
				selectPessoa.append('<option></option>');
				$.each(response.pessoasAtualizadas, function (index, pessoa) {
					selectPessoa.append('<option value="' + pessoa.id + '">' + pessoa.nome + '</option>');
				});
				selectPessoa.trigger('chosen:updated');
				$('#tableEquipe').DataTable().ajax.reload();

				$("#financeiro").load(baseUrl+'eventos/financeiro', {id_evento: eventId});
				$("#graficoColunas").load(baseUrl+'eventos/graficoEvento', {id_evento:eventId});

				$('#responseMembroExcluido').html('<div class="alert alert-success" role="alert">' + response.message + '</div>').css('margin', '15px');
				setTimeout(function() {
					$('#responseMembroExcluido').empty();
				}, 7000);
			} else {
				alert('Falha ao excluir a pessoa da equipe.');
			}
		},
	});
}

function excluirTalao(id) {
	$.ajax({
		url: baseUrl+'talao/excluir',
		type: 'POST',
		data: {id: id, id_evento: eventId},
		dataType: 'json',
		success: function(response) {
			$('#tableTalao').DataTable().ajax.reload();

			$.ajax({
				url: baseUrl+'eventos/zerarDetalhesReceita',
				type: 'POST',
				data: {id_evento: eventId}
			});

			$("#financeiro").load(baseUrl+'eventos/financeiro', {id_evento: eventId});
			$("#graficoColunas").load(baseUrl+'eventos/graficoEvento', {id_evento:eventId});
			$('#responseTalaExcluido').html('<div class="alert alert-success" role="alert">' + response.message + '</div>').css('margin', '15px');
			setTimeout(function() {
				$('#responseTalaExcluido').empty();
			}, 7000);
		},
	});
}

$(document).ready( function () {
	//aqui

	$("#financeiro").load(baseUrl+'eventos/financeiro', {id_evento: eventId});

	$('#eventoSelecionado').change(function() {
		let id_evento = $(this).val();
		$('#loading').show();
		$.ajax({
			url: baseUrl+'eventos/getPaginateNumber',
			type: 'POST',
			data: {id_evento: id_evento},
			success: function(response) {
				let url = baseUrl+'eventos/cadastrados?page=' + response;
				window.location.href = url;
			},
			error: function() {
				alert('Ocorreu um erro ao carregar a URL.');
			},
			complete: function() {
				$('#loading').hide();
			}
		});
	});


	/**
	* -------------------------------------------------------------------
	* Marcar Evento Como Concluído
	* -------------------------------------------------------------------
	* $('#concluido').click(function()
	* function enviarDadosFinanceiros(saveIdEvento, saveReceita, saveDespesa, saveLucro, saveTicketsUsados) {
	* 
	* As funções acima se completam, #concluido chama enviarDadosFinanceiros
	* isso acontece porque é preciso verificar antes de marcar concluido, se alguma pessoa ou talão foi adicionado
	* para que salve as informações atualizadas e não as do último "F5"
	* 
	*/

	$('#concluido').click(function() {
		let saveReceita, saveDespesa, saveLucro, saveTicketsUsados;
		$.ajax({
			url: baseUrl+'eventos/buscarValoresFinanceiros',
			type: 'POST',
			data: { id: eventId },
			success: function(response) {
				saveReceita = response.receita;
				saveDespesa = response.despesa;
				saveLucro = saveReceita - saveDespesa;
				saveTicketsUsados = response.tickets_usados;
				enviarDadosFinanceiros(eventId, saveReceita, saveDespesa, saveLucro, saveTicketsUsados);

			}
		});
	});

	function enviarDadosFinanceiros(saveIdEvento, saveReceita, saveDespesa, saveLucro, saveTicketsUsados) {
		let saveCredito = $('#credito').val();
		let saveDebito = $('#debito').val();
		let saveDinheiro = $('#dinheiro').val();
		let savePix = $('#pix').val();
		$('#credito').prop('readonly', true);
		$('#debito').prop('readonly', true);
		$('#dinheiro').prop('readonly', true);
		$('#pix').prop('readonly', true);

		$.ajax({
			url: baseUrl+'eventos/setFinanceiro',
			type: 'POST',
			data: {
				id_evento: saveIdEvento,
				receita: saveReceita,
				despesa:saveDespesa,
				lucro: saveLucro,
				tkt_usados: saveTicketsUsados,
				credito: saveCredito,
				debito: saveDebito,
				dinheiro: saveDinheiro,
				pix: savePix
			},
			success: function(response) {
				$('#concluido').hide();
				$('#mensagem').text('Dados enviados com sucesso!');
				location.reload();
			},
			error: function(xhr, status, error) {
				$('#mensagem').text('Erro ao enviar os dados. Por favor, tente novamente mais tarde.');
			}
		});
	};

	/**
	* -------------------------------------------------------------------
	* Marcar Evento Como Não Concluído
	* -------------------------------------------------------------------
	* $('#naoConcluido').click(function()
	* 
	* Apenas seta a coluna concluído no banco de dados = 0
	* isso torna os campos do eventos editáveis, somente o administrador ou desenvolvedor tem permissão
	* 
	*/

	$('#naoConcluido').click(function() {
		$.ajax({
			url: baseUrl+'eventos/naoConcluido',
			type: 'POST',
			data: {
				id_evento: eventId,
			},
			success: function(response) {
				$('#mensagem').text('Dados enviados com sucesso!');
				$('#credito').prop('readonly', false);
				$('#debito').prop('readonly', false);
				$('#dinheiro').prop('readonly', false);
				$('#pix').prop('readonly', false);
				location.reload();
			},
			error: function(xhr, status, error) {
				$('#mensagem').text('Erro ao enviar os dados. Por favor, tente novamente mais tarde.');
			}
		});
	});


	/**
	* -------------------------------------------------------------------
	* Adicionar Pessoas ao Evento
	* -------------------------------------------------------------------
	* parametros guarda o ID do Evento atual
	* 
	*/

	let parametros = {
		id_evento: eventId
	};

	/**
	* -------------------------------------------------------------------
	* Define as congiruações da tabela equipe
	* -------------------------------------------------------------------
	* $('#naoConcluido').click(function()
	* 
	* Define as opções da tabela que exibe a equipe do evento
	* 
	*/

	$('#tableEquipe').DataTable({
		processing: true,
		serverSide: true,
		scrollX: false,
		language: { url: baseUrl+'assets/datatables/traducao' },
		columnDefs: [{className: "dt-left", targets: "_all"}],
		ajax: {
			url: baseUrl+'equipe/serverSide/equipe',
			type: 'POST',
			data: parametros
		}
	});

	/**
	* -------------------------------------------------------------------
	* Define as congiruações da tabela talão
	* -------------------------------------------------------------------
	* $('#naoConcluido').click(function()
	* 
	* Define as opções da tabela que exibe a talão do evento
	* 
	*/

	$('#tableTalao').DataTable({
		processing: true,
		serverSide: true,
		scrollX: false,
		language: { url: baseUrl+'assets/datatables/traducao' },
		columnDefs: [{className: "dt-left", targets: "_all"}],
		ajax: {
			url: baseUrl+'talao/serverSide/talao',
			type: 'POST',
			data: parametros
		}
	});

	/**
	* -------------------------------------------------------------------
	* Define as congiruações das tabs (equipe e talão)
	* -------------------------------------------------------------------
	* $('.nav.nav-tabs .nav-item a').click()
	* Esse código permite a troca de guias (tabs) equipe e talão
	* quando um link de guia é clicado, garantindo que apenas a guia clicada 
	* e seu conteúdo associado sejam exibidos.
	* 
	*/

	$('.nav.nav-tabs .nav-item a').click(function (e) {
		e.preventDefault();
		$('.nav.nav-tabs .nav-item a').removeClass('active').removeAttr('aria-current');
		$(this).addClass('active').attr('aria-current', 'page');
		let tabId = $(this).attr('href');
		$(tabId).addClass('show active').siblings().removeClass('show active');
	});


	/**
	* -------------------------------------------------------------------
	* Define as congiruações dos modals (equipe e talão)
	* -------------------------------------------------------------------
	* 1. $('#modalAdicionarMembro').on('shown.bs.modal')
	* 2. $('#cadastrarEquipeBtn').click()
	* 3. $('#cadastrarTalaoBtn').click(function ()
	* 4. $('#selectCargo').change(function()
	* 
	* 1. garante que os elementos de seleção selectPessoa
	* e selectCargo tenham aprimoramentos visuais e funcionais
	* fornecidos pelo plugin Chosen quando o modal modalAdicionarMembro é exibido aos usuários
	* 
	* 2. quando o botão com o ID cadastrarEquipeBtn é clicado,
	* este código limpa o formulário formAdicionarMembro e notifica
	* o plugin Chosen para atualizar a exibição dos elementos <select>
	* selectPessoa e selectCargo se houver alguma alteração nos mesmos.
	* 
	* 3. Reseta o conteúdo do modal do talão ao cadastrar um com sucesso
	* 
	* 4. Atualiza o valor do salário de acordo com o cargo selecionado
	* 
	*/

	$('#modalAdicionarMembro').on('shown.bs.modal', function () {
		$('#selectPessoa').chosen();
		$('#selectCargo').chosen();
	});

	$('#cadastrarEquipeBtn').click(function () {
		$('#formAdicionarMembro')[0].reset();
		$('#selectPessoa, #selectCargo').trigger('chosen:updated');
	});

	$('#cadastrarTalaoBtn').click(function () {
		$('#formAdicionarTalao')[0].reset();
	});

	$('#selectCargo').change(function() {
		let cargoSelecionado = $(this).val();
		let salario = '';
		cargoData.forEach(function(cargo) {
			if (cargo.id == cargoSelecionado) {
				salario = cargo.salario;
			}
		});
		$('#inputSalario').val(salario);
	});

	/**
	* -------------------------------------------------------------------
	* Ícone da impressora
	* -------------------------------------------------------------------
	* $("#relatorio").click(function()
	* Abre no navegador os relatórios sobre o evento
	* Folha de Assinatura, Folha de Dados Bancários e Dados Financeiros
	* 
	*/

	$("#relatorio").click(function() {
		$.redirect(baseUrl+'relatorio', { id: eventId }, 'POST', '_blank');
	});

	/**
	* -------------------------------------------------------------------
	* * Configuração ao adicionar uma pessoa
	* -------------------------------------------------------------------
	* 
	*/

	// Formulário exibido dentro do model de adicionar Membros
	$('#formAdicionarMembro').submit(function (e) {
		e.preventDefault();

		const pessoaSelecionada = $('#selectPessoa').val();
		const cargoSelecionado = $('#selectCargo').val();
		const salario = $('#inputSalario').val();

		if (!pessoaSelecionada) {
			$('#selectPessoa').siblings('.chosen-container').css({
				'border': '2px solid red',
				'border-radius': '5px'
			});
		} else {
			$('#selectPessoa').siblings('.chosen-container').css('border', '');
		}

		if (!cargoSelecionado) {
			$('#selectCargo').siblings('.chosen-container').css({
				'border': '2px solid red',
				'border-radius': '5px'
			});
		} else {
			$('#selectCargo').siblings('.chosen-container').css('border', '');
		}

		if ($('#inputSalario').val() === "") {
			$('#inputSalario').css({
				'border': '2px solid red',
				'border-radius': '5px'
			});
		} else {
			$('#inputSalario').css('border', '');
		}

		if (!pessoaSelecionada || !cargoSelecionado || !salario) {
			return;
		}

		const formData = $(this).serializeArray();
		formData.push({name: 'id_evento', value: eventId});

		$.ajax({
			url: baseUrl+'equipe/adicionar',
			type: 'POST',
			data: formData,
			success: function (response) {
				$('#formAdicionarMembro')[0].reset();
				$('#selectPessoa').trigger('chosen:updated');
				$('#selectCargo').trigger('chosen:updated');
				$('#tableEquipe').DataTable().ajax.reload();

				$("#financeiro").load(baseUrl+'eventos/financeiro', {id_evento: eventId});
				$("#graficoColunas").load(baseUrl+'eventos/graficoEvento', {id_evento:eventId});

				if (response.success && response.pessoasAtualizadas) {

					$('#responseMembro').html('<div class="alert alert-success" role="alert">' + response.message + '</div>').css('margin', '15px');
					setTimeout(function() {
						$('#responseMembro').empty();
					}, 7000);

					let selectPessoa = $('#selectPessoa');
					selectPessoa.empty();
					selectPessoa.append('<option></option>');
					$.each(response.pessoasAtualizadas, function (index, pessoa) {
						selectPessoa.append('<option value="' + pessoa.id + '">' + pessoa.nome + '</option>');
					});
					selectPessoa.trigger('chosen:updated');
				}
			},
			error: function (error) {
				// Lógica de erro
			},
			complete: function () {
				// Esta função será chamada independentemente do sucesso ou falha da requisição
				$('#modalAdicionarMembro').modal('hide');
			}
		});
	});

	/**
	* -------------------------------------------------------------------
	* Configuração ao adicionar um talão
	* -------------------------------------------------------------------
	* 
	*/

	// Formulário exibido dentro do model de adicionar Talões
	$('#formAdicionarTalao').submit(function (e) {

		e.preventDefault();

		const addInicio = $('#addInicio').val();
		const addFim = $('#addFim').val();

		if (addInicio > addFim) {
			e.preventDefault();
		}

		if ($('#addInicio').val() === "") {
			$('#addInicio').css({
				'border': '2px solid red',
				'border-radius': '5px'
			});
		} else {
			$('#addInicio').css('border', '');
		}

		if ($('#addFim').val() === "") {
			$('#addFim').css({
				'border': '2px solid red',
				'border-radius': '5px'
			});
		} else {
			$('#addFim').css('border', '');
		}

		if (!addInicio || !addFim) {
			return;
		}

		const formData = $(this).serializeArray();
		formData.push({name: 'id_evento', value: eventId});

		$.ajax({
			url: baseUrl+'talao/adicionar',
			type: 'POST',
			data: formData,
			success: function (response) {
				if (response.thereis) {
					$('#responseTalao').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>').css('margin', '15px');
					setTimeout(function() {
						$('#responseTalao').empty();
					}, 7000);
				} else {
					$('#formAdicionarTalao')[0].reset();
					$('#tableTalao').DataTable().ajax.reload();
					$('#responseTalao').html('<div class="alert alert-success" role="alert">' + response.message + '</div>').css('margin', '15px').css('padding', '10px');
					setTimeout(function() {
						$('#responseTalao').empty();
					}, 3000);
				}
			$.ajax({
				url: baseUrl+'eventos/zerarDetalhesReceita',
				type: 'POST',
				data: {id_evento: eventId}
			});
			$("#financeiro").load(baseUrl+'eventos/financeiro', {id_evento: eventId});
			$("#graficoColunas").load(baseUrl+'eventos/graficoEvento', {id_evento:eventId});
			},
			error: function (error) {
				// Lógica de erro
			},
			complete: function () {
				// Esta função será chamada independentemente do sucesso ou falha da requisição
				$('#modalAdicionarTalao').modal('hide');
			}
		});
	});

	// Adiciona um evento de input à textarea
	$(".auto-expand").on("input", function () {
		this.style.height = "auto";
		this.style.height = (this.scrollHeight) + "px";
	});

	// Inicializa a altura da textarea com base no conteúdo atual
	$(".auto-expand").each(function () {
		this.style.height = "auto";
		this.style.height = (this.scrollHeight) + "px";
	});
	$("#graficoColunas").load(baseUrl+'eventos/graficoEvento', {id_evento:eventId});
});