<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<section>
	<h3 class="page-title">Cadastro de Usuários</h3>
</section>

<?php
	$uri = new \CodeIgniter\HTTP\URI(current_url(true));
	$insertID = (!empty($uri->getSegment(4))) ? $uri->getSegment(4) : '';
	// $insertID = (!empty($uri->getSegment(3))) ? $uri->getSegment(3) : ''; [usar_em_produção]
?>
<div id="container_external">
	<div id="alertAfterSave">
		<img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/success.png'); ?>">
		Os dados foram armazenados com sucesso
		<strong><u>
			<a href="<?php echo base_url('cadastro/usuarios/update/'.$insertID); ?>"> Alterar Usuário</a>
		</u></strong>
	</div>

	<div id="header_1"></div>
	<div id="header_2">
		<button id="add_button"><a href="<?php echo base_url('cadastro/usuarios/add'); ?>"><img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/add.png'); ?>"></i> <font color="blue" size="2">Adicionar Novo Usuário</font></a></button>
	</div>
	<hr id="line">
	<div id="container_internal">
		<div id="userTable"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		if (<?php echo $currentUser->fk_nivel; ?> === 3) {
			$('#header_2').hide();
		}
		$('#alertAfterSave').hide();
		let getInsertedID = '<?php echo $insertID; ?>';
		if (getInsertedID !== ''){
			$('#alertAfterSave').show();
		}
		$("#userTable").load("<?php echo base_url('cadastro/usuarios/table'); ?>");
	});
</script>

<?php $this->endSection(); ?>