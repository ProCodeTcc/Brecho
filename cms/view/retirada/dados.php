<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require($diretorio.'controller/controllerRetirada.php');
	$listRetirada = new controllerRetirada();
	$rsRetirada = $listRetirada->listarRetiradas();
	$cont = 0;

	while($cont < count($rsRetirada)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsRetirada[$cont]->getIdRetirada()) ?></div>
	<div class="users_view_itens"><?php echo($rsRetirada[$cont]->getDtRetirada()) ?></div>
	<div class="users_view_itens"><?php echo($rsRetirada[$cont]->getIdPedido())?></div>
	<div class="users_view_itens">
		<span onclick="buscar(<?php echo($rsRetirada[$cont]->getIdRetirada()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png">
		</span>
		
		<span onclick="excluir(<?php echo($rsRetirada[$cont]->getIdRetirada()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>

<?php
	$cont++;
	}
?>