<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<section>
	<h3 class="page-title">Cadastro de Portões</h3>
</section>

<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

	<div style='height:20px;'></div>  
	<div style="padding: 10px">
		<?php echo $output; ?>
	</div>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

<?php $this->endSection(); ?>