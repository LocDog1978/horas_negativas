<?php $count = 1; ?>
<script type="text/javascript">
	var environment = <?php echo json_encode($environment); ?>;
</script>

<table id="dataFromDb" class="display" style="width:100%">
	<thead style="background-color: #ECF0F1; color: black;">
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>Sobrenome</th>
			<th>Login</th>
			<th>Nível</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php //dd($currentUser);

		if ($currentUser->nivel == 3) { /*** tabela para Colaborador ***/ // verificar necessidade de testar se único usuário está ativo ?>
			<tr>
				<td><?php echo $count++; ?></td>
				<td><?php echo $userList->nome; ?></td>
				<td><?php echo $userList->sobrenome; ?></td>
				<td><?php echo $userList->login; ?></td>
				<td><?php echo $userList->descricao; ?></td>
				<td>
					<a href="<?php echo base_url('cadastro/usuarios/update/'.$userList->userId); ?>"><img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/edit.png'); ?>"></a>
				</td>
			</tr>

		<?php } else { /*** tabela para Administrador ***/

			if ($currentUser->nivel == 2) {

				foreach ($userList as $value) :			
					if ($value->ativo == 1) { //mostra ativos
				?>
					<tr>
						<td><?php echo $count++; ?></td>
						<td><?php echo $value->nome; ?></td>
						<td><?php echo $value->sobrenome; ?></td>
						<td><?php echo $value->login; ?></td>
						<td><?php echo $value->descricao; ?></td>
						<td>
							<a href="<?php echo base_url('cadastro/usuarios/update/'.$value->userId); ?>"><img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/edit.png'); ?>"></a>
							<?php if ($value->userId != session()->userID && $value->nivel != 1) { ?>
								<a href="<?php echo base_url('cadastro/usuarios/trash/'.$value->userId); ?>" class="trash-row"><i class="fa fa-trash fa-lg"></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php } // fim do if para mostrar ativos
				endforeach; 
			} else { /*** tabela para Desenvolvedor ***/
				foreach ($userList as $value) : ?>
					<tr>
						<td><?php echo $count++; ?></td>
						<td><?php echo $value->nome; ?></td>
						<td><?php echo $value->sobrenome; ?></td>
						<td><?php echo $value->login; ?></td>
						<td><?php echo $value->descricao; ?></td>
						<td>
							<a href="<?php echo base_url('cadastro/usuarios/update/'.$value->userId); ?>"><img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/edit.png'); ?>"></a>
							<?php if ($value->userId != session()->userID) { /*** deleto todos menos a mim ***/ ?>
								<a href='<?php echo base_url("cadastro/usuarios/delete/".$value->userId); ?>' class="delete-row"><img src="<?php echo base_url('/assets/grocery_crud/themes/flexigrid/css/images/close.png'); ?>"></a>
								<?php if ($value->ativo == 1) { /*** botão lixeira para ativos ***/ ?>
									<a href="<?php echo base_url('cadastro/usuarios/trash/'.$value->userId); ?>" class="trash-row"><i class="fa fa-trash fa-lg" style="margin-right: 3px;"></i></a>
								<?php } else { /*** botão restaurar para não ativos ***/ ?>
									<a href="<?php echo base_url('cadastro/usuarios/restore/'.$value->userId); ?>" class="restore-row"><i class="fa fa-undo fa-lg" style="margin-right: 3px;"></i></a>
								<?php } ?>
							<?php } ?>
						</td>
					</tr>
				<?php endforeach; 
			}
		} //fim do else Colaborador ?>

	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function () {
		$('#dataFromDb').DataTable({
			language: { url: "<?php echo base_url('assets/js/libs/DataTables-1.12.1/traducao'); ?>" }
		});

		$('.trash-row').on('click', function(){
			var trash_url = $(this).attr('href');
			if( confirm( 'Tem certeza que deseja mandar este registro para lixeira?' ) )
			{
				$.ajax({
					url: trash_url,
					dataType: 'json',
					success: function(response) {
						console.log(JSON.stringify(response));
						$("#userTable").load("<?php echo base_url('cadastro/usuarios/table'); ?>");
					}
				});
			}
			return false;
		});
		$('.restore-row').on('click', function(){
			var restore_url = $(this).attr('href');
			if( confirm( 'Tem certeza que deseja restaurar este registro da lixeira?' ) )
			{
				$.ajax({
					url: restore_url,
					dataType: 'json',
					success: function(response) {
						console.log(JSON.stringify(response));
						$("#userTable").load("<?php echo base_url('cadastro/usuarios/table'); ?>");
					}
				});
			}
			return false;
		});
		$('.delete-row').on('click', function(){
			var delete_url = $(this).attr('href');
			if( confirm( 'Tem certeza que deseja excluir este registro?' ) )
			{
				$.ajax({
					url: delete_url,
					dataType: 'json',
					success: function(response) {
						console.log(JSON.stringify(response));
						$("#userTable").load("<?php echo base_url('cadastro/usuarios/table'); ?>");
					}
				});
			}
			return false;
		});
	});
</script>