<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.mask.js"></script>
        
        <script type="text/javascript">
            
            function validar (caracter,blockType){
                if(window.event){
                    var letra = caracter.charCode;
                }else{
                    var letra = caracter.which;
                }
                
                if (blockType == 'caracter'){
                    if(letra<48 || letra>57){
                        if(letra !=8 && letra!=32){
                            alert('Você não pode digitar letras neste campo');
                            return false;
                        }
                    }
                }else if(blockType == 'number'){
                    if(letra >=48 && letra<=57){
                        alert('Você não pode digitar numeros neste campo');
                        return false;
                    }
                }
            }
 
        </script>
    </head>
    <body>
        <header>
            <div class="menu_paginas">
                <div class="menu_paginas_site">
                    <a href="fale_conosco.php" class="link_paginas"> Fale Conosco </a>
                    <a href="nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
                    <a href="sobre.php" class="link_paginas"> Sobre </a>

                    <div class="pesquisa_cabecalho_icone">

                        <img src="icones/pesquisa.png" alt="#">
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
                                <img src="imagens/logoBrecho3.png" alt="#">
                            </div>
                        </a>
                    </div>
                    <div class="menu_lado_direito">
                        <div class="login_carrinho">
                                <div class="login">
                                    <a  href="login.php">
                                        <div class="icone_login">
                                            <img src="icones/login.png" alt="#">
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
                                        <img src="icones/carrinho.png" alt="#">
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
            <div class="linha">
                Fale Conosco
            </div>
            <div class="fale_conosco">
                <div class="imagem_fale">
                    <img src="imagens/jaqueta.jpg" alt="#">
                </div>
                <form method="POST" class="caixa_fale" name="frmFaleConosco" id="frmFaleConosco" action="../router.php?controller=FaleConosco">
                    <div class="titulo_fale">
                        Nome*
                    </div>

                    <div class="campos_fale">
                        <input type="text" class="caixas_campo_fale" name="txtnome" required onkeypress="return validar(event,'number')">
                    </div>

                    <div class="titulo_fale" >
                        E-mail*
                    </div>

                    <div class="campos_fale">
                        <input type="email" class="caixas_campo_fale" name="txtemail" required>
                    </div>

                    <div class="titulo_fale" >
                        Telefone*
                    </div>

                    <div class="campos_fale">
                        <input id="txt_telefone" type="text" class="caixas_campo_fale" name="txttelefone" required onkeypress="return validar(event,'caracter')" maxlength="12" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}">
                        <script type="text/javascript">$("#txt_telefone").mask("(00) 0000-0000");</script>
                    </div>

                    <div class="titulo_fale_radio" >
                        Sexo*

                        <label><input type="radio" name="radio_sexo_fale" class="caixas_radio_fale" value="M" checked > Masculino</label>
                        <label><input type="radio" name="radio_sexo_fale" class="caixas_radio_fale" value="F"> Feminino</label>

                    </div>

                    <div class="titulo_fale" >
                        Opção de Comentario*
                    </div>

                    <div class="campos_fale">
                        <select class="caixas_campo_fale" name="txtassunto" required >
                            <option value="0" selected="selected" disabled="disabled">Escolha uma opção</option>
                            <option value="Sugestão">
                                Sugestão
                            </option>
                            <option value="Crítica">
                                Crítica
                            </option>
                        </select>
                    </div>

                    <div class="titulo_fale" >
                        Comentario*
                    </div>

                    <div class="campos_text_fale">
                        <textarea class="caixas_text_fale" name="txtcomentario" required></textarea>
                    </div>
                    <div class="campos_fale_botao">
                        <input type="submit" value="Enviar" class="botao_enviar_fale">
                    </div>
                </form>
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
