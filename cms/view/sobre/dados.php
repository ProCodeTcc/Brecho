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
        //armazenando o diretório numa variável
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
        
        //inclusão da controller
		require_once($diretorio.'controller/controllerSobre.php');
        
        //instância da controller
		$listLayout = new controllerSobre();
        
        //armazenando os dados numa variável
		$rsLayout = $listLayout->listarLayout1();
        
        //contador
		$cont = 0;
        
        //percorrendo os dados
		while($cont < count($rsLayout)){
	?>
		
		<div class="sobre_col1_item">
			<div class="sobre_imagem">
				<img src="../arquivos/<?php echo($rsLayout[$cont]->getImagem()) ?>" alt="imagem do layout 1">
			</div>

			<article>
				<p class="sobre_titulo"><?php echo($rsLayout[$cont]->getTitulo()) ?></p>
				<p class="sobre_descricao"><?php echo($rsLayout[$cont]->getDescricao()) ?>...</p>
			</article>

			<div class="acoes">
				<span class="editar" onClick="buscar(<?php echo($rsLayout[$cont]->getId()) ?>)">
					<img src="../imagens/pencil.png" alt="ícone para edição">
				</span>

				<span class="visualizar" onClick="visualizarLayout1(<?php echo($rsLayout[$cont]->getId()) ?>)">
					<img src="../imagens/visualizar.png" alt="ícone para visualização">
				</span>

				<span onClick="status(<?php echo($rsLayout[$cont]->getStatus()) ?>, <?php echo($rsLayout[$cont]->getId()) ?>, <?php echo($rsLayout[$cont]->getLayout()) ?>)">
					<?php
                        //armazenando o status numa variável
						$status = $rsLayout[$cont]->getStatus();
            
                        //verificando o status
						if($status == 1){
							$img = 'ativar.png';
						}else{
							$img = 'desativar.png';
						}
					?>

					<img src="../imagens/<?php echo($img) ?>" alt="ícone para alterar o status">
				</span>

				<span onClick="excluir(<?php echo($rsLayout[$cont]->getId()) ?>, 1)">
					<img src="../imagens/delete16.png" alt="ícone para exclusão">
				</span>
			</div>
		</div>
	<?php 
        //incrementando o contador
		$cont ++;
		} 
	?>
	</div>
	
	<div class="sobre_col2">
	<?php
        //armazenando o diretório numa variável
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
        
        //inclusão da controller
		require_once($diretorio.'controller/controllerSobre.php');
        
        //instância da controller
		$listLayout2 = new controllerSobre();
        
        //armazenando os dados numa variável
		$rsLayout2 = $listLayout2->listarLayout2();
        
        //contador
		$cont = 0;
        
        //percorrendo os dados
		while($cont < count($rsLayout2)){
	?>
		
		<div class="sobre_col2_item">
			<div class="sobre_imagem">
				<img src="../arquivos/<?php echo($rsLayout2[$cont]->getImagem()) ?>" alt="imagem do layout 2">
			</div>

			<article>
				<p class="sobre_titulo"><?php echo($rsLayout2[$cont]->getTitulo()) ?></p>
				<p class="sobre_descricao"><?php echo($rsLayout2[$cont]->getDescricao()) ?>...</p>
			</article>

			<div class="acoes">
				<span class="editar" onClick="buscarLayout2(<?php echo($rsLayout2[$cont]->getId()) ?>)">
					<img src="../imagens/pencil.png" alt="ícone para exclusão">
				</span>

				<span class="visualizar" onClick="visualizarLayout2(<?php echo($rsLayout2[$cont]->getId()) ?>)">
					<img src="../imagens/visualizar.png" alt="ícone para visualização">
				</span>

				<span onClick="status(<?php echo($rsLayout2[$cont]->getStatus()) ?>, <?php echo($rsLayout2[$cont]->getId()) ?>, <?php echo($rsLayout2[$cont]->getLayout()) ?>)">
					<?php
                        //armazenando o status
						$status = $rsLayout2[$cont]->getStatus();

                        //verificando o status
						if($status == 1){
							$img = 'ativar.png';
						}else{
							$img = 'desativar.png';
						}
					?>

					<img src="../imagens/<?php echo($img) ?>" alt="ícone para alterar o status">
				</span>

				<span onClick="excluir(<?php echo($rsLayout2[$cont]->getId()) ?>, 2)">
					<img src="../imagens/delete16.png" alt="ícone para exclusão">
				</span>
			</div>
		</div>
		
	<?php 
        //incrementando o contador
		$cont ++;
		} 
	?>
	</div>
	
</div>