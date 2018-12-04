<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
    //armazenando os dados numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require($diretorio.'controller/controllerRetirada.php');

    //instância da controller
	$listRetirada = new controllerRetirada();

    //armazenando os dadaos numa variável
	$rsRetirada = $listRetirada->listarRetiradas();

    //contador
	$cont = 0;

    //percorrendo os dados
	while($cont < count($rsRetirada)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsRetirada[$cont]->getIdRetirada()) ?></div>
	<div class="users_view_itens"><?php echo($rsRetirada[$cont]->getDtRetirada()) ?></div>
	<div class="users_view_itens"><?php echo($rsRetirada[$cont]->getIdPedido())?></div>
	<div class="users_view_itens">
		<span onclick="buscar(<?php echo($rsRetirada[$cont]->getIdRetirada()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsRetirada[$cont]->getIdRetirada()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
	</div>
</div>

<?php
    //incrementando o contador
	$cont++;
	}
?>