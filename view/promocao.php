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
						$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
						require_once($diretorio.'controller/controllerPromocao.php');
						$listPromocao = new controllerPromocao();
						$rsPromocao = $listPromocao->listarPromocao();
					
						$cont = 0;
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
					$cont++;
						}
					?>
                    
                    
                </div>
        </main>
        <footer>
            <div class="footer_centro">
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Mais Informações
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="fale_conosco.php"> Fale Conosco</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="nossas_lojas.php"> Nossas Lojas</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="sobre.php"> Sobre</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="perfil.php"> Minha Conta</a>
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Sobre o Brechó
                    </div>
                    <div class="linha_rodape">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Contatos
                    </div>
                    <div class="linha_rodape">
                        Endereço: Rua Lauro Linhares, 2123 – 202A
Florianópolis, SC, Brasil
                    </div>
                    <div class="linha_rodape">
                        Fone: (11)4002.8922 / Whatsapp: (11)99999.9999
                    </div>
                    <div class="linha_rodape">
                        E-mail: admin@brecho.com.br
                    </div>
                </div>
                <div class="rodape_final">
                    BERNADET Brechó Online. Todos os Direitos Reservados.
                </div>
            </div>
        </footer>
    </body>
</html>