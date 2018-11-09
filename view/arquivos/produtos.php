<?php
	if(isset($_POST['tipoFiltro'])){
		$tipoFiltro = $_POST['tipoFiltro'];
		$filtro = $_POST['filtro'];
		$pesquisa = $_POST['termo'];
	}

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerProduto.php');
?>

<div class="caixa_categoria">
	<div class="categoria_pesquisa">
				<div class="categoria_pesquisa_centro">
				   <input type="search" class="campo_pesquisa_categoria"> 
				   <input type="submit" class="botao_pesquisa_categoria" value="Pesquisar"> 
				</div>
			</div>
		<div class="categoria">
			<div class="titulo_categoria_primeiro">
				Classificação
			</div>
			<div class="categoria_linha filtrar" onClick="filtrarClassificacao('A')">
				A
			</div>
			<div class="categoria_linha filtrar" onClick="filtrarClassificacao('B')">
				B
			</div>
			<div class="categoria_linha filtrar" onClick="filtrarClassificacao('C')">
				C
			</div>
			<div class="titulo_categoria">
				Medidas
			</div>
			<div class="categoria_tamanhos container_tamanho">
				<?php
					$listMedidas = new controllerProduto();
					$rsMedidas = $listMedidas->listarMedidas();
					$cont = 0;
					while($cont < count($rsMedidas)){
				?>

				<div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>)">
					<?php echo($rsMedidas[$cont]->getTamanho()) ?>
				</div>
			<?php $cont++;
				} ?>
			</div>

			<div class="titulo_categoria">
				Números
			</div>
			<div class="categoria_tamanhos container_tamanho">
				<?php
					$listNumeros = new controllerProduto();
					$rsNumeros = $listNumeros->listarNumeros();
					$cont = 0;
					while($cont < count($rsNumeros)){
				?>

				<div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsNumeros[$cont]->getId()) ?>)">
					<?php echo($rsNumeros[$cont]->getTamanho()) ?>
				</div>
			<?php $cont++;
				} ?>
			</div>
		</div>

		<div class="filtro_categoria">
			<?php
				$listProdutoCategoria = new controllerProduto();

				if($tipoFiltro == 'classificacao'){
					$rsFiltro = $listProdutoCategoria->listarProdutoClassificacao($filtro, $pesquisa);
				}else if($tipoFiltro == 'tamanho'){
					$rsFiltro = $listProdutoCategoria->listarProdutoTamanho($filtro, $pesquisa);
				}


				$cont = 0;

				while($cont < count($rsFiltro)){
				?>

			<a href="visualizar_produto.php?id=<?php echo($rsFiltro[$cont]->getId())?>&pagina=categoria">
				<div class="produto">
					<div class="imagem_produto">
						<img  alt="#" src="../cms/view/arquivos/<?php echo($rsFiltro[$cont]->getImagem())?>" alt="#">
					</div>
					<div class="descritivo_produto">
						<div class="titulo_produto">
							<?php echo($rsFiltro[$cont]->getNome())?>
						</div>
						<div class="descricao">
							<?php echo($rsFiltro[$cont]->getDescricao())?>
						</div>
						<div class="tamanho">
						   <?php echo($rsFiltro[$cont]->getTamanho())?>
						</div>
						<div class="preco">
							R$ <?php echo($rsFiltro[$cont]->getPreco())?>
						</div>
						<div class="opcoes">
							<div class="comprar_produto">
								Conferir
							</div>
							<div class="carrinho_produto">
								<img  alt="#" src="icones/carrinho.png">
							</div>
						</div>
					</div>
				</div>

				<?php
					$cont++;
					}

				?>
			</a>
	 </div>

	<div id="resultado">

	</div>
		<div class="botao_categoria_responsivo"> 
			<img src="icones/categoria.png">
		</div>
  </div>