<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
    if(isset($_POST['pesquisa'])){
        $pesquisa = $_POST['pesquisa'];
    }

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require($diretorio.'controller/controllerCor.php');
	$listCor = new controllerCor();
	$rsCor = $listCor->pesquisarCor($pesquisa);
	$cont = 0;

	while($cont < count($rsCor)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsCor[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsCor[$cont]->getNome()) ?></div>
	<div class="users_view_itens" style="background-color: <?php echo($rsCor[$cont]->getCor()) ?>"></div>
	
	<div class="users_view_itens">
		<span data-id="<?php echo($rsCor[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsCor[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png">
		</span>
		
		<span onclick="excluir(<?php echo($rsCor[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>

<?php
	$cont++;
	}
?>

<div class="voltar" onclick="voltar()">
    <img src="../imagens/back.png">
</div>