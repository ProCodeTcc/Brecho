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
        //armazenando o diretório numa variável
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
    
        //inclusão da controller
		require_once($diretorio.'controller/controllerConsignacao.php');

        //instãncia da controller
		$listProdutos = new controllerConsignacao();

        //contador
		$cont = 0;
        
        //armazenando os produtos
		$rsProdutos = $listProdutos->listarProdutos();
    
        //armazenando as datas
        $rsConsignacao = $listProdutos->listarData();
        
        //percorrendo os dados
		while($cont < count($rsProdutos)){
            
        //verificando a data
        $listProdutos->verificarData($rsConsignacao[$cont]->getDtTermino(), $rsConsignacao[$cont]->getId());
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
				<img src="../imagens/buy.png" alt="ícone para editar a consignação">
			</span>

			<span class="editar" onClick="buscar(<?php echo($rsProdutos[$cont]->getIdProduto()) ?>)">
				<img src="../imagens/pencil.png" alt="ícone para edição">
			</span>
			
			<span class="visualizar_imagens" onClick="listarImagens(<?php echo($rsProdutos[$cont]->getIdProduto()) ?>)">
				<img src="../imagens/viewimagem.png" alt="ícone para listar as imagens">
			</span>
			
			<span onClick="status(<?php echo($rsProdutos[$cont]->getStatus()) ?>, <?php echo($rsProdutos[$cont]->getId()) ?>)">
				<?php
                    //resgatando o status
					$status = $rsProdutos[$cont]->getStatus();
					
                    //verificando o status
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