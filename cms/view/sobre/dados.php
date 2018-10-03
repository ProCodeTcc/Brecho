<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require_once($diretorio.'controller/controllerSobre.php');

	$listSobre = new controllerSobre();
	$rsSobre = $listSobre->listarLayouts();

	$cont = 0;
	while($cont < count($rsSobre)){
?>
<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsSobre[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsSobre[$cont]->getTitulo()) ?></div>
	<div class="users_view_itens"><?php echo($rsSobre[$cont]->getDescricao()) ?></div>
	<div class="users_view_itens">
		<span class="visualizar" onClick="visualizar(<?php echo($rsSobre[$cont]->getId()) ?>)">
			<img src="../imagens/visualizar.png">
		</span>

		<span onclick="excluir(<?php echo($rsSobre[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>

<div class="erro_tabela" data-erro="<?php echo($cont) ?>">
	<h1>Desculpe, não há registros em nosso banco de dados!!</h1>

	<img src="../imagens/sad.png">
</div>
<?php $cont ++;
} ?>