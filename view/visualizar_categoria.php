<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
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
                <div class="caixa_categoria">
                    <div class="categoria_pesquisa">
                                <div class="categoria_pesquisa_centro">
                                   <input type="search" class="campo_pesquisa_categoria"> 
                                   <input type="submit" class="botao_pesquisa_categoria" value="Pesquisar"> 
                                </div>
                            </div>
                        <div class="categoria">
                            <div class="titulo_categoria_primeiro">
                                Subcategorias
                            </div>
                            <div class="categoria_linha">
                                Blusa
                            </div>
                            <div class="categoria_linha">
                                Calças
                            </div>
                            <div class="titulo_categoria">
                                Classificação
                            </div>
                            <div class="categoria_linha">
                                A
                            </div>
                            <div class="categoria_linha">
                                B
                            </div>
                            <div class="categoria_linha">
                                C
                            </div>
                            <div class="titulo_categoria">
                                Tamanhos
                            </div>
                            <div class="categoria_tamanhos">
                                
                            </div>
                        </div>
                                            
                        <div class="filtro_categoria">
                            <?php
                                
                                    if(isset($_GET['idCategoria'])){
                                        $id = $_GET['idCategoria'];
                                        
                                        $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                                        require_once($diretorio.'controller/controllerProduto.php');

                                        $listProdutoCategoria = new controllerProduto();
                                        $rsProdutosCategoria = $listProdutoCategoria->listarProdutoCategoria($id);
                                        
                                        $cont = 0;

                                        while($cont < count($rsProdutosCategoria)){
                                ?>
                            
                            <a href="visualizar_produto.php?id=<?php echo($rsProdutosCategoria[$cont]->getId())?>&pagina=categoria">
                                <div class="produto">
                                    <div class="imagem_produto">
                                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsProdutosCategoria[$cont]->getImagem())?>" alt="#">
                                    </div>
                                    <div class="descritivo_produto">
                                        <div class="titulo_produto">
                                            <?php echo($rsProdutosCategoria[$cont]->getNome())?>
                                        </div>
                                        <div class="descricao">
                                            <?php echo($rsProdutosCategoria[$cont]->getDescricao())?>
                                        </div>
                                        <div class="tamanho">
                                           <?php echo($rsProdutosCategoria[$cont]->getTamanho())?>
                                        </div>
                                        <div class="preco">
                                            R$ <?php echo($rsProdutosCategoria[$cont]->getPreco())?>
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
                                    }
                                
                                ?>
                            </a>
                     </div>
                        <div class="botao_categoria_responsivo"> 
                            <img src="icones/categoria.png">
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