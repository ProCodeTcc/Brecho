<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})

		$('.adicionar_subcategoria').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require($diretorio.'controller/controllerCategoria.php');
	$listCategoria = new controllerCategoria();
	$rsCategoria = $listCategoria->listarCategoria();

	$cont = 0;
	
	while($cont < count($rsCategoria)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsCategoria[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsCategoria[$cont]->getNome()) ?></div>
	<div class="users_view_itens">
		<span class="adicionar_subcategoria" onclick="inserirSubcategoria(<?php echo($rsCategoria[$cont]->getId()) ?>)">
			<img src="../imagens/list.png">
		</span>
        
        <span data-id="<?php ?>" onclick="buscar(<?php echo($rsCategoria[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png">
		</span>
		
		<span onclick="excluir(<?php echo($rsCategoria[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
		
		<span onClick="status(<?php echo($rsCategoria[$cont]->getStatus())?>, <?php echo($rsCategoria[$cont]->getId()) ?>)">
			<?php
				$status = $rsCategoria[$cont]->getStatus();
				
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