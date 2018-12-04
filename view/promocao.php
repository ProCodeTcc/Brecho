<?php
	require_once('arquivos/check_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
		
		<script>
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
			});
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
		<header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
		
        <main>
                <div class="linha">
                    Promoções
                </div>
                
                <div class="caixa_promocao">
                    <?php
                        //armazenando o diretório numa variável
						$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                    
                        //inclusão da controller
						require_once($diretorio.'controller/controllerPromocao.php');
                    
                        //instância da controller
						$listPromocao = new controllerPromocao();
                    
                        //armazenando os dados da promoção
						$rsPromocao = $listPromocao->listarPromocao();
					
                        //contador
						$cont = 0;
                    
                        //percorrendo os dados
						while($cont < count($rsPromocao)){
					?>
					
					<a href="visualizar_produto.php?id=<?php echo($rsPromocao[$cont]->getIdProduto()) ?>&pagina=promoção" onclick="atualizarClique(this, event, <?php echo($rsPromocao[$cont]->getIdProduto()) ?>)">
                        <div class="produto_promocao">
                            <div class="imagem_produto_promocao">
                                <div class="icone_promocao">
                                    <?php echo($rsPromocao[$cont]->getDesconto().'%') ?>
                                </div>
                                <img alt="#"  src="../cms/view/arquivos/<?php echo($rsPromocao[$cont]->getImagem()) ?>">
                            </div>
                            <div class="descritivo_produto_promocao">
                                <div class="titulo_produto_promocao">
                                    <?php echo($rsPromocao[$cont]->getNome()) ?>
                                </div>
                                <div class="preco_promocao">
                                    <del>De: R$ <?php echo($rsPromocao[$cont]->getPreco()) ?></del>
                                </div>
                                 <div class="preco_promocao">
                                    Por: R$ <?php echo($rsPromocao[$cont]->getTotalDesconto()) ?>
                                </div>
                                <div class="opcoes_promocao">
<!--                                    <a class="preto" href="visualizar_produto.php">-->
                                        <div class="comprar_produto_promocao">
                                            Conferir
                                        </div>
<!--                                    </a>-->
                                    <div class="carrinho_produto_promocao" onclick="adicionarCarrinho(<?php echo($rsPromocao[$cont]->getIdProduto()) ?>, event)">
                                        <img alt="#"  src="icones/carrinho.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                    //incrementando o contador
					$cont++;
						}
					?>
                    
                    
                </div>
        </main>
        <?php require_once('arquivos/footer.html') ?>
    </body>
</html>