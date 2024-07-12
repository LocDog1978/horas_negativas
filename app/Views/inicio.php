<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

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
    </style>
</head>
<body>
    <section id="sobre">
        <h5 class="mb-0">Saldos das horas negativas atuais <?php echo "(".$intervaloDias['dia_inicial'] . " e " . $intervaloDias['dia_final'] . ")"?></h5>
        <a 
            href="<?= base_url('relatorio') ?>?id=<?= "teste"; ?>" 
            class="clickable-icon"
            target="_blank"
            rel="noopener"
        >
            <i class="fa fa-print" aria-hidden="true" title="Imprimir"></i>
        </a>
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