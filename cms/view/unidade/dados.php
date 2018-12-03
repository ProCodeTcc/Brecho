<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require($diretorio.'controller/controllerUnidade.php');
	$listUnidades = new controllerUnidade();
	$rsUnidades = $listUnidades->listarUnidades();
	$cont = 0;
	while($cont < count($rsUnidades)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsUnidades[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsUnidades[$cont]->getNome()) ?></div>
	<div class="users_view_itens"><?php echo($rsUnidades[$cont]->getCidade()) ?></div>
	<div class="users_view_itens">
		<span onclick="buscar(<?php echo($rsUnidades[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsUnidades[$cont]->getId()) ?>, <?php echo($rsUnidades[$cont]->getIdEndereco()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
	</div>
</div>

<?php
	$cont++;
	}
?>