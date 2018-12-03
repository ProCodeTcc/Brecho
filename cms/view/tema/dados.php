<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require($diretorio.'controller/controllerTema.php');
	$listTema = new controllerTema();
	$rsTema = $listTema->listarTema();

	$cont = 0;
	
	while($cont < count($rsTema)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsTema[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsTema[$cont]->getNome()) ?></div>
	<div class="users_view_itens"><?php echo($rsTema[$cont]->getGenero())?></div>
	<div class="users_view_itens">
		<span data-id="<?php ?>" onclick="buscar(<?php echo($rsTema[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsTema[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
		
		<span onClick="status(<?php echo($rsTema[$cont]->getStatus())?>, <?php echo($rsTema[$cont]->getId()) ?>, '<?php echo($rsTema[$cont]->getGenero()) ?>')">
			<?php
				$status = $rsTema[$cont]->getStatus();
				
				if($status == 1){
					echo('<img src="../imagens/ativar.png">');
				}else{
					echo('<img src="../imagens/desativar.png">');
				}
			?>
		</span>
	</div>
</div>

<?php
	$cont++;
	}
?>