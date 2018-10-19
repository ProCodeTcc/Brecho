<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="view/css/style.css">
        <meta charset="utf-8">
        
        <script src="view/js/jquery.js"> </script>
        <script src="view/js/jquery.cycle.all.js"> </script>
        <script>		
			$(document).ready(function(){
				$(function (){
					$("#slide ul").cycle({
						fx: 'fade',
						speed: 1000,
						timeout: 2000,
						prev: '#previous',
						next: '#next',
					   });
				});
				
				$('.enquete_pesquisa').on('submit', function(e){
					e.preventDefault(); //desativando o submit do formulário
					var qtd = $('input[name=txtenquete]:checked').attr('id'); //resgatando o id do input
					$.ajax({
						type: 'GET', //tipo de requisição
						url: 'router.php', //url onde será enviada a requisição
						data: {controller: 'enquete', modo: qtd}, //parâmetros enviados
						success: function(dados){
							alert(dados); //mensagem de sucesso
						}
					});
				});
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
            <div class="menu_paginas">
                <div class="menu_paginas_site">
                    <a href="view/fale_conosco.php" class="link_paginas"> Fale Conosco </a>
                    <a href="view/nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
                    <a href="view/sobre.php" class="link_paginas"> Sobre </a>
                
                    <div class="pesquisa_cabecalho_icone">
                        
                        <img src="view/icones/pesquisa.png" alt="#">
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
                            <img src="view/icones/menu_responsivo.png">
                        </div>
                        <a href="index.php">
                            <div class="logo">
                                <img src="view/imagens/logoBrecho3.png" alt="#">
                            </div>
                        </a>
                    </div>
                    <div class="menu_lado_direito">
                        <div class="login_carrinho">
                                <div class="login">
                                    <a  href="view/login.php">
                                    <div class="icone_login">
                                        <img src="view/icones/login.png" alt="#">
                                    </div>
                                    <div class="texto_login">
                                        Entrar   
                                    </div>
                                    </a>
                                    <div class="sub_login">
                                        <a href="view/perfil.php">
                                            <div class="texto_perfil">
                                                Perfil   
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <a href="view/carrinho.php">
                                <div class="login">
                                    <div class="icone_login">
                                        <img src="view/icones/carrinho.png" alt="#">
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
                    <?php
                        require_once('controller/controllerProduto.php');
                            
                        $listCategoria = new controllerProduto();
                        $rsCategoria = $listCategoria->listarCategoria();
                            
                        $cont = 0;
                            
                        while($cont < count($rsCategoria)){
                    ?>
                    <a href="view/visualizar_categoria.php?idCategoria=<?php echo($rsCategoria[$cont]->getId())?>">
                        <div class="menu_item">
                            <?php echo($rsCategoria[$cont]->getNome())?>
                        </div>
                    </a>

                    <?php
                        $cont++;
                        }
                    ?>
                    <a href="view/promocao.php">
                        <div class="menu_item">
                            Promoção
                        </div> 
                    </a>
                    <a href="view/eventos.php">
                        <div class="menu_item">
                            Eventos
                        </div> 
                    </a>
                </div>
            </div>
        </header>
        <main>
            <div id="slider" class="slider">
                <a href="#" id="previous">
                    <div class="btn_slide">
                        &laquo;
                    </div>
                </a>
                 <div id="slide" class="slide">
                    <ul>
                        <li> <img class="foto_slide" src="view/imagens/slide1.jpg" alt="#"/></li>
                        <li> <img class="foto_slide" src="view/imagens/slide2.jpg" alt="#"/></li>
                        <li> <img class="foto_slide" src="view/imagens/slide3.jpg" alt="#"/></li>
                    </ul>
                </div>
                
                 <a href="#" id="next">
                    <div class="btn_slide">
                        &raquo;
                    </div>
                </a>
            </div>
            <div class="produto_full">
                <div class="linha">
                    Novidades
                </div>
                
                <div class="caixa_produto">
					<?php
						$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
						require_once($diretorio.'controller/controllerProduto.php');
					
						$listProduto = new controllerProduto();
						$rsProdutos = $listProduto->listarProdutos();
						
						$cont = 0;
					
						while($cont < count($rsProdutos)){
					?>
                        <div class="produto">
                            <a href="view/visualizar_produto.php?id=<?php echo($rsProdutos[$cont]->getId()) ?>&pagina=home">

                            <div class="imagem_produto">
                                <img src="cms/view/arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>" alt="#">
                            </div>
                            <div class="descritivo_produto">
                                <div class="titulo_produto">
                                    <?php echo($rsProdutos[$cont]->getNome()) ?>
                                </div>
                                <div class="descricao">
                                    <?php echo($rsProdutos[$cont]->getDescricao()) ?>
                                </div>
                                <div class="tamanho">
                                   Tamanho: <?php echo($rsProdutos[$cont]->getTamanho()) ?>
                                </div>
                                <div class="preco">
                                    R$ <?php echo($rsProdutos[$cont]->getPreco()) ?>
                                </div>
                                <div class="opcoes">
                                        <div class="comprar_produto">
                                            Conferir
                                        </div>
                                    <div class="carrinho_produto">
                                        <img alt="#" src="view/icones/carrinho.png">
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php
					$cont++;
						}
					?>
                    <!--<a href="view/visualizar_produto.php">
                        <div class="produto">
                            <div class="imagem_produto">
                                <img src="view/imagens/tenis.jpg" alt="#">
                            </div>
                            <div class="descritivo_produto">
                                <div class="titulo_produto">
                                    Tênis Cano Alto Adidas Vs Set Mid Masculino
                                </div>
                                <div class="descricao">
                                    Oferecendo pegada esportiva para compor seus looks urbanos, o Tênis Cano Alto Adidas Vs Set Mid Masculino é a pedida certa para seu street style. Conta com palmilha confortável e cabedal em lona.
                                </div>
                                <div class="tamanho">
                                   Tamanho: [41]
                                </div>
                                <div class="preco">
                                    R$ 249,99
                                </div>
                                <div class="opcoes">
                                        <div class="comprar_produto">
                                            Conferir
                                        </div>
                                    <div class="carrinho_produto">
                                        <img alt="#" src="view/icones/carrinho.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <a href="view/visualizar_produto.php">
                        <div class="produto">
                            <div class="imagem_produto">
                                <img src="view/imagens/jaqueta.jpg" alt="#">
                            </div>
                            <div class="descritivo_produto">
                                <div class="titulo_produto">
                                    Jaqueta de Couro Feminina estilo Biker
                                </div>
                                <div class="descricao">
                                    Peça confeccionada individualmente sob medida, exclusivamente para cada cliente.
    Disponível em couro bovino e em couro pelica (de cabra), em diversas cores.
                                </div>
                                <div class="tamanho">
                                   Tamanho: [M]
                                </div>
                                <div class="preco">
                                    R$ 576,00
                                </div>
                                <div class="opcoes">
                                        <div class="comprar_produto">
                                            Conferir
                                        </div>
                                    <div class="carrinho_produto">
                                        <img src="view/icones/carrinho.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>-->
                </div>
                
                <div class="linha">
                    Participe da Nossa Enquete
                </div>
                
                <div class="enquete_full">
                    <div class="caixa_enquete">
						<?php
                                $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                            
                                require_once($diretorio.'/controller/controllerEnquete.php');
                            
                                $listar = new controllerEnquete();
                                $rsLista = $listar->selecionarEnquete();
                                
                            ?>
                        <form method="POST" class="enquete_pesquisa" name="frmEnquete" id="frmEnquete">
                            <div class="pergunta_enquete">
                                <h1 id="txt_pergunta"> <?php echo($rsLista->pergunta)?> </h1>
                            </div>
                            <div class="resposta_enquete">
                                <div class="resposta">
                                    <label><input class="radio" id="qtdA" name="txtenquete" type="radio" checked value="<?php echo($rsLista->qtdAlternativaA)?>"> <?php echo($rsLista->alternativaA)?> </label>
                                </div>
                                <div class="resposta">
                                    <label><input class="radio" id="qtdB" name="txtenquete" type="radio" value="<?php echo($rsLista->qtdAlternativaB)?>"> <?php echo($rsLista->alternativaB)?></label>
                                </div>
                                <div class="resposta">
                                    <label><input class="radio" id="qtdC" name="txtenquete" type="radio" value="<?php echo($rsLista->qtdAlternativaC)?>"> <?php echo($rsLista->alternativaC)?> </label>
                                </div>
                                <div class="resposta">
                                    <label><input class="radio" id="qtdD" name="txtenquete" type="radio" value="<?php echo($rsLista->qtdAlternativaD)?>"> <?php echo($rsLista->alternativaD)?> </label>
                                </div>
                                
                                <div class="caixa_botao">
                                    <input class="enviar_resposta" type="submit" value="Enviar">
                                </div>
                                
                            </div>
                        </form>
                        <div class="enquete_foto">
                            <img src="view/imagens/enquete2.png" alt="#">
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
        <footer>
            <div class="footer_centro">
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Mais Informações
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="view/fale_conosco.php"> Fale Conosco</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="view/nossas_lojas.php"> Nossas Lojas</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="view/sobre.php"> Sobre</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="view/perfil.php"> Minha Conta</a>
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