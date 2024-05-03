<!doctype html>
<html lang="pt-br">
	<head>
	<!-- head -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="GedUERJ | Sistema de Controle de Documentos">
		<meta name="author" content="DGTI - Diretoria Geral de Tecnologia da Informação">
		<meta name="Access-Control-Allow-Origin" content="*">
		<title>GedUERJ - 404 | Sistema de Controle de Documentos</title>
		<link href="<?php echo base_url('assets/images/logomarca-uerj.png'); ?>" rel="icon" type="image/x-ico" />
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
		<!-- Bootstrap Icons -->
		<link href="<?php echo base_url('assets/css/bootstrap-icons.css'); ?>" rel="stylesheet" type="text/css" />
		<!-- Font Awesome -->
		<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
		<!-- Folha de estilos padrão do sistema -->
		<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
		<!-- Bandeiras dos países (www.freakflagsprite.com) -->
		<link href="<?php echo base_url('assets/css/freakflags.css'); ?>" rel="stylesheet" type="text/css" />
		<!-- Regras de estilo para acessibilidade (alto contraste) -->
		<link href="<?php echo base_url('assets/css/accessibility.css'); ?>" rel="stylesheet" type="text/css" />
		<!-- Regras CSS para impressão -->
		<link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet" type="text/css" />
		<!-- template jquery -->
		<?php if (!isset($jquery)) { ?>
			<script src="<?php echo base_url('assets/js/libs/jquery-3.6.0.js'); ?>" type="text/javascript"></script>
		<?php } ?>
		
		<script src="<?php echo base_url('assets/js/libs/bootstrap.bundle.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/corp/functions.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/corp/functions_layout.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/libs/jquery-ui-1.13.2.custom/jquery-ui.js'); ?>" type="text/javascript"></script>
		<link href="<?php echo base_url('assets/js/libs/jquery-ui-1.13.2.custom/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/js/libs/jquery-ui-1.13.2.custom/jquery-ui.structure.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/js/libs/jquery-ui-1.13.2.custom/jquery-ui.theme.css'); ?>" rel="stylesheet" type="text/css" />
		
		<!-- js Datatable -->
		<?php if (isset($isDatatablesPage)) { ?>
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/jquery.dataTables.min.css'); ?>">
		  <script type="text/javascript" src="<?php echo base_url('assets/datatables/jquery-3.5.1.js'); ?>"></script>
		  <script type="text/javascript" src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js'); ?>"></script>
		<?php } ?>

		<script src="<?php echo base_url('assets/js/libs/tinymce_6.2.0/tinymce.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/libs/tinymce_6.2.0/themes/silver/theme.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/libs/tinymce_6.2.0/langs/pt_BR.js'); ?>" type="text/javascript"></script>
	<!-- FIM - head -->
	<!-- Estilo da página -->
	<!-- Fim - Estilo da página -->
	</head>
	<body class="">
	<!-- Header -->
		<header>
			<div class="navbar">
				<div class="container ">
					<a href="<?php echo base_url(); ?>" class="navbar-brand marca">
						<span class="logo-uerj logo-uerj">
							<!-- importando svg do logo uerj -->
							<?php echo file_get_contents(base_url('assets/images/logo_uerj.svg')); ?>
						</span>
						<div class="titulo">
							<p class="sigla">SISTEMA INTEGRADO DE APOIO</p>
							<p class="nome">ESTACIONAMENTO</p>
						</div>
					</a>

					<!-- Menu de itens para melhorar a acessibilidade (tamanho da fonte e contraste) -->
					<div id="menuAcessibilidade">
						<span title="Restaurar fonte" data-bs-placement="bottom" data-bs-toggle="tooltip"
							  class="font-reset">A</span><span class="visually-hidden">Restaurar fonte</span>
						<span title="Diminuir fonte" data-bs-placement="bottom" data-bs-toggle="tooltip"
							  class="font-minus">A-</span><span class="visually-hidden">Diminuir fonte</span>
						<span title="Aumentar fonte" data-bs-placement="bottom" data-bs-toggle="tooltip"
							  class="font-plus">A+</span><span class="visually-hidden">Aumentar fonte</span>
						<span title="Alto contraste" data-bs-placement="bottom" data-bs-toggle="tooltip" class="contrast">
							<i class="bi-circle-half"></i><span class="visually-hidden">Alto contraste</span>
						</span>
					</div>

					<span id="btnAcessibilidade" title="Menu de acessibilidade">
						<!-- Material Icons Accessibility -->
						<!-- importando svg do logo uerj -->
							<?php echo file_get_contents(base_url('assets/images/acessibilidade.svg')); ?>
						<span class="visually-hidden">Menu de Acessibilidade</span>
					</span>
					<!-- FIM - Menu acessibilidade -->

					<!-- MENU OFFCANVAS -->
					
					<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="menuPrincipal">
						<div class="offcanvas-header">
							<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							<h5 class="offcanvas-title" id="menuLateralLabel">Menu</h5>
						</div>
						<div class="offcanvas-body text-end">
							<nav class="">
								
							</nav>
						</div>
					</div>
					<!-- FIM - MENU OFFCANVAS -->
				</div>
			</div>
		</header>
		<!-- FIM - Header -->

		<main id="pageContent" class="container">
			<!-- Conteúdo mensagem -->
			<!-- FIM - Conteúdo mensagem -->
			<!-- Conteúdo da página -->
			<div class="col-md-12">
				<div class="col-middle" style="margin-top: 10px;">
					<button class="btn btn-primary btn-lg" onclick="window.history.back();" style="margin-left: 50px;"><i class="fa fa-arrow-left"> Voltar</i></button>
					<div class="text-center text-center">
						<h1 class="error-number">404</h1>
						<p>Eu não tenho memória dessa página!</p>
						<img src="<?php echo base_url('../assets/img/404.gif'); ?>" width="1000">
						<br>
					</div>
				</div>
			</div>
			<!-- FIM - Conteúdo da página -->

		</main>

		<?php
			// Captura o tempo de carregamento no final do conteúdo principal
			$end_time = microtime(true);
			$load_time = number_format($end_time - $_SERVER['REQUEST_TIME_FLOAT'], 2);
		?>

		<!-- footer -->
		<footer>
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-8 col-xs-12">
						GedUERJ v1.0.0<br>
						<small>Página renderizada em <strong><?php echo $load_time; ?></strong> segundos.</small>
					</div>
					<div class="col-4 col-xs-12">
						&copy; 2022-2023. <a href="https://www.dgti.uerj.br/" target="_blank">DGTI</a>. Todos os direitos reservados<br>
						<strong>a clone from <a href="https://github.com/diogosvicente/dgti_template_clone" target="_blank" rel="noopener">DAENG</a></strong>
					</div>
				</div>
			</div>
		</footer>
		<!-- FIM - footer -->

		<!-- Javascripts comuns a todas as páginas -->
		<script src="<?php echo base_url('assets/js/libs/cleave.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/corp/base.mask.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/corp/phpjs.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/corp/accessibility.js'); ?>" type="text/javascript"></script>
		<!-- FIM - Javascripts comuns a todas as páginas -->
		<!-- Javascript da página -->
	</body>
</html>		