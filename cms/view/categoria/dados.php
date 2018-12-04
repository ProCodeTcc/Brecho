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
    //armazenando o diretório numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require($diretorio.'controller/controllerCategoria.php');

    //instância da controller
	$listCategoria = new controllerCategoria();

    //armazenando os dados
	$rsCategoria = $listCategoria->listarCategoria();

    //contador
	$cont = 0;
	
    //percorrendo os dados
	while($cont < count($rsCategoria)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsCategoria[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsCategoria[$cont]->getNome()) ?></div>
	<div class="users_view_itens">
		<span class="adicionar_subcategoria" onclick="inserirSubcategoria(<?php echo($rsCategoria[$cont]->getId()) ?>)">
			<img src="../imagens/list.png" alt="ícone para inserir subcategoria">
		</span>
        
        <span data-id="<?php ?>" onclick="buscar(<?php echo($rsCategoria[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsCategoria[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
		
		<span onClick="status(<?php echo($rsCategoria[$cont]->getStatus())?>, <?php echo($rsCategoria[$cont]->getId()) ?>)">
			<?php
                //armazenando o status
				$status = $rsCategoria[$cont]->getStatus();
				
                //verificando o status
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
    //incrementando o contador
	$cont++;
	}
?>