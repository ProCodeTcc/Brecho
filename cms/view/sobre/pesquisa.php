<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
		
		$('.visualizar').click(function(){
			$('#dados').hide();
			$('#preview').show();
		});
	});
</script>

<div class="sobre_linha">
	
	<div class="sobre_col1">
	<?php
        if(isset($_POST['pesquisa'])){
            $pesquisa = $_POST['pesquisa'];
        }

		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require_once($diretorio.'controller/controllerSobre.php');
		$listLayout = new controllerSobre();
		$rsLayout = $listLayout->pesquisarLayout1($pesquisa);
		$cont = 0;
		while($cont < count($rsLayout)){
	?>
		
		<div class="sobre_col1_item">
			<div class="sobre_imagem">
				<img src="../arquivos/<?php echo($rsLayout[$cont]->getImagem()) ?>">
			</div>

			<article>
				<p class="sobre_titulo"><?php echo($rsLayout[$cont]->getTitulo()) ?></p>
				<p class="sobre_descricao"><?php echo($rsLayout[$cont]->getDescricao()) ?>...</p>
			</article>

			<div class="acoes">
				<span class="editar" onClick="buscar(<?php echo($rsLayout[$cont]->getId()) ?>)">
					<img src="../imagens/pencil.png">
				</span>

				<span class="visualizar" onClick="visualizarLayout1(<?php echo($rsLayout[$cont]->getId()) ?>)">
					<img src="../imagens/visualizar.png">
				</span>

				<span onClick="status(<?php echo($rsLayout[$cont]->getStatus()) ?>, <?php echo($rsLayout[$cont]->getId()) ?>, <?php echo($rsLayout[$cont]->getLayout()) ?>)">
					<?php
						$status = $rsLayout[$cont]->getStatus();
						if($status == 1){
							$img = 'ativar.png';
						}else{
							$img = 'desativar.png';
						}
					?>

					<img src="../imagens/<?php echo($img) ?>">
				</span>

				<span onClick="excluir(<?php echo($rsLayout[$cont]->getId()) ?>, 1)">
					<img src="../imagens/delete16.png">
				</span>
			</div>
		</div>
	<?php 
		$cont ++;
		} 
	?>
	</div>
	
	<div class="sobre_col2">
	<?php
        if(isset($_POST['pesquisa'])){
            $pesquisa = $_POST['pesquisa'];
        }

		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require_once($diretorio.'controller/controllerSobre.php');
		$listLayout2 = new controllerSobre();
		$rsLayout2 = $listLayout2->pesquisarLayout2($pesquisa);
		$cont = 0;
		while($cont < count($rsLayout2)){
	?>
		
		<div class="sobre_col2_item">
			<div class="sobre_imagem">
				<img src="../arquivos/<?php echo($rsLayout2[$cont]->getImagem()) ?>">
			</div>

			<article>
				<p class="sobre_titulo"><?php echo($rsLayout2[$cont]->getTitulo()) ?></p>
				<p class="sobre_descricao"><?php echo($rsLayout2[$cont]->getDescricao()) ?>...</p>
			</article>

			<div class="acoes">
				<span class="editar" onClick="buscarLayout2(<?php echo($rsLayout2[$cont]->getId()) ?>)">
					<img src="../imagens/pencil.png">
				</span>

				<span class="visualizar" onClick="visualizarLayout2(<?php echo($rsLayout2[$cont]->getId()) ?>)">
					<img src="../imagens/visualizar.png">
				</span>

				<span onClick="status(<?php echo($rsLayout2[$cont]->getStatus()) ?>, <?php echo($rsLayout2[$cont]->getId()) ?>, <?php echo($rsLayout2[$cont]->getLayout()) ?>)">
					<?php
						$status = $rsLayout2[$cont]->getStatus();

						if($status == 1){
							$img = 'ativar.png';
						}else{
							$img = 'desativar.png';
						}
					?>

					<img src="../imagens/<?php echo($img) ?>">
				</span>

				<span onClick="excluir(<?php echo($rsLayout2[$cont]->getId()) ?>, 2)">
					<img src="../imagens/delete16.png">
				</span>
			</div>
		</div>
		
	<?php 
		$cont ++;
		} 
	?>
	</div>
	
</div>

<div class="voltar" onclick="voltar()">
    <img src="../imagens/back.png">
</div>