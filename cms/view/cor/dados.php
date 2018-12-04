<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
    //armazenando o diretório numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require($diretorio.'controller/controllerCor.php');

    //instância da controller
	$listCor = new controllerCor();

    //armazenando os dados da cor
	$rsCor = $listCor->listarCor();

    //contador
	$cont = 0;
    
    //percorrendo os dados
	while($cont < count($rsCor)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsCor[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsCor[$cont]->getNome()) ?></div>
	<div class="users_view_itens" style="background-color: <?php echo($rsCor[$cont]->getCor()) ?>"></div>
	
	<div class="users_view_itens">
		<span data-id="<?php echo($rsCor[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsCor[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsCor[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
	</div>
</div>

<?php
    //incrementando o contador
	$cont++;
	}
?>