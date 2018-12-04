<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<?php
    //verificando se existe algo para pesquisar
    if(isset($_POST['pesquisa'])){
        //resgatando o termo
        $pesquisa = $_POST['pesquisa'];
    }

    //armazenando o diretório numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require_once($diretorio.'controller/controllerMarca.php');

    //instância da controller
	$listMarca = new controllerMarca();

    //armazenando os dados numa variável
	$rsMarca = $listMarca->pesquisarMarca($pesquisa);

    //contador
	$cont = 0;
	
    //percorrendo os dados
	while($cont < count($rsMarca)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsMarca[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsMarca[$cont]->getNome()) ?></div>
	<div class="users_view_itens">
        <span data-id="<?php ?>" onclick="buscar(<?php echo($rsMarca[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png">
		</span>
		
		<span onclick="excluir(<?php echo($rsMarca[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>

<?php
    //incrementando os dados
	$cont++;
	}
?>

    <div class="voltar" onclick="voltar()">
        <img src="../imagens/back.png">
    </div>