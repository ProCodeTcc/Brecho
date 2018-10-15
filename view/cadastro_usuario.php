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

                        <img alt="#"  src="icones/pesquisa.png">
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
                                <img alt="#"  src="imagens/logoBrecho3.png">
                            </div>
                        </a>
                    </div>
                    <div class="menu_lado_direito">
                        <div class="login_carrinho">

                                <div class="login">
                                    <a  href="login.php">
                                        <div class="icone_login">
                                            <img alt="#"  src="icones/login.png">
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
                                        <img alt="#"  src="icones/carrinho.png">
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
                    Cadastro De Usuário
                </div>

                <div class="caixa_cadastro_usuario">
                    <div class="cadastro_usuario">
                        <form method="POST" action="../router.php?controller=ClienteFisico">
                            <div class="titulo_cadastro_usuario_meio">
                                Nome*
                            </div>
                            <div class="titulo_cadastro_usuario_meio">
                                Sobrenome*
                             </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txtNome" required onkeypress="return validar(event,'number')">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txtSobrenome" required onkeypress="return validar(event,'number')">
                            </div>

                            <div class="titulo_cadastro_usuario">
                                E-mail*
                            </div>
                            <div class="linha_cadastro_usuario">
                                <input class="campo_cadastro_usuario" type="email" name="txtEmail" required>
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Usuario*
                            </div>
                            <div class="titulo_cadastro_usuario_meio">
                                Senha*
                            </div>
                            
                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txtUsuario" required>
                            </div>
                            
                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="password" name="txtSenha" required>
                            </div>
                            <div class="titulo_cadastro_usuario_meio">
                                Data de Nascimento*
                            </div>
                            
                            <div class="titulo_cadastro_usuario_meio">
                                CPF*
                            </div>
                            
                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="date" name="txtDataNasc" required>
                            </div>
                            <div class="linha_cadastro_usuario_meio">
                                <input id="txt_cpf" class="campo_cadastro_usuario_meio" type="text" name="txtCpf"required onkeypress="return validar(event,'caracter')">
                                <script type="text/javascript">$("#txt_cpf").mask("000.000.000-00");</script>
                            </div>


                            <div class="titulo_cadastro_usuario_meio">
                                Telefone*
                            </div>
                             <div class="titulo_cadastro_usuario_meio">
                                Celular
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input id="txt_telefone" class="campo_cadastro_usuario_meio" type="text" name="txtTelefone"required onkeypress="return validar(event,'caracter')">
                                <script type="text/javascript">$("#txt_telefone").mask("(00) 0000-0000");</script>
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input id="txt_celular" class="campo_cadastro_usuario_meio" type="text" name="txtCelular"onkeypress="return validar(event,'caracter')">
                                <script type="text/javascript">$("#txt_celular").mask("(00) 00000-0000");</script>
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Sexo*
                             </div>


                            <div class="linha_cadastro_usuario">
                                <label>
                                    <input type="radio" class="radio_sexo" name="rb_sexo" checked value="M"> Masculino
                                </label>

                                <label>
                                    <input type="radio" class="radio_sexo" name="rb_sexo" value="F"> Feminino
                                </label>

                            </div>


                            <div class="titulo_cadastro_usuario_meio">
                                CEP*
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Tipo de Endereço*
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input id="txt_cep" class="campo_cadastro_usuario_meio" type="text" onkeypress="return validar(event,'caracter')" name="txtCep">
                                <script type="text/javascript">$("#txt_cep").mask("00000-000");</script>
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <select class="campo_cadastro_usuario_meio" name="txtTipo">
                                    <option value="0">Rua</option>
                                    <option value="1">Avenida</option>
                                    <option value="2">Praça</option>
                                    <option value="3">Viela</option>
                                </select>
                            </div>


                            <div class="titulo_cadastro_usuario">
                                Logradouro*
                            </div>

                            <div class="linha_cadastro_usuario">
                                <input class="campo_cadastro_usuario" type="text" name="txtLogradouro">
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Estado*
                             </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Cidade*
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="text" name="txtEstado">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio"  type="text" name="txtCidade">
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Nº*
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Complemento
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="text" name="txtNumero">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="text" name="txtComplemento">
                            </div>

                            <div class="linha_cadastro_usuario_botao">
                                    <input class="botao_cadastro" type="submit" value="Cadastrar">
                            </div>
                        </form>
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
