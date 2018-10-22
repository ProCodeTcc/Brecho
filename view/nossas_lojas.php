<?php
	require_once('arquivos/check_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
		
		<script>
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
			});
		</script>
    </head>
    <body>
        <header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
        <main>
            <div class="linha">
                Nossas Lojas
            </div>
            <div class="nossas_lojas">
                <div class="pesquisa_loja">
                    <div class="titulo_loja">
                        Encontre as lojas mais próximas
                    </div>
                    <div class="campos_loja">
                        <select class="select_uf_lojas">
                            <option>SP</option>
                        </select>
                        <select class="select_cidade_lojas">
                            <option>BARUERI</option>
                        </select>
                    </div>
                    <div class="resultado_loja">
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                        <div class="linha_loja">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
                    </div>
                </div>
                <div class="mapa_loja">
                    <img alt="#" src="imagens/mapa.PNG">
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
