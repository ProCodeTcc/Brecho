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
	require($diretorio.'controller/controllerUnidade.php');

    //instância da controller
	$listUnidades = new controllerUnidade();

    //armazenando os dados
	$rsUnidades = $listUnidades->listarUnidades();

    //contador
	$cont = 0;

    //percorrendo os dados
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
    //incrementando o contador
	$cont++;
	}
?>