<script>
	var erro = $('.erro_tabela').data('erro');
	
	if(erro == 0){
		$('.erro_tabela').show();
	}
	
	$(document).ready(function(){
		$('.visualizar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="produtos_linha">
	<?php
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
		require_once($diretorio.'/controller/controllerAvaliacao.php');
		$listProdutos = new controllerAvaliacao();
		$rsProdutos = $listProdutos->listarProdutos();
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
			<span onClick="aprovar(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/ativar.png">
			</span>
			
			<span class="visualizar" onClick="visualizar(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/visualizar.png">	
			</span>
			
			<span onClick="excluir(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png">
			</span>
		</div>
	</div>
	<?php
		$cont++;
		}
	?>
</div>

<div class="erro_tabela" data-erro="<?php echo($cont) ?>">
	<h1>Desculpe, não há registros em nosso banco de dados!!</h1>

	<img src="../imagens/sad.png">
</div>