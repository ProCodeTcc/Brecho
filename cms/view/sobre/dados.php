<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="sobre_linha">
	
	<div class="sobre">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require_once($diretorio.'controller/controllerSobre.php');
		$listLayout = new controllerSobre();
		$rsLayout = $listLayout->listarLayout1();
		$cont = 0;
		while($cont < count($rsLayout)){
	?>
		
		<div class="sobre_imagem">
			<img src="<?php echo($rsLayout[$cont]->getImagem()) ?>">
		</div>

		<article>
			<p class="sobre_titulo"><?php echo($rsLayout[$cont]->getTitulo()) ?></p>
			<p class="sobre_descricao"><?php echo($rsLayout[$cont]->getDescricao()) ?></p>
		</article>

		<div class="acoes">
			<img src="../imagens/addconteudo.png">
			<img src="../imagens/delconteudo.png">
			<span class="editar" onClick="buscarLayout1(<?php echo($rsLayout[$cont]->getId()) ?>)">
				<img src="../imagens/pencil.png">
			</span>
			<img src="../imagens/visualizar.png">
			<img src="../imagens/ativar.png">
			<img src="../imagens/delete16.png">
		</div>
	<?php 
		$cont ++;
		} 
	?>
	</div>
	
	<div class="sobre">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require_once($diretorio.'controller/controllerSobre.php');
		$listLayout2 = new controllerSobre();
		$rsLayout2 = $listLayout2->listarLayout2();
		$cont = 0;
		while($cont < count($rsLayout2)){
	?>
		
		<div class="sobre_imagem">
			<img src="<?php echo($rsLayout2[$cont]->getImagem()) ?>">
		</div>

		<article>
			<p class="sobre_titulo"><?php echo($rsLayout2[$cont]->getTitulo()) ?></p>
			<p class="sobre_descricao"><?php echo($rsLayout2[$cont]->getDescricao()) ?></p>
		</article>

		<div class="acoes">
			<img src="../imagens/addconteudo.png">
			<img src="../imagens/delconteudo.png">
			<span class="editar" onClick="buscarLayout2(<?php echo($rsLayout2[$cont]->getId()) ?>)">
				<img src="../imagens/pencil.png">
			</span>
			<img src="../imagens/visualizar.png">
			<img src="../imagens/ativar.png">
			<img src="../imagens/delete16.png">
		</div>
	<?php 
		$cont ++;
		} 
	?>
	</div>
	
</div>

<div class="quebrar_linha"></div>


<div class="erro_tabela" data-erro="<?php echo($cont) ?>">
	<h1>Desculpe, não há registros em nosso banco de dados!!</h1>

	<img src="../imagens/sad.png">
</div>