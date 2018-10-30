<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
        });
        
        $('.editar_consignacao').click(function(){
            $('.container_modal').fadeIn(400);
        });
		
		$('.visualizar_imagens').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="produtos_linha">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		require_once($diretorio.'controller/controllerConsignacao.php');

		$listProdutos = new controllerConsignacao();

		$cont = 0;

		$rsProdutos = $listProdutos->listarProdutos();

		while($cont < count($rsProdutos)){
	?>
	<div class="produtos">
		<div class="produtos_imagem">
			<img src="../arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>">
		</div>

		<article>
			<p class="produtos_titulo">nome</p>
			<p class="produtos_titulo">preço</p>
		</article>

		<div class="acoes">
            <span class="editar_consignacao" onClick="buscarConsignacao(<?php echo($rsProdutos[$cont]->getId()) ?>, <?php echo($rsProdutos[$cont]->getPreco()) ?>)">
				<img src="../imagens/buy.png">
			</span>

			<span class="editar" onClick="buscar(<?php echo($rsProdutos[$cont]->getIdProduto()) ?>)">
				<img src="../imagens/pencil.png">
			</span>
			
			<span class="visualizar_imagens" onClick="listarImagens(<?php echo($rsProdutos[$cont]->getIdProduto()) ?>)">
				<img src="../imagens/viewimagem.png">
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