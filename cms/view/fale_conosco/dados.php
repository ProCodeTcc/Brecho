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
    //armazenando os dados numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require_once($diretorio.'controller/controllerFaleConosco.php');

    //instância da controller
	$listFeedback = new controllerFaleConosco();

    //armazenando os dados numa variável
	$rsFaleConosco = $listFeedback->listarFeedback();

    //contador
	$cont = 0;

    //percorrendo os dados
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
<?php
    //incrementando o contador
    $cont ++;
} ?>