<!doctype html>
<html lang="pt-br">
	<head>
	<!-- head -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Horas Negativas | Sistema de Controle de Horas Negativas">
		<meta name="author" content="PREFEI - Prefeitura dos Campi">
		<meta name="Access-Control-Allow-Origin" content="*">
		<title>Horas Negativas | DEGSEG</title>
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

		<!-- isDatatablesPage -->
		<?php if (isset($isDataTablesPage)) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/jquery.dataTables.min.css'); ?>">
			<script type="text/javascript" src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js'); ?>"></script>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/responsive.dataTables.min.css'); ?>">
			<script src="<?php echo base_url('assets/datatables/dataTables.responsive.min.js'); ?>"></script>

			<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
		<?php } ?>

		<script src="<?php echo base_url('assets/js/libs/tinymce_6.2.0/tinymce.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/libs/tinymce_6.2.0/themes/silver/theme.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/libs/tinymce_6.2.0/langs/pt_BR.js'); ?>" type="text/javascript"></script>
		<!-- Folha de estilos extras para páginas específicas -->
		<!-- isLoginPage -->
		<?php if (isset($isLoginPage)) { ?>
			<link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">
		<?php } ?>
		<!-- isSobrePage -->
		<?php if (isset($isSobrePage)) { ?>
			<link href="<?php echo base_url('assets/css/sobre.css'); ?>" rel="stylesheet">
		<?php } ?>

		<!-- isSobrePage -->
		<?php if (isset($isSweetAlertPage)) { ?>
			<link href="<?php echo base_url('assets/sweetalert2/dark.css'); ?>" rel="stylesheet">
			<script type="text/javascript" src="<?php echo base_url('assets/sweetalert2/sweetalert2.min.js'); ?>"></script>
		<?php } ?>

		<!-- isChosenPage -->
		<?php if (isset($isChosenPage)) { ?>
			<link href="<?php echo base_url('../assets/chosen_v1.8.3/docsupport/prism.css'); ?>" rel="stylesheet">
			<link href="<?php echo base_url('../assets/chosen_v1.8.3/chosen.css'); ?>" rel="stylesheet">
			<link href="<?php echo base_url('../assets/chosen_v1.8.3/chosenAux.css'); ?>" rel="stylesheet">
		<?php } ?>

		<!-- daterangepicker -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/daterangepicker/css/daterangepicker.css'); ?>" />

		<!-- highcharts -->
		<?php if (isset($highchartsPage)) { ?>
			<script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>" type="text/javascript"></script>
			<script src="<?php echo base_url('assets/highcharts/highcharts-3d.js'); ?>" type="text/javascript"></script>
			<script src="<?php echo base_url('assets/highcharts/exporting.js'); ?>" type="text/javascript"></script>
			<script src="<?php echo base_url('assets/highcharts/export-data.js'); ?>" type="text/javascript"></script>
			<script src="<?php echo base_url('assets/highcharts/accessibility.js'); ?>" type="text/javascript"></script>
		<?php } ?>

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
							<?php echo "<img src='" . base_url('assets/images/logo_prefeitura_branca.png') . "' style='width: 300px; height: auto;' >"; ?>

						</span>
						<div class="titulo">
							<p class="sigla">HORAS NEGATIVAS</p>
							<p class="nome">DISEG</p>
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

					<?php if (!(bool)session()->usuario_logado) { ?>
						<span id="btnAcessibilidade" title="Sobre o sistema">
							<a href="#" id="about">
								<img
									src="<?php echo base_url('/assets/images/icons8-info-50.png'); ?>"
									width="25"
								>
							</a>
						</span>
					<?php } ?>

					<!-- MENU OFFCANVAS -->
					<?php if ((bool)session()->usuario_logado) { ?>
						<button class="navbar-toggler" type="button" id="btnMenu" data-bs-toggle="offcanvas" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal">
							<i class="bi-list"></i>
						</button>
					<?php } ?>
					<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="menuPrincipal">
						<div class="offcanvas-header">
							<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							<h5 class="offcanvas-title" id="menuLateralLabel">Menu</h5>
						</div>
						<div class="offcanvas-body text-end">
							<nav class="">
								<ul class="">
									<li class="">
										<a href="<?php echo base_url('cad_negativas'); ?>" class="">Horas Negativas</a>
									</li>
									<?php if (((bool)session()->usuario_logado) && ($currentUser->fk_nivel == 1 || $currentUser->fk_nivel == 2)) : ?>
										<li class="sub-menu"><a href="#">Cadastro</a>
											<ul class="">
												<li class=""><a href="" class="">Postos</a></li>
												<li class=""><a href="<?=base_url('cadastro/usuarios');?>" class="">Usuários</a></li>
											</ul>
										</li>
									<?php endif;
									if ((bool)session()->usuario_logado)  : ?>
										<li class=""><a href="<?=base_url('cadastro/usuarios/update/'.$currentUser->id_usuario);?>" class="">Alterar Meus Dados</a></li>
									<?php endif;
									if (((bool)session()->usuario_logado) && ($currentUser->fk_nivel == 1 || $currentUser->fk_nivel == 2)) : ?>
										<hr>
										<li class=""><a href="<?=base_url('cadastro/logs_alteracoes');?>" class="">Logs de Alterações</a></li>
									<?php endif; ?>
									<li class=""><a href="<?= base_url('/login/signOut'); ?>" class="">Sair</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<!-- FIM - MENU OFFCANVAS -->
				</div>
			</div>
		</header>

		<?php if ((bool)session()->usuario_logado) { ?>
			<div class="container is-logged">
				<div class="row">
					<div class="col-12">
						<p class="small">
							<span class="float-end fst-italic"> <?= $currentUser->nome . " " . $currentUser->sobrenome ?> <a
										href="<?= base_url('/login/signOut'); ?>"><i class="bi-box-arrow-right"></i> Sair</a></span>
						</p>
					</div>
				</div>
			</div>
		<?php } ?>
		<!-- FIM - Header -->

		<main id="pageContent" class="container">
			<!-- Conteúdo mensagem -->
			<!-- FIM - Conteúdo mensagem -->
			<!-- Conteúdo da página -->
				
			
			<?php $this->renderSection('content'); ?>
			
			<!-- FIM - Conteúdo da página -->

			<!--  Mensagens do Sistema  -->
			<div id="divLoading" class="col-12 alert" style="display: none;">
				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="load">Carregando dados...</span>
			</div>
			<div id="msgErroGeral" class="col-12 alert alert-danger alert-dismissible" role="alert"
				 style="display: none;"></div>
			<div id="msgSucessoGeral" class="col-12 alert alert-success alert-dismissible" role="alert"
				 style="display: none;"></div>
			<div id="msgAvisoGeral" class="col-12 alert alert-warning alert-dismissible" role="alert"
				 style="display: none;"></div>
			<!-- FIM - Mensagens do Sistema  -->
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
						TÍTULO<br>
						<small>Página renderizada em <strong><?php echo $load_time; ?></strong> segundos.</small>
					</div>
					<div class="col-4 col-xs-12">
						&copy; 2022-2023. <a href="https://www.dgti.uerj.br/" target="_blank" rel="noopener">DGTI</a>. Todos os direitos reservados<br>
						<strong>Um sistema da <a href="https://www.prefeitura.uerj.br/" target="_blank" rel="noopener"> Prefeitura dos Campi</a></strong>
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
		<!-- isLoginPage -->
		<?php if (isset($isLoginPage)) { ?>
			<script src="<?php echo base_url('assets/js/user/login.js'); ?>" type="text/javascript"></script>
		<?php } ?>
		<!-- jquery redirect -->
		<?php if (isset($jqueryRedirect)) { ?>
			<script type="text/javascript" src="<?php echo base_url('assets/jquery.redirect/jquery.redirect.js') ?>"></script>
		<?php } ?>

		<!-- isChosenPage -->
		<?php if (isset($isChosenPage)) { ?>
			<script src="<?php echo base_url('../assets/chosen_v1.8.3/chosen.jquery.js'); ?>"></script>
			<script src="<?php echo base_url('../assets/chosen_v1.8.3/docsupport/prism.js'); ?>"></script>
			<script src="<?php echo base_url('../assets/chosen_v1.8.3//docsupport/init.js'); ?>"></script>
		<?php } ?>

		<!-- daterangepicker custom -->
		<?php if (isset($isDaterangepickerPage)) { ?>
			<script type="text/javascript" src="<?php echo base_url('assets/daterangepicker/custom/daterangepicker.js'); ?>"></script>
		<?php } ?>

		<?php if (isset($isDaterangepickerPage)) { ?>
			<script type="text/javascript" src="<?php echo base_url('assets/daterangepicker/js/moment.min.js'); ?>"></script>
			<script type="text/javascript" src="<?php echo base_url('assets/daterangepicker/js/daterangepicker.min.js'); ?>"></script>
			<script type="text/javascript" src="<?php echo base_url('assets/daterangepicker/js/moment-with-locales.min.js'); ?>"></script>
		<?php } ?>
		<!-- Javascript da página -->
	</body>
</html>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/css/sobreSweetAlert.css'); ?>">
<script>
	if (document.getElementById('about')) {
		document.getElementById('about').addEventListener('click', function() {
			Swal.fire({
				title: `Sobre`,
				html: `<section id="sobre" class="body-size">
						<h3 class="page-title title-size">Sobre o Sistema</h3>
						<fieldset>
							<legend class="legend-size">TÍTULO | SUBTÍTULO</legend>
							<div class="row">
								<div class="table-responsive-sm col-12">
									<table id="sobreTable" class="cell-border" style="width:100%">
										<tbody>
											<tr>
												<td class="rotulo">Nome</td>
												<td class="conteudo">TÍTULO | SUBTÍTULO</td>
											</tr>
											<tr>
												<td class="rotulo">Descrição</td>
												<td class="conteudo">Ferramenta desenvolvida para cadastro e controle de participantes em eventos.</td>
											</tr>
											<tr>
												<td class="rotulo">Desenvolvedores </td>
												<td class="conteudo">Diogo Nascimento/Leandro Carlos - <a href="https://www.prefeitura.uerj.br/" onclick="window.open('https://www.prefeitura.uerj.br/', '_blank'); return false;">Prefeitura dos Campi</a>/<a href="https://www.prefeitura.uerj.br/prefeitura/daeng/" onclick="window.open('https://www.prefeitura.uerj.br/prefeitura/daeng/', '_blank'); return false;">DAENG</a>
												</td>
											</tr>
											<tr>
												<td class="rotulo">Site</td>
												<td class="conteudo"><a href="https://github.com/diogosvicente" onclick="window.open('https://github.com/diogosvicente', '_blank'); return false;">https://github.com/diogosvicente</a>
												</td>
											</tr>
											<tr>
												<td class="rotulo">Template</td>
												<td class="conteudo"><a href="https://www.dinfo.uerj.br" onclick="window.open('https://www.dgti.uerj.br', '_blank'); return false;">DGTI</a> - Diretoria Geral de Tecnologia da Informação
												</td>
											</tr>
											<tr>
												<td class="rotulo">Versão corrente</td>
												<td class="conteudo">v1.0.0 </td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</fieldset>
					</section>			
				`,
				showCloseButton: true,
				customClass: {
					container: 'white-background white-background-media'
				},
				focusConfirm: false,
				confirmButtonText: `
					<i class="fa fa-close"></i> Fechar!
				`
			});
		});
	}
</script>
