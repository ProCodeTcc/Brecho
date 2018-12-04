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
    //verificando se existe algo pra pesquisar
    if(isset($_POST['pesquisa'])){
        //armazenando o termo
        $pesquisa = $_POST['pesquisa'];
    }

    //armazenado o diretório
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require_once($diretorio.'controller/controllerFaleConosco.php');

    //instância da controller
	$listFeedback = new controllerFaleConosco();

    //armazenando os dados numa variável
	$rsFaleConosco = $listFeedback->pesquisarFeedback($pesquisa);

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
			<img src="../imagens/visualizar.png">
		</span>

		<span onclick="excluir(<?php echo($rsFaleConosco[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>
<?php
    //incrementando o contador
    $cont ++;
} ?>

<div class="voltar" onclick="voltar()">
    <img src="../imagens/back.png">
</div>