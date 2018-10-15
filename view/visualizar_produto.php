<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$pagina = $_GET['pagina'];
	}else{
		header('location: erro.php');
	}

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerProduto.php');
	require_once($diretorio.'controller/controllerPromocao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery.js"></script>
		
		<script>
			function visualizarImagem(imagem){
				$('.container_modal').fadeIn(400);
				
				$.ajax({
					type: 'POST',
					url: 'modal.php',
					data: {imagem:imagem},
					success: function(dados){
						$('.modal').html(dados);
					}
				});
			}
		</script>
		
    </head>
    <body>
		<div class="container_modal">
			<div class="modal">
			
			</div>
		</div>
        <header>
            <div class="menu_paginas">
                <div class="menu_paginas_site">
                    <a href="fale_conosco.php" class="link_paginas"> Fale Conosco </a>
                    <a href="nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
                    <a href="sobre.php" class="link_paginas"> Sobre </a>
                
                    <div class="pesquisa_cabecalho_icone">
                        
                        <img alt="#" src="icones/pesquisa.png">
                    </div>
                    
                <div class="pesquisa_cabecalho">
                    <input class="campo_pesquisa_cabecalho" type="text">
                </div>
                </div>
            </div>
            
            <div class="menu_principal">
                <div class="menu_principal_site">
                    <div class="menu_lado_esquerdo">
                        <div class="menu_responsivo">
                        
                        </div>
                        <a href="../index.php">
                            <div class="logo">
                                <img alt="#" src="imagens/logoBrecho3.png">
                            </div>
                        </a>
                    </div>
                    <div class="menu_lado_direito">
                        <div class="login_carrinho">
                                <div class="login">
                                    <a  href="login.php">
                                        <div class="icone_login">
                                            <img alt="#" src="icones/login.png">
                                        </div>
                                        <div class="texto_login">
                                            Entrar   
                                        </div>
                                    </a>
                                    <div class="sub_login">
                                        <a href="perfil.php">
                                            <div class="texto_perfil">
                                                Perfil   
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <a href="carrinho.php">
                                <div class="login">
                                    <div class="icone_login">
                                        <img alt="#" src="icones/carrinho.png">
                                    </div>
                                    <div class="texto_login">
                                        Carrinho   
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="menu_categoria">
                <div class="menu">
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Comum
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Alfaiataria
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Banho
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Pijamas
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Social
                        </div>
                    </a>
                    <a href="promocao.php">
                        <div class="menu_item">
                            Promoção
                        </div> 
                    </a>
                    <a href="eventos.php">
                        <div class="menu_item">
                            Eventos
                        </div> 
                    </a>
                    
                </div>
            </div>
        </header>
        <main>
            <div class="visualizar_produto">
				<?php
					$listImagens = new controllerProduto();
					$rsImagens = $listImagens->listarImagens($id);
				
				?>
                <div class="produto_imagens">
                    <div class="caixa_mini_imagens">
                        <div class="mini_imagens" onclick="visualizarImagem('<?php echo($rsImagens[0]->getImagem()) ?>')">
                            <img alt="#" src="../cms/view/arquivos/<?php echo($rsImagens[0]->getImagem()) ?>">
                        </div>
                        <div class="mini_imagens" onclick="visualizarImagem('<?php echo($rsImagens[1]->getImagem()) ?>')">
                            <img alt="#" src="../cms/view/arquivos/<?php echo($rsImagens[1]->getImagem()) ?>">
                        </div>
                    </div>
                    <div class="visualizar_produto_imagem" onclick="visualizarImagem('<?php echo($rsImagens[2]->getImagem()) ?>')">
                        <img alt="#" src="../cms/view/arquivos/<?php echo($rsImagens[2]->getImagem()) ?>">
                    </div>
                </div>
				
				<?php
					if($pagina == 'home'){
						$listProduto = new controllerProduto();
						$rsProduto = $listProduto->buscarProduto($id);
					}else if($pagina == 'promoção'){
						$listProduto = new controllerPromocao();
						$rsProduto = $listProduto->buscarProduto($id);
					}
				?>
				
                <div class="visualizar_produto_detalhes">
                    <div class="produto_detalhes_titulo">
                       <b> <?php echo($rsProduto->getNome()) ?></b>
                    </div>
                    <div class="produto_detalhes_linha">
                       Preço: R$ <?php echo($rsProduto->getPreco()) ?>
                    </div>
                    <div class="produto_detalhes_linha">
                       Cor: <?php echo($rsProduto->getCor()) ?>
                    </div>
                    <div class="produto_detalhes_linha">
                       Tamanho: <?php echo($rsProduto->getTamanho()) ?>
                    </div>
                    
                    <div class="produto_escondido">
                      
                        
                    </div>
                    <div class="produto_detalhes_botao">
                            <input class="botao_compra" type="submit" value="Carrinho">
                        <form action="dados_pagamento.php">
                            <input class="botao_compra" type="submit" value="Comprar">
                        </form> 
                    </div>
                </div>
                
            </div>
            <div class="produto_descricao">
                <div class="caixa_titulo_linha">
                    <h2>Descrição</h2>
                </div>
                   <?php echo($rsProduto->getDescricao())?>
                
            </div>
            <div class="linha">
                Veja Também
            </div>
            <div class="veja_tambem">
               <a href="visualizar_produto.php">
                    <div class="produto_veja">
                        <div class="imagem_produto">
                            <img alt="#" src="imagens/tenis.jpg">
                        </div>
                        <div class="descritivo_produto">
                            <div class="titulo_produto">
                                Tênis Cano Alto Adidas Vs Set Mid Masculino
                            </div>
                            <div class="preco">
                                R$ 249,99
                            </div>
                            <div class="opcoes">
                                <div class="comprar_produto">
                                    Conferir
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </a>
                <a href="visualizar_produto.php">
                    <div class="produto_veja">
                        <div class="imagem_produto">
                            <img alt="#" src="imagens/tenis.jpg">
                        </div>
                        <div class="descritivo_produto">
                            <div class="titulo_produto">
                                Tênis Cano Alto Adidas Vs Set Mid Masculino
                            </div>
                            <div class="preco">
                                R$ 249,99
                            </div>
                            <div class="opcoes">
                                <div class="comprar_produto">
                                    Conferir
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </a>
                <a href="visualizar_produto.php">
                    <div class="produto_veja">
                        <div class="imagem_produto">
                            <img alt="#" src="imagens/tenis.jpg">
                        </div>
                        <div class="descritivo_produto">
                            <div class="titulo_produto">
                                Tênis Cano Alto Adidas Vs Set Mid Masculino
                            </div>
                            <div class="preco">
                                R$ 249,99
                            </div>
                            <div class="opcoes">
                                <div class="comprar_produto">
                                    Conferir
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </a>
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