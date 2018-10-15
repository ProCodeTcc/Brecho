<?php
	if(isset($_POST['imagem'])){
		$imagem = $_POST['imagem'];
	}
?>

<script>
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
	});
</script>

<img class="fechar" src="imagens/fechar.png">

<div id="visualizar">
	<img src="../cms/view/arquivos/<?php echo($imagem) ?>">
</div>