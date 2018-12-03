<script>	
	$(document).ready(function(){
		$('.visualizar').click(function(){
			$('.container_modal').fadeIn(400);
		});

		$('.aprovar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="produtos_linha">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
		require_once($diretorio.'/controller/controllerAvaliacao.php');
		$listProdutos = new controllerAvaliacao();
		$rsProdutos = $listProdutos->listarProdutosCF();
		$cont = 0;
	
		while($cont < count($rsProdutos)){
	?>
	<div class="produtos">
		<div class="produtos_imagem">
			<img src="../arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>" alt="imagem do produto">
		</div>

		<article>
			<p class="produtos_titulo"><?php echo($rsProdutos[$cont]->getNome()) ?></p>
			<p class="produtos_titulo"><?php echo($rsProdutos[$cont]->getPreco()) ?></p>
		</article>

		<div class="acoes">
			<span class="aprovar" onClick="aprovar(<?php echo($rsProdutos[$cont]->getId()) ?>, <?php echo($rsProdutos[$cont]->getIdCliente()) ?>, <?php echo($rsProdutos[$cont]->getPreco()) ?>, 'F')">
				<img src="../imagens/ativar.png" alt="ícone para aprovação">
			</span>
			
			<span class="visualizar" onClick="visualizar(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/visualizar.png" alt="ícone para visualização">
			</span>
			
			<span onClick="excluir(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png" alt="ícone para exclusão">
			</span>
		</div>
	</div>
	<?php
		$cont++;
		}
	?>

	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
		require_once($diretorio.'/controller/controllerAvaliacao.php');
		$listProdutos = new controllerAvaliacao();
		$rsProdutos = $listProdutos->listarProdutosCJ();
		$cont = 0;
	
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
			<span class="aprovar" onClick="aprovar(<?php echo($rsProdutos[$cont]->getId()) ?>, <?php echo($rsProdutos[$cont]->getIdCliente()) ?>, <?php echo($rsProdutos[$cont]->getPreco()) ?>, 'J')">
				<img src="../imagens/ativar.png" alt="ícone para aprovação">
			</span>
			
			<span class="visualizar" onClick="visualizar(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/visualizar.png" alt="ícone para visualização">
			</span>
			
			<span onClick="excluir(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png" alt="ícone para exclusão">
			</span>
		</div>
	</div>
	<?php
		$cont++;
		}
	?>
</div>