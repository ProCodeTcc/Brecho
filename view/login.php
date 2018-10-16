<?php
//	if(isset($_POST['txtemail'])){
//		session_start();
//		$_SESSION['email'] = $_POST['txtemail'];
//	}


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="menu_principal_logo">
                <div class="menu_responsivo">
                    <img src="icones/menu_responsivo.png">
                </div>
                <a href="../index.php">
                    <div class="logo_centro">
                        <img src="imagens/logoBrecho3.png" alt="#">
                    </div>
                </a>
            </div>

        </header>
        <main>
            <div class="linha">
                Autenticação
            </div>
            <div class="fundo_login">
                <div class="login_centro">
                    <div class="dados">
                        <div class="titulo_login">
                                Já Sou Cliente
                        </div>
                        <form method="POST" action="../router.php?controller=Login">
                            <div class="caixa_campos">
                                E-mail:
                                <div class="campos">

                                    <input class="campos_login" type="text" name="txtLogin">
                                </div>
                                Senha:
                                <div class="campos">
                                    <input class="campos_login" type="password" name="txtSenha">
                                </div> <div class="campos">
                                <!-- Implementar link para alterar senha do usuário -->
                                <!-- <a href="#">Esqueci Minha Senha</a> -->
                                </div>
                                <div class="campos">
                                    <input class="botao_login" type="submit" value="Acessar Conta">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="divisao">

                    </div>
                    <div class="dados">
                        <div class="titulo_login">
                                Criar Conta
                        </div>
                        <form action="cadastro_usuario.php" method="post">
                            <div class="caixa_campos_direita">
                                E-mail:
                                <div class="campos">

                                    <input class="campos_login" name="txtemail" type="email">
                                </div>
                                <div class="campos">
                                </div>
                                <div class="campos_direita">
                                     <input class="botao_login" type="submit" value="Proximo">
                                </div>
                            </div>
                        </form>
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
