<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/css/add_style.css') ?>">
<script type="text/javascript">
	let environment = <?php echo json_encode($environment); ?>;
	let state = <?php echo json_encode($state); ?>;
	let update = (state === "Editar Usuário") ? 1 : 0;
</script>

<section>
    <h3 class="page-title">Cadastro de Usuários</h3>
</section>

<?php

/**
 * Arrays from form
 *
 * I preferred to do it separately for organizational reasons.
 * Trying to do a clean code
 * 
 */

helper('form');

// update variables
$id = isset($toUpdate['id']) ? $toUpdate['id'] : '';
$nomeValue = isset($toUpdate['nome']) ? $toUpdate['nome'] : '';
$sobrenomeValue = isset($toUpdate['sobrenome']) ? $toUpdate['sobrenome'] : '';
$loginValue = isset($toUpdate['login']) ? $toUpdate['login'] : '';
$senhaValue = isset($toUpdate['senha']) ? $toUpdate['senha'] : '';
$senhaConfirmarValue = isset($toUpdate['senhaConfirmar']) ? $toUpdate['senhaConfirmar'] : '';
$nivelValue = isset($toUpdate['nivel']) ? $toUpdate['nivel'] : '';

$openRow = "<div class='mb-3 row'>";
$openRowOn = "<div class='mb-3 row zebraOn' style='padding: 0; margin: 0 !important;'>";
$openRowOff = "<div class='mb-3 row zebraOff' style='padding: 0; margin: 0 !important;';>";
$openFooter = "<div class='mb-12 row formFooter' style='padding: 0; margin: 0 !important;';>";
$openFooterLeft = "<div class='col-sm-1'>";
$openFooterCenter = "<div class='col-sm-3'>";
$openFooterRight = "<div class='col-sm-1'>";
$openFooterRight2 = "<div class='col-sm-1'>";
$closeRow = "</div>";


/* ---------- Campo Nome ---------- */
$attr_lbl_nome = [
	'class' => 'col-sm-2 col-form-label',
	'style' => 'font-size: 14px;'
];
$data_form_input_nome = [
	'name'          =>  'nome',
	'id'            =>  'nome',
	'class'         =>  'form-control mySelect',
	'placeholder'   =>  'Digite o nome do usuário',
	'required'      =>  true,
	'value'         =>  $nomeValue
];

/* ---------- Campo Sobrenome ---------- */
$attr_lbl_sobrenome = [
	'class' => 'col-sm-2 col-form-label',
	'style' => 'font-size: 14px;'
];
$data_form_input_sobrenome = [
	'name'          =>  'sobrenome',
	'id'            =>  'sobrenome',
	'class'         =>  'form-control mySelect',
	'placeholder'   =>  'Digite o sobrenome do usuário',
	'required'      =>  true,
	'value'         =>  $sobrenomeValue
];

/* ---------- Campo Login ---------- */
$attr_lbl_login = [
	'class' => 'col-sm-2 col-form-label',
	'style' => 'font-size: 14px;'
];
$data_form_input_login = [
	'name'          =>  'login',
	'id'            =>  'login',
	'class'         =>  'form-control mySelect',
	'placeholder'   =>  'Digite o login do usuário',
	'required'      =>  true,
	'value'         =>  $loginValue
];

/* ---------- Campo Senha ---------- */
$attr_lbl_senha = [
	'class' => 'col-sm-2 col-form-label',
	'style' => 'font-size: 14px;'
];
$data_form_input_senha = [
	'name'          =>  'senha',
	'id'            =>  'senha',
	'class'         =>  'form-control mySelect',
	'placeholder'   =>  'Digite o senha do usuário',
	'required'      =>  true,
	'value'         =>  $senhaValue
];

/* ---------- Campo SenhaConfirmar ---------- */
$attr_lbl_senhaConfirmar = [
	'class' => 'col-sm-2 col-form-label',
	'style' => 'font-size: 14px;'
];
$data_form_input_senhaConfirmar = [
	'name'          =>  'senhaConfirmar',
	'id'            =>  'senhaConfirmar',
	'class'         =>  'form-control mySelect',
	'placeholder'   =>  'Repita a senha do usuário',
	'required'      =>  true,
	'value'         =>  $senhaConfirmarValue
];

/* ---------- Campo Nível ---------- */
$attr_lbl_nivel = [
	'class' => 'col-sm-2 col-form-label',
	'style' => 'font-size: 14px;'
];
if ($currentUser->nivel == 3) { //bloqueia a troca de nível se o usuário for coloborador
	$attr_select_nivel = [
		'id'        =>  'nivel',
		'class'     =>  'form-control zebraOn mySelect',
		'required'  =>  true,
		'disabled'	=>	true
	];
} else {
	$attr_select_nivel = [
		'id'        =>  'nivel',
		'class'     =>  'form-control zebraOn mySelect',
		'required'  =>  true		
	];
}

/* ---------- Campo id ---------- */
$data_form_hidden = [
	'name'          =>  'id',
	'id'            =>  'id',
	'value'         =>  $id
];

/* ---------- Botões inferiores ---------- */
$attrSaveButton = [
	'content'   =>  'Salvar',
	'id'        =>  'saveButton',
	'class'     =>  'form-control footerButton col-sm-2 col-form-label'
];
$attrSaveAnBackButton = [
	'content'   =>  'Salvar e voltar para a listagem',
	'id'        =>  'saveAndBackButton',
	'class'     =>  'form-control footerButton'
];
$attrCancelbutton = [
	'content'   =>  'Cancelar',
	'id'        =>  'cancelButton',
	'class'     =>  'form-control footerButton'
];

$attrCancelbuttonColaborador = [
	'content'   =>  'Cancelar',
	'id'        =>  'cancelButtonColaborador',
	'class'     =>  'form-control footerButton'
];

$attrResetButton = [
	'content'   =>  'Resetar',
	'id'        =>  'resetButton',
	'class'     =>  'form-control footerButton'
];

echo "<div id='container_external'>";
echo "<div id='header'>$state</div>";

// início do form

// input Nome
echo '<div id="divNome">';
	echo $openRowOff;
	echo form_label('Nome:', 'nome', $attr_lbl_nome);
	echo "<div class='col-sm-4'>";
		echo form_input($data_form_input_nome);
	echo "</div>";
	echo $closeRow;
echo '</div>';

// input Sobrenome
echo '<div id="divSobrenome">';
	echo $openRowOn;
	echo form_label('Sobrenome:', 'sobrenome', $attr_lbl_sobrenome);
	echo "<div class='col-sm-4'>";
		echo form_input($data_form_input_sobrenome);
	echo "</div>";
	echo $closeRow;
echo '</div>';

// input Login
echo '<div id="divLogin">';
	echo $openRowOff;
	echo form_label('Login:', 'login', $attr_lbl_login);
	echo "<div class='col-sm-4'>";
	echo form_input($data_form_input_login);
	echo "</div>";
	echo $closeRow;
echo '</div>';

// input Senha
echo '<div id="divSenha">';
	echo $openRowOn;
	echo form_label('Senha:', 'senha', $attr_lbl_senha);
	echo "<div class='col-sm-4'>";
	echo form_password($data_form_input_senha);
	echo "</div>";
	echo $closeRow;
echo '</div>';

// input Confirmar Senha
echo '<div id="divSenhaConfirmar">';
	echo $openRowOff;
	echo form_label('Confirmar Senha:', 'senhaConfirmar', $attr_lbl_senhaConfirmar);
	echo "<div class='col-sm-4'>";
	echo form_password($data_form_input_senhaConfirmar);
	echo "</div>";
	echo $closeRow;
echo '</div>';

// select Nível
echo '<div id="divNivel">';
	echo $openRowOn;
	echo form_label('Nível* : ', 'nivel', $attr_lbl_nivel);
	$optionsTiposNiveis = ['' => '- - - Selecione - - -'];
	foreach ($niveisList as $option) {
		$optionsTiposNiveis[$option->id] = $option->descricao;
	}
	echo "<div class='col-sm-4'>";
	echo form_dropdown('nivel', $optionsTiposNiveis, $nivelValue, $attr_select_nivel);
	echo "</div>";
	echo $closeRow;
echo '</div>';

?> <input type="hidden" id="id" value="<?php echo $id; ?>"> <?php

echo "<div id='preFooter'>";
	echo "<div id='requiredMessage'>";
		echo "<div id='rqNome'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> O Campo Nome é obrigatório.";
		echo "</div>";
		echo "<div id='rqSobrenome'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> O Campo Sobrenome é obrigatório.";
		echo "</div>";
		echo "<div id='rqLogin'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> O Campo Login é obrigatório.";
		echo "</div>";
		echo "<div id='rqSenha'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> O Campo Senha é obrigatório.";
		echo "</div>";
		echo "<div id='rqSenhaConfirmar'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> O Campo Confirmar Senha é obrigatório.";
		echo "</div>";
		echo "<div id='rqNivel'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> O Campo Nível é obrigatório.";
		echo "</div>";
		echo "<div id='divValidation'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> Esse login já está em uso.";
		echo "</div>";
		echo "<div id='senhaMenor6'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> A senha deve ter no mínimo 6 caracteres.";
		echo "</div>";
		echo "<div id='senhasConferem'>";
			echo "<img src='".base_url('assets/grocery_crud/themes/flexigrid/css/images/error.png')."' ></i> A confirmação de senha não corresponde à senha.";
		echo "</div>";
	echo "</div>"; ?>

	<div id="successSave">
		<div class="row" style="margin-left: 20px;">
			<img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/success.png'); ?>" style="width:18px; height:20px; margin-right: 10px;">
			Os dados foram armazenados com sucesso
			<div id="editDiv" style="margin-left: 10px; margin-right: 10px;"> </div>
			<?php if ($currentUser->nivel != 3) { ?>
				<a href="<?php echo base_url('cadastro/usuarios'); ?>" style="margin-left: 5px;"><b><u>Voltar para a listagem</u></b></a>
			<?php } else { ?>
				<a href="<?php echo base_url(); ?>" style="margin-left: 5px;"><b><u>Ir para a Página Inicial</u></b></a>
			<?php } ?>
		</div>
	</div>
	<div id='preFooter2'></div>
	<hr id='line'>

	<?php
	echo $openFooter;
		echo "<div class='form-group row'>";
			echo $openFooterLeft;
				echo form_button($attrSaveButton);
			echo "</div>";
			if ($currentUser->nivel == 3) :
				echo $openFooterRight;
					echo form_button($attrCancelbuttonColaborador);
				echo "</div>";
			endif;
			if ($currentUser->nivel != 3) :
				echo $openFooterCenter;
					echo form_button($attrSaveAnBackButton);
				echo "</div>";
				echo $openFooterRight;
					echo form_button($attrCancelbutton);
				echo "</div>";
			endif;

			echo $openFooterRight2;
				echo "<div id='hideResetButton'>";
						echo form_button($attrResetButton);
				echo "</div>";
			echo "</div>";
		echo "</div>";	
	echo $closeRow;
?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#requiredMessage').hide();
		$('#preFooter2').hide();
		$('#divValidation').hide();
		$('#successSave').hide();
		$('#hideResetButton').hide();
		let validationSenhaMenor6 = 0;
		let validationSenhasConferem = 0;

		$("#saveButton, #saveAndBackButton").click(function(){
			let validator = 0;
			let button = (this.id);
			let id = $("#id").val();
			let nome = $("#nome").val();
			let sobrenome = $("#sobrenome").val();
			let login = $("#login").val();
			let senha = $("#senha").val();
			let senhaConfirmar = $("#senhaConfirmar").val();
			let nivel = $("#nivel").val();
			
			validator = (nome === '') ||
				(sobrenome === '') ||
				(login === '') ||
				(senha === '') ||
				(senhaConfirmar === '') ||
				(nivel === '') ? 1 : 0;

			if (validator){ //deixou campo em branco
				$('#preFooter2').hide();
				$("#successSave").slideUp("slow");
				$('#divValidation').hide();
				$("#requiredMessage").slideDown("slow");
				$('#preFooter2').show();
			} else { // preencheu todos os campos
				validationSenhaMenor6 = senha.length < 6 ? 1 : 0; //definir flag para senha < 6
				validationSenhasConferem = senha !== senhaConfirmar ? 1 : 0; //definir flag para senhas diferentes

				$.post("<?php echo base_url('cadastro/usuarios/validation'); ?>", {login:login} )
					.done(function( data ) {
						if (environment === 'development') {
							data = data.replace("<!-- DEBUG-VIEW START 1 APPPATH\\Views\\cadastro\\usuarios\\userAddValidation.php -->", "");
							data = data.replace("<!-- DEBUG-VIEW ENDED 1 APPPATH\\Views\\cadastro\\usuarios\\userAddValidation.php -->", "");
							data = data.replace(/[\r\n]+/g, "");
						}
						if (data > 0 && !update) { // já está cadastrado e não é update
							$('#preFooter2').hide();
							$("#successSave").slideUp("slow");
							$("#requiredMessage").slideDown("slow");
							$('#divValidation').show();
							$('#preFooter2').show();
							$("#divLogin").css("border","solid 1px red");
						} else { //não existe este login, pode cadastrar
							if (!validationSenhaMenor6 && !validationSenhasConferem) {
								$.ajax({
									url: '<?php echo base_url('cadastro/usuarios/store'); ?>',
									data: { flagToUpdate:update,id:id,v1:nome,v2:sobrenome,v3:login,v4:senha,v5:nivel },
									type: 'POST',
									dataType: 'json',
									success: function(response) {
										let insertID;
										if (id !== ''){
											insertID = id;
											$('#editDiv').hide();
										} else {
											insertID = JSON.stringify(response);
											$('#hideResetButton').show();
										}
										if (button == "saveButton"){
											$('#divValidation').hide();
											$("#requiredMessage").slideUp("slow");
											$('#preFooter2').hide();
											$("#successSave").slideDown("slow");
											$('#preFooter2').show();
											$('#editDiv').load('<?php echo base_url('cadastro/usuarios/updateID'); ?>', {savedID:insertID});
										} else {
											$.redirect('<?php echo base_url('cadastro/usuarios'); ?>/'+insertID);
										}
									}
								}) // fim do ajax
							} else { // fim da verificação se a senha é menor que 6
								$('#preFooter2').hide();
								$("#successSave").slideUp("slow");
								$('#divValidation').hide();
								$("#requiredMessage").slideDown("slow");
								$('#preFooter2').show();
							} 
						}
					}
				);
			}
			if (nome === ''){
				$("#divNome").css("border", "solid 1px red");
				$('#rqNome').show();
			} else {
				$("#divNome").css("border", "1px solid #999");
				$('#rqNome').hide();
			}
			if (sobrenome === ''){
				$("#divSobrenome").css("border","solid 1px red");
				$('#rqSobrenome').show();
			} else {
				$("#divSobrenome").css("border", "1px solid #999");
				$('#rqSobrenome').hide();
			}
			if (login === ''){
				$("#divLogin").css("border","solid 1px red");
				$('#rqLogin').show();
			} else {
				$("#divLogin").css("border", "1px solid #999");
				$('#rqLogin').hide();
			}
			if (senha === ''){
				$("#divSenha").css("border","solid 1px red");
				$('#rqSenha').show();
			} else {
				$("#divSenha").css("border", "1px solid #999");
				$('#rqSenha').hide();
			}
			if (senhaConfirmar === ''){
				$("#divSenhaConfirmar").css("border","solid 1px red");
				$('#rqSenhaConfirmar').show();
			} else {
				$("#divSenhaConfirmar").css("border", "1px solid #999");
				$('#rqSenhaConfirmar').hide();
			}
			if (nivel === ''){
				$("#divNivel").css("border","solid 1px red");
				$('#rqNivel').show();
			} else {
				$("#divNivel").css("border", "1px solid #999");
				$('#rqNivel').hide();
			}
			validationSenhaMenor6 ? $('#senhaMenor6').show() : $('#senhaMenor6').hide();
			validationSenhasConferem ? $('#senhasConferem').show() : $('#senhasConferem').hide();
		});
		$("#cancelButton").click(function() {
			if (confirm('Os dados que você inseriu NÃO foram salvos. \r\nTem certeza que deseja retornar para a listagem?')) {
				window.location.replace('<?php echo base_url('cadastro/usuarios'); ?>');
			}
		});
		$("#cancelButtonColaborador").click(function() {
			if (confirm('Os dados que você inseriu NÃO foram salvos. \r\nVocê será redirecionado(a) para a página inicial. \r\nTem certeza?')) {
				window.location.replace('<?php echo base_url(''); ?>');
			}
		});
		$("#resetButton").click(function(){
			window.location.replace('<?php echo base_url('cadastro/usuarios/add'); ?>');
		});
	});
</script>

<?php $this->endSection(); ?>