<script>
	$(document).ready(function(){
		$('.cadastrarPromocao').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="produtos_linha">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require_once($diretorio.'controller/controllerPromocao.php');

		$listProdutos = new controllerPromocao();

		$cont = 0;

		$rsProdutos = $listProdutos->listarProduto();

		while($cont < count($rsProdutos)){
	?>
	<div class="produtos">
		<div class="produtos_imagem">
			<img src="<?php echo($rsProdutos[$cont]->getImagem()) ?>">
		</div>

		<article>
			<p class="produtos_titulo"><?php echo($rsProdutos[$cont]->getNome()) ?></p>
		</article>

		<div class="acoes">
			<span onClick="cadastrarPromocao(<?php echo($rsProdutos[$cont]->getId()) ?>)" class="cadastrarPromocao">
				<img src="../imagens/flyers.png">
			</span>
			
			<span onClick="excluir(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png">
			</span>
			
			<span onClick="status(<?php echo($rsProdutos[$cont]->getStatus()) ?>, <?php echo($rsProdutos[$cont]->getId()) ?>)">
				<?php
					$status = $rsProdutos[$cont]->getStatus();
					if($status == 1){
						echo('<img src="../imagens/ativar.png">');
					}else{
						echo('<img src="../imagens/desativar.png">');
					}
				?>
			</span>
		</div>
	</div>
	<?php
		$cont++;
		}
	?>
</div>