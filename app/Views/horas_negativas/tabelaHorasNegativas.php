<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Horas Negativas</title>
	<style>
		.toast-container {
			z-index: 1060;
		}
		.has-justificativa {
			position: relative;
		}
		.has-justificativa::after {
			content: '';
			position: absolute;
			top: 50%;
			right: -12px;
			transform: translateY(-50%);
			width: 8px;
			height: 8px;
			background-color: red;
			border-radius: 50%;
		}
		table {
			border: 2px solid black;
		}
		th, td {
			border: 2px solid black;
			text-align: center;
		}
	</style>
</head>
<body>
	<!-- Toast Container -->
	<div aria-live="polite" aria-atomic="true" class="position-relative">
		<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer">
			<!-- Toast -->
			<div class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
				<div class="toast-header bg-success text-white">
					<strong class="me-auto">Notificação</strong>
					<small>Agora</small>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body" id="toastMessage">
					<!-- A mensagem será inserida aqui pelo JavaScript -->
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div id="alertSomatorio" class="alert alert-primary col-sm-4 text-center" role="alert">
				Você selecionou: <h5 style="display: inline-block; margin: 0;"><b><?php echo $nome_posto; ?></b></h5>
				<hr>
				Total Diurno: <?php echo $sum_diurno; ?>
				<br>
				Total Noturno: <?php echo $sum_noturno; ?>
				<br>
				Somatório Total: <?php echo $total_sum; ?>
			</div>
		</div>
	</div>

	<div class="d-flex justify-content-center mt-1">
		<button type="button" id="btnSalvarTop" class="btn btn-primary mb-2">Salvar</button>
	</div>

	<div class="d-flex justify-content-center">
		<div class="table-responsive" style="width: 100%;">
			<table id="tabelaDados" class="table table-bordered table-hover table-sm" style="width: 100%;">
				<thead>
					<tr style="text-align: center; vertical-align: middle; border: 2px solid black">
						<th>#</th>
						<th>Data</th>
						<th style="display: none;">Data invisível</th>
						<th>Diurno</th>
						<th>Noturno</th>
						<th>Justificativa</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach ($periodo as $index => $data_invisivel) {
					$input_diurno = $data_invisivel . "-d";
					$input_noturno = $data_invisivel . "-n";
					$diurno_valor = isset($horasNegativas[$data_invisivel]->diurno) ? $horasNegativas[$data_invisivel]->diurno : '';
					$noturno_valor = isset($horasNegativas[$data_invisivel]->noturno) ? $horasNegativas[$data_invisivel]->noturno : '';
					$justificativa_valor = isset($horasNegativas[$data_invisivel]->justificativa) ? $horasNegativas[$data_invisivel]->justificativa : '';
				?>
					<tr>
						<td style="text-align: center; vertical-align: middle; border: 2px solid black"><b><?php echo $index + 1; ?></b></td>
						<td style="width: 150px; text-align: center; vertical-align: middle; border: 2px solid black">
							<?php echo date("d/m/Y", strtotime($data_invisivel)); ?>
						</td>
						<td style="display: none;"> <?php echo $data_invisivel; ?> </td>
						<td style="border: 2px solid black"><input type="time" name="<?php echo $input_diurno; ?>" id="<?php echo $input_diurno; ?>" class="form-control" value="<?php echo htmlspecialchars($diurno_valor); ?>" ></td>
						<td style="border: 2px solid black"><input type="time" name="<?php echo $input_noturno; ?>" id="<?php echo $input_noturno; ?>" class="form-control" value="<?php echo htmlspecialchars($noturno_valor); ?>" ></td>
						<td style="border: 2px solid black">
							<textarea name="justificativa_<?php echo $data_invisivel; ?>" class="form-control justificativa" rows="2"><?php echo htmlspecialchars($justificativa_valor); ?></textarea>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="d-flex justify-content-center mt-1">
		<button type="button" id="btnSalvarBottom" class="btn btn-primary">Salvar</button>
	</div>

	<script>
		$(document).ready(function() {
			$('#btnSalvarTop, #btnSalvarBottom').click(function() {
				let dados = [];

				$('#tabelaDados tbody tr').each(function(index) {
					let linha = {};
					linha.id = $(this).find('td:first-child').text().trim();
					linha.data = $(this).find('td:nth-child(2)').text().trim();
					linha.data_invisivel = $(this).find('td:nth-child(3)').text().trim();
					linha.diurno = $(this).find('input[type="time"]:eq(0)').val();
					linha.noturno = $(this).find('input[type="time"]:eq(1)').val();
					linha.justificativa = $(this).find('textarea.justificativa').val();

					dados.push(linha);
				});

				$.ajax({
					url: '<?php echo base_url('cad_negativas/getHorasNegativas'); ?>',
					method: 'POST',
					data: { dados: dados, posto: '<?php echo $postoID; ?>' },
					success: function(response) {
						$('#toastMessage').text(response.message);
						let toastEl = document.getElementById('myToast');
						let toast = new bootstrap.Toast(toastEl);
						toast.show();
						$('#alertSomatorio').html(`
							Você selecionou: <h5 style="display: inline-block; margin: 0;"><b><?php echo $nome_posto; ?></b></h5>
							<hr>
							Total Diurno: <b>${response.somatorio_diurno}</b>
							<br>
							Total Noturno: <b>${response.somatorio_noturno}</b>
							<br>
							Somatório Total: <b>${response.somatorio_total}</b>
						`);
					},
					error: function(xhr, status, error) {
						console.error('Erro ao enviar dados:', error);
					}
				});
			});
		});
	</script>
</body>
</html>
