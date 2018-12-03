<script>
	$(document).ready(function(){
		$('.visualizar').click(function(){
			$.ajax({
			type: 'POST',
			url: 'modal.php',
			success: function(dados){
				$('.container_modal').fadeIn(400);
			}
		});
		});
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require_once($diretorio.'controller/controllerFaleConosco.php');

	$listFeedback = new controllerFaleConosco();
	$rsFaleConosco = $listFeedback->listarFeedback();

	$cont = 0;
	while($cont < count($rsFaleConosco)){
?>
<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsFaleConosco[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsFaleConosco[$cont]->getNome()) ?></div>
	<div class="users_view_itens"><?php echo($rsFaleConosco[$cont]->getAssunto()) ?></div>
	<div class="users_view_itens">
		<span class="visualizar" onClick="visualizar(<?php echo($rsFaleConosco[$cont]->getId()) ?>)">
			<img src="../imagens/visualizar.png" alt="ícone para visualização">
		</span>

		<span onclick="excluir(<?php echo($rsFaleConosco[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
	</div>
</div>
<?php $cont ++;
} ?>