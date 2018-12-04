<script>
	$(document).ready(function(){
		$('.cadastrarPromocao').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="produtos_linha">
	<?php
        //armazenando os dados numa variável
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
    
        //inclusão da controller
		require_once($diretorio.'controller/controllerPromocao.php');

        //instância da controller
		$listProdutos = new controllerPromocao();

        //contador
		$cont = 0;

        //armazenando os dados numa variável
		$rsProdutos = $listProdutos->listarProduto();

        //percorrendo os dados
		while($cont < count($rsProdutos)){
	?>
	<div class="produtos">
		<div class="produtos_imagem">
			<img src="../arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>" alt="imagem do produto">
		</div>

		<article>
			<p class="produtos_titulo"><?php echo($rsProdutos[$cont]->getNome()) ?></p>
		</article>

		<div class="acoes">
			<span onClick="cadastrarPromocao(<?php echo($rsProdutos[$cont]->getId()) ?>)" class="cadastrarPromocao">
				<img src="../imagens/flyers.png" alt="ícone para editar a promoção">
			</span>
			
			<span onClick="excluir(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png" alt="ícone para exclusão">
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
        //incrementando o contador
		$cont++;
		}
	?>
</div>