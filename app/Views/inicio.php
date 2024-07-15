<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/home_page.css'); ?>">

<?php
$currentDay = date('d');
$currentMonth = date('n');
$currentYear = date('Y');

if ($currentDay < 25) {
	$currentMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
	$currentYear = ($currentMonth == 12) ? $currentYear - 1 : $currentYear;
}

$mes_inicial_extenso = $mesesPortugues[$currentMonth];
$mes_final_extenso = ($currentMonth == 12) ? $mesesPortugues[1] : $mesesPortugues[$currentMonth + 1];
$ano_final = ($currentMonth == 12) ? $currentYear + 1 : $currentYear;
?>

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
			<?php foreach ($anos as $ano): ?>
				<option value="<?= $ano ?>" <?= ($currentYear == $ano) ? 'selected' : '' ?>><?= $ano ?></option>
			<?php endforeach; ?>
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
			<label for="observacoes">Observações:</label>
			<textarea id="observacoes" name="observacoes"></textarea>
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
			let observacoes = $('#observacoes').val();
			let mes = $('#mes').val();
			let ano = $('#ano').val();
			let url = '<?= base_url("relatorio") ?>' + '?documentNumber=' + documentNumber + '&de=' + de + '&para=' + para + '&observacoes=' + observacoes + '&mes=' + mes + '&ano=' + ano;

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
