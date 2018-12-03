<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require($diretorio.'controller/controllerMarca.php');
	$listMarca = new controllerMarca();
	$rsMarca = $listMarca->listarMarca();

	$cont = 0;
	
	while($cont < count($rsMarca)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsMarca[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsMarca[$cont]->getNome()) ?></div>
	<div class="users_view_itens">
        <span data-id="<?php ?>" onclick="buscar(<?php echo($rsMarca[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsMarca[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
	</div>
</div>

<?php
	$cont++;
	}
?>