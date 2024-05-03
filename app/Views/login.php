<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<!-- Conteúdo da página -->
<section id="loginPage" class="rounded-2 shadow">
	<form action="<?php echo base_url('login/signIn'); ?>" id="formLogin" name="formLogin" role="form" class="form-login" method="post" accept-charset="utf-8">
		<fieldset>
			<legend>Login</legend>
			<div class="row">
				<div class="col-12">
					<label for="login" class="form-label">Login
						<a href="#" class="bi-info-circle-fill" data-bs-trigger="click" data-bs-toggle="popover" data-bs-content="Utilize as credenciais do informadas por e-mail para realizar o login. Caso não possua, será necessário solicitá-las ao administrador no sistema.">
						</a>
					</label>
					<input type="text" name="login" value="" id="login" label="Login" class="form-control" placeholder="Utilize o nome do usuário como login" autocomplete="off" required="required" />
				</div>
				<div class="col-12">
					<label for="password" class="form-label">Senha
						<i id="passwordEye" data-bs-toggle="tooltip" title="Exibir senha" class="bi-eye-fill"></i>
					</label>
					<input type="password" name="senha" value="" id="password" label="Senha" class="form-control" placeholder="Digite sua senha" autocomplete="off" required="required" />
				</div>
				<div class="row mt-0">
					<div class="col-12 d-flex flex-row justify-content-end">
						<button type="submit" class="btn btn-primary submit" content="Entrar">Entrar</button>
					</div>
				</div>
			</div><!-- .row -->
		</fieldset>
	</form>
</section>

<div id="msgErroGeral" class="col-12 alert-dismissible" role="alert">
	<?php $msg = session()->getFlashData('msg'); ?>
	<?php if (!empty($msg)) : ?>
	<div class="alert alert-danger">
		<?php echo $msg ?>
	</div>
	<?php endif; ?>
</div>

<!-- FIM - Conteúdo da página -->
<?php $this->endSection('content'); ?>