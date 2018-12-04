<?php
    require_once('arquivos/check_login.php');
    require_once('arquivos/idioma.php');
    require_once('arquivos/check_carrinho.php');
    
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
	}else{
		$usuario = 'Entrar';
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="view/css/style.css">
        <meta charset="utf-8">
        
        <script src="view/js/jquery.js"> </script>
        <script src="view/js/jquery.cycle.all.js"> </script>
        <script src="view/js/jquery.film_roll.js"></script>
        <script src="view/js/funcoes.js"></script>
        <script src="view/js/jquery.touchSwipe.js"></script>
        <script>
			
			function checarLogin(){
				var login = $('.logout').data('login');
				
				if(login == 1){
					$('.logout').css('display', 'block');                           
                    $('.perfil_usuario').show();
                    
                    if($(window).width() == '980'){
                        $('.entrar').hide('fast');
                    }
                    
				}else{
					$('.logout').css('display', 'none');
                    $('.perfil_usuario').hide('fast');
                    
                    if($(window).width() == '980'){
                        $('.entrar').show();
                    }
				}
			}
			
			function logout(){
				$.ajax({
					type: 'POST',
					url: 'router.php?controller=login&modo=deslogar',
					success: function(dados){
						window.location.href="view/login.php";
					}
				});
			}

            //função para adicionar um item ao carrinho
            function adicionarCarrinho(id){
                //desabilitando o onclick do link
                $('a').attr('onclick', null).off('click');
                
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: 'router.php?controller=produto&modo=adicionarCarrinho', //url onde será enviada a requisição
                    data: {id:id}, //parâmetros enviados
                    success: function(dados){
                        //verifica se o item já existe
                        if(dados == 'existe'){
                            //se existir, manda uma mensagem de erro
                            alert('Esse item já foi adicionado ao carrinho!!');
                        }else{
                            //se não, adiciona o item ao carrinho
                            $('#carrinho').html(dados);
                        }
                    }
                });
            }
            
			$(document).ready(function(){
				checarLogin();
                sliderPrincipal('#slider');
                sliderProduto('#film_row');
                sliderProduto('#produto_clique');
               
                if(verificarMobile() == true){
                     submenuMobile();
                     painelUsuario();
                }

                $('.carrinho').click(function(e){
                    e.preventDefault();
                });
				
				$('.enquete_pesquisa').on('submit', function(e){
					e.preventDefault(); //desativando o submit do formulário
					var qtd = $('input[name=txtenquete]:checked').attr('id'); //resgatando o id do input
					$.ajax({
						type: 'GET', //tipo de requisição
						url: 'router.php', //url onde será enviada a requisição
						data: {controller: 'enquete', modo: qtd}, //parâmetros enviados
						success: function(dados){
                            //conversão dos dados para JSON
							json = JSON.parse(dados);
                            
                            //verificando o status
                            if(json.status == 'sucesso'){
                                //mensagem de sucesso
                                mostrarSucesso('Obrigado pela sua opinião!!');
                            }else{
                                //mensagem de erro
                                mostrarErro('Ocorreu um erro ao enviar a resposta');
                            }
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
        <div class="mensagens">
            <div class="mensagem-sucesso" id="sucesso">
                <div class="msg">
                    
                </div>
    
                <div class="close" onclick="fecharMensagem()">
                    x
                </div>          
            </div>

            <div class="mensagem-erro" id="erro">
                <div class="msg">
                    
                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>

            <div class="mensagem-info" id="info">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>
        </div>
        
        <header>
            <div class="menu_paginas">
                <div class="menu_paginas_site">
                    <a href="view/fale_conosco.php" class="link_paginas"> Fale Conosco </a>
                    <a href="view/nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
                    <a href="view/sobre.php" class="link_paginas"> Sobre </a>
                
                    <div class="idioma_container">
                       <form method="POST" action="index.php?lang=ptbr">
                            <label for="ptbr">
                                <img src="view/icones/brazil24.png" alt="idioma português">
                            </label>
                           
                            <input type="submit" id="ptbr">
                        </form>
                        
                        <form method="POST" action="index.php?lang=en">
                            <label for="en">
                                <img src="view/icones/usa24.png" alt="idioma inglês">
                            </label>

                            <input type="submit" id="en">
                        </form>
                    </div>
                    
                    <div class="pesquisa_cabecalho">
                        <form name="search" method="POST" action="view/pesquisa.php">
                            <input class="campo_pesquisa_cabecalho" id="pesquisa" name="txtpesquisa" type="text">
                        </form>
                        
                        <div class="pesquisa_cabecalho_icone">
                            <img src="view/icones/pesquisa.png" alt="ícone para pesquisar">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="menu_principal">
                <div class="menu_principal_site">
                    <div class="menu_lado_esquerdo">
                        <div class="menu_responsivo">
                            <img id="menu" src="view/icones/menu_responsivo.png" alt="icone do menu">
                            <div class="submenu_responsivo" id="submenu">
                                <div class="submenu_responsivo_itens">
                                    <div id="categorias">
                                        Categorias
                                    </div>

                                    <div class="menu_responsivo_categorias" id="menu_categoria">
                                        <?php
                                            //inclusão do arquivo da controller
                                            require_once('controller/controllerCategoria.php');
                                        
                                            //instância da controller
                                            $listCategoria = new controllerCategoria();
                                        
                                            //armazenando as categorias numa variável
                                            $rsCategoria = $listCategoria->listarCategoria();
                                        
                                            //contador
                                            $cont = 0;
                                        
                                            //percorrendo os dados
                                            while($cont < count($rsCategoria)){
                                        ?>
                                        <div class="categorias_responsivo_itens categoria_item">
                                            <?php echo($rsCategoria[$cont]->getNome()) ?>

                                            <div class="subcategorias_responsivo subcategorias">

                                            <?php
                                                //inclusão da controller
                                                require_once('controller/controllerCategoria.php');
                                                
                                                //instância da controller
                                                $listSubcategoria = new controllerCategoria();
                                                
                                                //armazenando as subcategorias em uma variável
                                                $rsSubcategoria = $listSubcategoria->listarSubcategoria($rsCategoria[$cont]->getId());
                                                
                                                //contador
                                                $index = 0;
                                                
                                                //percorrendo os dados
                                                while($index < count($rsSubcategoria)){    
                                            ?>
                                                <div class="subcategorias_responsivo_itens">
                                                    <a href="view/visualizar_subcategoria.php?idSubcategoria=<?php echo($rsSubcategoria[$index]->getId()) ?>&mobile=true">
                                                        <?php
                                                            echo($rsSubcategoria[$index]->getNome());
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php
                                                //incrementando o contador
                                                $index++;
                                                }
                                            ?>
                                            </div>
                                        </div>

                                    <?php
                                        //incrementando o contador
                                        $cont++;
                                        }
                                    ?>

                                    </div>
                                </div>

                                <div class="submenu_responsivo_itens">
                                    <a href="view/fale_conosco.php">
                                        Fale Conosco
                                    </a>
                                </div>

                                <div class="submenu_responsivo_itens">
                                    <a href="view/nossas_lojas.php">
                                        Nossas Lojas
                                    </a>
                                </div>

                                <div class="submenu_responsivo_itens">
                                    <a href="view/sobre.php">
                                        Sobre
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="index.php">
                            <div class="logo">
                                <img src="view/imagens/logoBrecho3.png" alt="logo do brechó">
                            </div>
                        </a>
                    </div>
                    
                    <div class="menu_lado_direito">
                        <div class="login_carrinho">
                                <div class="login">
                                    <a  href="view/login.php">
                                    <div class="icone_login">
                                        <img id="login" src="view/icones/login.png" alt="#">
                                    </div>
                                        
                                    <div class="texto_login">
                                        <?php echo($usuario) ?>   
                                    </div>
                                    </a>
                                    <div class="sub_login">
                                        <a href="view/perfil.php">
                                            <div class="texto_perfil perfil_usuario">
                                                Perfil   
                                            </div>
                                        </a>
										
										<div class="texto_perfil logout" data-login="<?php echo($login) ?>" onClick="logout()">
											Logout   
										</div>
                                    </div>
                                </div>
                            <a href="view/carrinho.php">
                                <div class="login">
                                    <div class="bolinha" id="carrinho"><?php echo($qtdItems) ?></div>
                                    <div class="icone_login">
                                        <img src="view/icones/carrinho.png" alt="carrinho de compras">
                                    </div>
                                    <div class="texto_login">
                                        Carrinho   
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="menu_usuario_responsivo" id="painel_usuario">
                            <div class="idiomas">
                                <form method="POST" action="index.php?lang=ptbr">
                                    <label for="ptbr_responsivo">
                                        <img src="view/icones/ptbr.png" alt="idioma em português">
                                    </label>

                                    <input type="submit" id="ptbr_responsivo">
                                </form>

                                <form method="POST" action="index.php?lang=en">
                                    <label for="en_responsivo">
                                        <img src="view/icones/usa.png" alt="idioma em inglês">
                                    </label>

                                    <input type="submit" id="en_responsivo">
                                </form>
                            </div>
                            
                            <div class="menu_usuario_itens entrar">
                                <a href="view/login.php">
                                    Entrar
                                </a>
                            </div>
                            
                            <div class="menu_usuario_itens perfil_usuario">
                                <a href="view/perfil.php">
                                    Perfil
                                </a>
                            </div>
                            
                            <div class="menu_usuario_itens logout">
                                <a href="view/login.php" data-login="<?php echo($login) ?>" onClick="logout()">
                                    Logout
                                </a>
                            </div> 
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="menu_categoria">
                <div class="menu">
                    <?php
                        require_once('controller/controllerCategoria.php');

                        $listCategoria = new controllerCategoria();
                        $rsCategoria = $listCategoria->listarCategoria();
                            
                        $cont = 0;
                            
                        while($cont < count($rsCategoria)){
                    ?>
                    
                    <div class="menu_item">
                        <a href="view/visualizar_categoria.php?idCategoria=<?php echo($rsCategoria[$cont]->getId())?>">
                            <?php echo($rsCategoria[$cont]->getNome())?>
                        </a>

                        <div class="subcategoria_container">
                            <?php
                                $listSubcategoria = new controllerCategoria();
                                $rsSubcategoria = $listSubcategoria->listarSubcategoria($rsCategoria[$cont]->getId());
                                $index = 0;
                                while($index < count($rsSubcategoria)){
                            ?>
                            <div class="subcategoria_item">
                                <a href="view/visualizar_subcategoria.php?idSubcategoria=<?php echo($rsSubcategoria[$index]->getId()) ?>">
                                    <?php echo($rsSubcategoria[$index]->getNome()) ?>
                                </a>
                            </div>

                            <?php
                                $index++;
                            }
                            ?>
                        </div>
                    </div>

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
            <?php
                //inclusão do arquivo da controller
                require_once('controller/controllerSlider.php');
                
                //instância da controller
                $listSlider = new controllerSlider();
                
                //armazenando as imagens numa variável
                $rsSlider = $listSlider->listarSlider();
                
                //contador
                $cont = 0;
                
                //percorrendo os dados
                while($cont < count($rsSlider)){
            ?>
                 <div class="slide" style="background-image: url('cms/view/arquivos/<?php echo($rsSlider[$cont]->getImagem()) ?>')"></div>
                <?php
                //incrementando o contador
                $cont++;
                    }
                ?>
            </div>

            <div class="linha">
                Novidades
            </div>

            <div class="produto_full" id="film_row">
                <?php
                    //armazenando o diretório numa variável
                    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                
                    //inclusão do arquivo da controller
                    require_once($diretorio.'controller/controllerProduto.php');
                
                    //instância da controller
                    $listProduto = new controllerProduto();
                
                    //armazenando os produtos numa variável
                    $rsProdutos = $listProduto->listarProdutos($_SESSION['idioma']);
                    
                    //contador
                    $cont = 0;
                
                    //percorrendo os dados
                    while($cont < count($rsProdutos)){
                ?>
                <div class="caixa_produto">
                        <div class="produto">
                            <a href="view/visualizar_produto.php?id=<?php echo($rsProdutos[$cont]->getId()) ?>" onclick="atualizarClique(this, event, <?php echo($rsProdutos[$cont]->getId()) ?>)">

                            <div class="imagem_produto">
                                <img src="cms/view/arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>" alt="imagem do produto">
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
                                    <div class="carrinho_produto carrinho" onClick="adicionarCarrinho(<?php echo($rsProdutos[$cont]->getId()) ?>)">
                                        <img alt="carrinho de compras" src="view/icones/carrinho.png">
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    
                </div>
                
                <?php
                //incrementando o contador
                $cont++;
                    }
                ?>
            </div>

            <div class="linha">
                Os Mais Vistos
            </div>

            <div class="produto_full" id="produto_clique">
                <?php
                    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                    require_once($diretorio.'controller/controllerProduto.php');
                
                    $listProduto = new controllerProduto();
                    $rsProdutos = $listProduto->listarProdutosClique($_SESSION['idioma']);
                    
                    $cont = 0;
                
                    while($cont < count($rsProdutos)){
                ?>
                <div class="caixa_produto">
                        <div class="produto">
                            <a href="view/visualizar_produto.php?id=<?php echo($rsProdutos[$cont]->getId()) ?>" onclick="atualizarClique(this, event, <?php echo($rsProdutos[$cont]->getId()) ?>)">

                            <div class="imagem_produto">
                                <img src="cms/view/arquivos/<?php echo($rsProdutos[$cont]->getImagem()) ?>" alt="imagem do produto">
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
                                    <div class="carrinho_produto carrinho" onClick="adicionarCarrinho(<?php echo($rsProdutos[$cont]->getId()) ?>)">
                                        <img alt="#" src="view/icones/carrinho.png">
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    
                </div>
                
                <?php
                $cont++;
                    }
                ?>
            </div>

            <div class="linha">
                Participe da Nossa Enquete
            </div>
            
            <div class="enquete_full">
                <div class="caixa_enquete">
                    <?php
                        
                        //armazenando o diretório numa variável
                        $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';

                        //inclusão do arquivo da controller
                        require_once($diretorio.'/controller/controllerEnquete.php');

                        //instância da controller
                        $listar = new controllerEnquete();
                    
                        //armazenando os dados da enquete
                        $rsLista = $listar->selecionarEnquete($_SESSION['idioma']);
                            
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
                        <img src="view/imagens/enquete2.png" alt="imagem da enquete">
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
                        Brechó Bernadete é uma startup criada por duas amigas sócias, Thais e Silvia, que em 2017 enxergaram o potencial em crescimento do mercado de brechós. 
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
                    <p class="app">
                        <a href="view/arquivos/aplicativo.apk" filename="aplicativo" download>    
                            <img src="view/icones/playstore.png" alt="imagem da playstore">
                        </a>
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>