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
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png">
		</span>
		
		<span onclick="excluir(<?php echo($rsTema[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>

<?php
	$cont++;
	}
?>