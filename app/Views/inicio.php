<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<!-- <i class="fa fa-print text-primary" aria-hidden="true" title="Imprimir" style="font-size: 50px;"></i> -->

<section id="sobre">
	<h5>Saldos das horas negativas atuais <?php echo "(".$intervaloDias['dia_inicial'] . " e " . $intervaloDias['dia_final'] . ")"?></h5>
</section>
<div class="d-flex justify-content-center">
    <div class="table-responsive" style="width: 100%;">
		<table id="tabelaDados" class="table table-bordered table-hover table-sm" style="width: 100%;">
			<thead>
				<tr style="text-align: center; vertical-align: middle;">
					<th>POSTOS</th>
					<th>HORAS DIURNAS</th>
					<th>HORAS NOTURNAS</th>
					<th>TOTAL</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($somatorioPeriodo as $somatorio): ?>
					<tr>
						<td><?= $somatorio['posto'] ?></td>
						<td><?= $somatorio['diurno'] ?></td>
						<td><?= $somatorio['noturno'] ?></td>
						<td><?= isset($somatorio['total']) ? $somatorio['total'] : ($somatorio['diurno'] + $somatorio['noturno']) ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php $this->endSection('content'); ?>