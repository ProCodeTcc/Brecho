<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>



<div class="slider_linha">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require($diretorio.'controller/controllerSlider.php');
		$listSlider = new controllerSlider();
		$rsSlider = $listSlider->listarSlider();
		$cont = 0;
		while($cont < count($rsSlider)){
	?>
	
	<div class="slider">
		<div class="slider_imagem">
			<img src="../arquivos/<?php echo($rsSlider[$cont]->getImagem()) ?>" alt="imagem do slider">
		</div>
		
		<div class="acoes">
			<span class="editar" onClick="buscar(<?php echo($rsSlider[$cont]->getId()) ?>)">
				<img src="../imagens/pencil.png" alt="ícone para edição">
			</span>
			
			<span onClick="excluir(<?php echo($rsSlider[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png" alt="ícone para exclusão">
			</span>
			
			<span onClick="status(<?php echo($rsSlider[$cont]->getStatus()) ?>, <?php echo($rsSlider[$cont]->getId()) ?>)">
				<?php
					$status = $rsSlider[$cont]->getStatus();
									
					if($status == 1){
						$img = 'ativar.png';
					}else{
						$img = 'desativar.png';
					}
				?>
				
				<img src="../imagens/<?php echo($img) ?>" alt="ícone para alterar o status">
			</span>
		</div>
	</div>
	
	<?php
		$cont++;
		}
	?>
	
</div>