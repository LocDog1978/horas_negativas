<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<?php
$currentDay = date('d');
$currentMonth = date('n');
$currentYear = date('Y');

if ($currentDay < 25) {
	$currentMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
	$currentYear = ($currentMonth == 12) ? $currentYear - 1 : $currentYear;
}

$mesesPortugues = [
	1 => 'JANEIRO', 2 => 'FEVEREIRO', 3 => 'MARÇO',
	4 => 'ABRIL', 5 => 'MAIO', 6 => 'JUNHO',
	7 => 'JULHO', 8 => 'AGOSTO', 9 => 'SETEMBRO',
	10 => 'OUTUBRO', 11 => 'NOVEMBRO', 12 => 'DEZEMBRO'
];

$mes_inicial_extenso = $mesesPortugues[$currentMonth];
$mes_final_extenso = ($currentMonth == 12) ? $mesesPortugues[1] : $mesesPortugues[$currentMonth + 1];
$ano_final = ($currentMonth == 12) ? $currentYear + 1 : $currentYear;
?>

<style type="text/css">
	#sobre {
		display: flex;
		justify-content: space-between;
		align-items: center;
		background-color: #f8f9fa;
		padding: 10px 20px;
		border-radius: 5px;
		box-shadow: 0 4px 8px rgba(0,0,0,0.1);
		margin: 20px 0;
	}
	#sobre h5 {
		margin: 0;
		font-size: 1.25rem;
		color: #343a40;
	}
	.clickable-icon {
		display: flex;
		align-items: center;
		justify-content: center;
		background-color: #007bff;
		border-radius: 50%;
		width: 60px;
		height: 60px;
		text-decoration: none;
		box-shadow: 0 4px 8px rgba(0,0,0,0.1);
		transition: background-color 0.3s, transform 0.3s;
	}
	.clickable-icon:hover {
		background-color: #0056b3;
		transform: scale(1.1);
	}
	.clickable-icon i {
		color: white;
		font-size: 24px;
		text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
	}
	/* Estilos para o modal */
	.modal {
		display: none; /* Oculto por padrão */
		position: fixed;
		z-index: 1;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0,0,0,0.4);
		padding-top: 60px;
	}
	.modal-content {
		background-color: #fff;
		margin: 5% auto;
		padding: 20px;
		border: 1px solid #888;
		border-radius: 10px;
		width: 60%;
		box-shadow: 0 5px 15px rgba(0,0,0,0.3);
	}
	.close {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}
	.close:hover,
	.close:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
	}
	.modal-content form {
		display: flex;
		flex-direction: column;
	}
	.modal-content label {
		margin-top: 10px;
		font-weight: bold;
	}
	.modal-content input,
	.modal-content select {
		padding: 10px;
		margin-top: 5px;
		border-radius: 5px;
		border: 1px solid #ccc;
		width: 100%;
	}
	.modal-content button {
		margin-top: 20px;
		padding: 10px;
		background-color: #007bff;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		transition: background-color 0.3s;
	}
	.modal-content button:hover {
		background-color: #0056b3;
	}
</style>

<section id="sobre">
	<div>
		<label for="mes" class="form-label"><b>Mês:</b></label>
		<select name="mes" id="mes" class="chosen-select" data-placeholder="Selecione um Mês" required>
			<option></option>
			<option value="1" <?= ($currentMonth == 1) ? 'selected' : '' ?>>JANEIRO/FEVEREIRO</option>
			<option value="2" <?= ($currentMonth == 2) ? 'selected' : '' ?>>FEVEREIRO/MARÇO</option>
			<option value="3" <?= ($currentMonth == 3) ? 'selected' : '' ?>>MARÇO/ABRIL</option>
			<option value="4" <?= ($currentMonth == 4) ? 'selected' : '' ?>>ABRIL/MAIO</option>
			<option value="5" <?= ($currentMonth == 5) ? 'selected' : '' ?>>MAIO/JUNHO</option>
			<option value="6" <?= ($currentMonth == 6) ? 'selected' : '' ?>>JUNHO/JULHO</option>
			<option value="7" <?= ($currentMonth == 7) ? 'selected' : '' ?>>JULHO/AGOSTO</option>
			<option value="8" <?= ($currentMonth == 8) ? 'selected' : '' ?>>AGOSTO/SETEMBRO</option>
			<option value="9" <?= ($currentMonth == 9) ? 'selected' : '' ?>>SETEMBRO/OUTUBRO</option>
			<option value="10" <?= ($currentMonth == 10) ? 'selected' : '' ?>>OUTUBRO/NOVEMBRO</option>
			<option value="11" <?= ($currentMonth == 11) ? 'selected' : '' ?>>NOVEMBRO/DEZEMBRO</option>
			<option value="12" <?= ($currentMonth == 12) ? 'selected' : '' ?>>DEZEMBRO/JANEIRO</option>
		</select>
	</div>
	<div>
		<label for="ano" class="form-label"><b>Ano:</b></label>
		<select name="ano" id="ano" class="chosen-select" data-placeholder="Selecione um Ano" required>
			<option></option>
			<option value="2024" <?= ($currentYear == 2024) ? 'selected' : '' ?>>2024</option>
			<option value="2025" <?= ($currentYear == 2025) ? 'selected' : '' ?>>2025</option>
			<option value="2026" <?= ($currentYear == 2026) ? 'selected' : '' ?>>2026</option>
		</select>
	</div>
	<h5 class="mb-0" id="sobreTexto">
		Saldos das horas negativas (
		<?=
			strtoupper($mes_inicial_extenso) . '/' . 
			strtoupper($mes_final_extenso) . ' ' .
			($currentMonth == 12 ? "$currentYear / $ano_final" : $currentYear);
		?>
		)
	</h5>

	<a 
		href="#"
		class="clickable-icon"
		id="printBtn"
	>
		<i class="fa fa-print" aria-hidden="true" title="Imprimir"></i>
	</a>
</section>

<div id="tabelaTotal"></div>

<!-- O Modal -->
<div id="myModal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<form id="printForm">
			<label for="documentNumber">Número do documento:</label>
			<input type="text" id="documentNumber" name="documentNumber" value="___NÚMERO___/2024" required>
			<label for="de">De:</label>
			<input type="text" id="de" name="de" value="DISEG" required>
			<label for="para">Para:</label>
			<input type="text" id="para" name="para" value="COSEG" required>
			<button type="button" id="submitPrint">Imprimir</button>
		</form>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	// Obter o modal
	let modal = document.getElementById("myModal");

	// Obter o botão que abre o modal
	let btn = document.getElementById("printBtn");

	// Obter o elemento <span> que fecha o modal
	let span = document.getElementsByClassName("close")[0];

	// Quando o usuário clicar no botão, abre o modal
	btn.onclick = function() {
		modal.style.display = "block";
	}

	// Quando o usuário clicar em <span> (x), fecha o modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// Quando o usuário clicar em qualquer lugar fora do modal, fecha o modal
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}

	// Submeter o formulário e gerar o relatório
	$('#submitPrint').click(function() {
		if ($("#printForm")[0].checkValidity()) { // Verifica se todos os campos required são preenchidos
			let documentNumber = $('#documentNumber').val();
			let de = $('#de').val();
			let para = $('#para').val();
			let mes = $('#mes').val();
			let ano = $('#ano').val();
			let url = '<?= base_url("relatorio") ?>' + '?documentNumber=' + documentNumber + '&de=' + de + '&para=' + para + '&mes=' + mes + '&ano=' + ano;

			window.open(url, '_blank');
			modal.style.display = "none";
		} else {
			// Se houver campos não preenchidos, dispara a validação do HTML5
			$('<input type="submit">').hide().appendTo('#printForm').click().remove();
		}
	});

	// Função para obter o texto do mês por extenso
	function getMonthText(month, year) {
		const monthNames = ["JANEIRO/FEVEREIRO", "FEVEREIRO/MARÇO", "MARÇO/ABRIL", "ABRIL/MAIO", "MAIO/JUNHO", "JUNHO/JULHO", "JULHO/AGOSTO", "AGOSTO/SETEMBRO", "SETEMBRO/OUTUBRO", "OUTUBRO/NOVEMBRO", "NOVEMBRO/DEZEMBRO", "DEZEMBRO/JANEIRO"];
		const nextYear = parseInt(year) + 1;
		let text = monthNames[month - 1];
		if (month == 12) {
			text = `DEZEMBRO ${year} / JANEIRO ${nextYear}`;
		} else {
			text = `${text} ${year}`;
		}
		return text;
	}

	// Atualizar a tabela e o texto ao mudar o mês ou o ano
	$('#mes, #ano').change(function() {
		let mes = $('#mes').val();
		let ano = $('#ano').val();

		if (mes && ano) {
			// Atualizar o texto
			let mesTexto = getMonthText(parseInt(mes), parseInt(ano));
			$('#sobreTexto').text(`Saldos das horas negativas (${mesTexto})`);

			// Fazer a requisição para atualizar a tabela
			$.ajax({
				url: '<?= base_url("tabela") ?>',
				method: 'POST',
				data: { mes: mes, ano: ano },
				success: function(response) {
					$('#tabelaTotal').html(response);
				}
			});
		}
	});

	// Carregar a tabela ao carregar a página
	$(document).ready(function() {
		let mes = $('#mes').val() || <?= $currentMonth ?>;
		let ano = $('#ano').val() || <?= $currentYear ?>;
		$('#tabelaTotal').load('<?= base_url("tabela") ?>', { mes: mes, ano: ano });
	});
</script>

<?php $this->endSection(); ?>
