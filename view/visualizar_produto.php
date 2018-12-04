<?php
    require_once('arquivos/check_login.php');

    //verificando se existe o ID
	if(isset($_GET['id'])){
        //resgatando o ID
		$id = $_GET['id'];
        
        //verificando se existe o parâmetro página
		if(isset($_GET['pagina'])){
            //armazenando a página
			$pagina = $_GET['pagina'];
		}else{
            $pagina = '';
        }
	}else{
		header('location: erro.php');
	}

    //armazenando o diretório numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
    
    //inclusão da controller
	require_once($diretorio.'controller/controllerProduto.php');
	require_once($diretorio.'controller/controllerPromocao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/funcoes.js"></script>
		
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
			
            function comprarProduto(id){
                $.ajax({
                   type: 'POST',
                    url: '../router.php?controller=produto&modo=adicionarCarrinho',
                    data: {id:id},
                    success: function(dados){
                        window.location.href="dados_pagamento.php";
                    }
                });
            }
            
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
		<div class="container_modal">
			<div class="modal">
			
			</div>
		</div>
        
		<header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
		
        <main>
            <div class="visualizar_produto">
				<?php
                    //instÂncia da controller
					$listImagens = new controllerProduto();
                
                    //listando as imagens
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
                    //verificando as páginas
                    if($pagina == 'promoção'){
                        //instãncia da controller
                        $listProduto = new controllerPromocao();
                        
                        //armazenando os dados numa variável
						$rsProduto = $listProduto->buscarProduto($id);
                    }else{
                        //instância da controller
                        $listProduto = new controllerProduto();
                        
                        //armazenando os dados numa variável
						$rsProduto = $listProduto->buscarProduto($id, $_SESSION['idioma']);
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
                        <input class="botao_compra" type="button" value="Carrinho" onclick="adicionarCarrinho(<?php echo($rsProduto->getId()) ?>, event)">
                        <input class="botao_compra" type="submit" value="Comprar" onclick="comprarProduto(<?php echo($rsProduto->getId()) ?>)">
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
				<?php
                    //instância da controller
					$listProduto = new controllerProduto();
                           
                    //armazenando os dados numa variável
					$rsProdutos = $listProduto->listarAleatorio($_SESSION['idioma']);
                           
                    //contador
					$cont = 0;
                           
                    //percorrendo os dados
					while($cont < count($rsProdutos)){
				?>
               <a href="visualizar_produto.php?id=<?php echo($rsProdutos[$cont]->getId()) ?>">
                    <div class="produto_veja">
                        <div class="imagem_produto">
                            <img alt="#" src="../cms/view/arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>">
                        </div>
                        <div class="descritivo_produto">
                            <div class="titulo_produto">
                                <?php echo($rsProdutos[$cont]->getNome()) ?>
                            </div>
                            <div class="preco">
                                R$ <?php echo($rsProdutos[$cont]->getPreco()) ?>
                            </div>
                            <div class="opcoes">
                                <div class="comprar_produto">
                                    Conferir
                                </div>
                            <div class="carrinho_produto carrinho" onClick="adicionarCarrinho(<?php echo($rsProdutos[$cont]->getId()) ?>)">
                                <img alt="#" src="icones/carrinho.png">
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