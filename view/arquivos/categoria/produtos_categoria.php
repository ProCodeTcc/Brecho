<?php
    //iniciando a sessão
    session_start();

    //verificando se exite o tipo do filtro
	if(isset($_POST['tipoFiltro'])){
        //armazena o tipo do filtro numa variável
		$tipoFiltro = $_POST['tipoFiltro'];
        
        //verificando se existe o ID da categria
        if(isset($_POST['id'])){
            //armazenando os dados numa variável
            $idCategoria = $_POST['id'];
        }

        //verificando se existe o filtro
        if(isset($_POST['filtro'])){
            //armazena os dados numa variável
            $filtro = $_POST['filtro'];
        }
        
        //verificando existe o termo
        if(!empty($_POST['termo'])){
            //armazena o termo numa variável
            $pesquisa = $_POST['termo'];
        }else{
            $pesquisa = '';
        }
	}

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
    require_once($diretorio.'controller/controllerProduto.php');
    require_once($diretorio.'controller/controllerCategoria.php');
?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/funcoes.js"></script>
<script>
    $(function(){
       verificarProdutos(); 
    });
</script>

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
			<div class="categoria_linha filtrar" onClick="filtrarClassificacao('A', <?php echo($idCategoria) ?>)">
				A
			</div>
			<div class="categoria_linha filtrar" onClick="filtrarClassificacao('B', <?php echo($idCategoria) ?>)">
				B
			</div>
			<div class="categoria_linha filtrar" onClick="filtrarClassificacao('C', <?php echo($idCategoria) ?>)">
				C
			</div>
            
            <div class="titulo_categoria">
                Preço
            </div>

            <div class="preco_container">
                <input class="preco_min" id="min" type="number" name="txtmin" placeholder="min">
                <input class="preco_max" id="max" type="number" name="txtmax" placeholder="max" onblur="filtrarPreco(<?php echo($idCategoria) ?>)">
            </div>
            
			<div class="titulo_categoria">
				Medidas
			</div>
			<div class="categoria_tamanhos container_tamanho">
				<?php
                    //instância da controller
					$listMedidas = new controllerProduto();
                 
                    //armazenando as medidas uma variável
					$rsMedidas = $listMedidas->listarMedidas();
                 
                    //contador
					$cont = 0;
                 
                    //percorrendo os dados
					while($cont < count($rsMedidas)){
				?>

				<div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>, <?php echo($idCategoria) ?>)">
					<?php echo($rsMedidas[$cont]->getTamanho()) ?>
				</div>
			<?php
                //incrementando o contador
                $cont++;
				} ?>
			</div>

			<div class="titulo_categoria">
				Números
			</div>
			<div class="categoria_tamanhos container_tamanho">
				<?php
                    //instância da controller
					$listNumeros = new controllerProduto();
                
                    //armazenando os números numa variável
					$rsNumeros = $listNumeros->listarNumeros();
                
                    //contador
					$cont = 0;
                
                    //percorrendo os dados
					while($cont < count($rsNumeros)){
				?>

				<div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsNumeros[$cont]->getId()) ?>, <?php echo($idCategoria) ?>)">
					<?php echo($rsNumeros[$cont]->getTamanho()) ?>
				</div>
			<?php 
                //incrementando os dados
                $cont++;
				} ?>
			</div>

			<div class="titulo_categoria">
				Cores
			</div>
			<div class="container_cor">
			<?php
                //instância da controller
				$listCor =  new controllerProduto();
                
                //armazenando as cores numa variável
				$rsCor = $listCor->listarCores();
                
                //incrementando o contador
				$cont = 0;
                
                //percorrendo os dados
				while($cont < count($rsCor)){
			?>
				<div class="cores" style="background-color: <?php echo($rsCor[$cont]->getCor()) ?>;" onclick="filtrarCor(<?php echo($rsCor[$cont]->getId()) ?>, <?php echo($idCategoria) ?>)">
					<span class="nome_cor">
						<?php echo($rsCor[$cont]->getNome()) ?>
					</span>
				</div>                       

			<?php
                //incrementando o contador
			     $cont++;
                }
			?>         
			</div>

			<div class="titulo_categoria">
				Marcas
			</div>

		<?php
            //instância da controller
			$listMarca = new controllerProduto();
            
            //armazenando as marcas numa variável
			$rsMarca = $listMarca->listarMarca();
            
            //contador
			$cont = 0;
            
            //percorrendo os dados
			while($cont < count($rsMarca)){
		?>
			<div class="categoria_linha filtrar" onClick="filtrarMarca(<?php echo($rsMarca[$cont]->getId()) ?>, <?php echo($idCategoria) ?>)">
				<?php
					echo($rsMarca[$cont]->getMarca());
				?>
			</div>
		<?php
        //incrementando o contador
		$cont++;
			}
		?>
		</div>

		<div class="filtro_categoria">
			<?php
                //instância da controller
				$listCategoria = new controllerCategoria();
            
                //verificando o tipo do filtro
				if($tipoFiltro == 'classificacao'){
					$rsFiltro = $listCategoria->listarCategoriaClassificacao($idCategoria, $filtro, $pesquisa, $_SESSION['idioma']);
				}else if($tipoFiltro == 'tamanho'){
					$rsFiltro = $listCategoria->listarCategoriaTamanho($idCategoria, $filtro, $pesquisa, $_SESSION['idioma']);
				}else if($tipoFiltro == 'cor'){
					$rsFiltro = $listCategoria->listarCategoriaCor($idCategoria, $filtro, $pesquisa, $_SESSION['idioma']);
				}else if($tipoFiltro == 'marca'){
					$rsFiltro = $listCategoria->listarCategoriaMarca($idCategoria, $filtro, $pesquisa, $_SESSION['idioma']);
				}else if($tipoFiltro == 'preco'){
                    $min = $_POST['min'];
                    $max = $_POST['max'];
                    $rsFiltro = $listCategoria->listarCategoriaPreco($pesquisa, $min, $max, $idCategoria, $_SESSION['idioma']);
                }

                //contador
				$cont = 0;
                
                //percorrendo os dados
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
                    //incrementando o contador
					$cont++;
					}

				?>
			</a>
	 </div>

	<div class="nenhum_produto">
        <strong>NENHUM RESULTADO ENCONTRADO</strong>
        <p>Encontramos 0 resultado para sua busca</p>

        <strong>Dicas para melhorar sua busca</strong>
        <p>Verifique se não houve erro de digitação.</p>
        <p>Procure por um termo similar ou sinônimo.</p>
        <p>Tente procurar termos mais gerais e filtrar o resultado da busca.</p>
    </div>
    
		<div class="botao_categoria_responsivo"> 
			<img src="icones/categoria.png">
		</div>
  </div>