<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
		
		$('.visualizar_imagens').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});
</script>

<div class="produtos_linha">
	<?php
        //verificando se existe algo para pesquisar
        if(isset($_POST['pesquisa'])){
            //armazenando os dados numa variável
            $pesquisa = $_POST['pesquisa'];
        }

        //armazenando o diretório numa variável
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
    
        //inclusão da controller
		require_once($diretorio.'controller/controllerProduto.php');

        //instância da controller
		$listProdutos = new controllerProduto();

        //contador
		$cont = 0;

        //armazenando os dados numa variável
		$rsProdutos = $listProdutos->pesquisarProduto($pesquisa);

        //percorrendo os dados
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
			<span class="editar" onClick="buscar(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/pencil.png">
			</span>
			
			<span class="visualizar_imagens" onClick="listarImagens(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/viewimagem.png">
			</span>
			
			<span onClick="excluir(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/delete16.png">
			</span>
			
			<span onClick="status(<?php echo($rsProdutos[$cont]->getStatus()) ?>, <?php echo($rsProdutos[$cont]->getId()) ?>)">
				<?php
                    //armazenando o status
					$status = $rsProdutos[$cont]->getStatus();
					
                    //verificando o status
					if($status == 1){
						echo('<img src="../imagens/ativar.png">');
					}else{
						echo('<img src="../imagens/desativar.png">');
					}
				?>
			</span>
			
			<span onClick="inserirPromocao(<?php echo($rsProdutos[$cont]->getId()) ?>)">
				<img src="../imagens/remoprmo.png">
			</span>
		</div>
	</div>
	<?php
        //incrementando o contador
		$cont++;
		}
	?>
</div>

<div class="voltar" onclick="voltar()">
    <img src="../imagens/back.png">
</div>