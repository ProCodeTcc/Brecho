<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerTema.php');
	$listTema = new controllerTema();
	$rsTema = $listTema->listarTemas();
?>

<style>
	.comprar_produto{
		border-color: <?php echo($rsTema->getCor()); ?>
	}
</style>