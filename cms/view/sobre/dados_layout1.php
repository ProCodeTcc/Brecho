<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require_once($diretorio.'controller/controllerSobre.php');
	$listLayout = new controllerSobre();
	$rsLayout = $listLayout->listarLayout1();
	$cont = 0;
	while($cont < count($rsLayout)){
?>
<div class="sobre_linha">
	
	<div class="sobre">
		<div class="sobre_imagem">
			<img src="<?php echo($rsLayout[$cont]->getImagem()) ?>">
		</div>

		<article>
			<p class="sobre_titulo"><?php echo($rsLayout[$cont]->getTitulo()) ?></p>
			<p class="sobre_descricao"><?php echo($rsLayout[$cont]->getDescricao()) ?></p>
		</article>

		<div class="acoes">
			<img src="../imagens/visualizar.png">
			<img src="../imagens/ativar.png">
			<img src="../imagens/delete16.png">
		</div>
	</div>

</div>

<div class="quebrar_linha"></div>

<?php
	$cont++;
	}
?>