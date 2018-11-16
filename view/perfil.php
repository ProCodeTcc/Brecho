<?php
	require_once('arquivos/check_login.php');

	if($_SESSION['login'] != 1){
		header('location: login.php');
	}
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
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
        <div class="mensagens">
            <div class="mensagem-info" id="info">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>

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
        </div>
        
        <header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
		
        <main>
            <div class="perfil_full">
            <div class="linha">
                Perfil
            </div>
            
            <div class="imagem_perfil">
                <img alt="#" src="icones/imagem_perfil.png">
            </div>
            <div class="bem_vindo_perfil">
                Bem Vindo Usuario
            </div>
            
                <div class="perfil">
                    <div class="perfil_esquerdo">
                        <h1 class="titulo_perfil"> Meus Dados </h1>
                        <a href="atualizar_dados.php">
                            <div class="botao_dados">
                                <div class="icone_dados">
                                    <img alt="#" src="icones/atualizar_dados%20.png">
                                </div>
                                <div class="texto_dados">
                                    <h1> Atualizar Dados </h1>
                                </div>
                            </div>
                        </a>
                        <a href="minhas_vendas.php">
                            <div class="botao_dados">
                                <div class="icone_dados">
                                    <img alt="#" src="icones/minhas_vendas.png">
                                </div>
                                <div class="texto_dados">
                                    <h1> Minhas Vendas </h1>
                                </div>
                            </div>
                        </a>
                        <a href="cartao.php">
                            <div class="botao_dados">
                                <div class="icone_dados">
                                    <img alt="#" src="icones/cartao.png">
                                </div>
                                <div class="texto_dados">
                                    <h1> Cartões de Crédito </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                     <div class="perfil_direito">
                         <h1 class="titulo_perfil"> Meus Pedidos </h1>
                         <div class="perfil_tabela">
                             <div class="titulo_perfil_pedidos">
                                 <div class="titulo_perfil_campos">
                                    <h3> N° Pedido </h3>
                                 </div>
                                 <div class="titulo_perfil_campos">
                                    <h3> Valor </h3>
                                 </div>
                                 <div class="titulo_perfil_campos">
                                    <h3> Data De Retirada </h3>
                                 </div>
                             </div>

                              <div class="titulo_perfil_linha">
                                 <div class="titulo_perfil_campos">
                                     12345678
                                 </div>
                                 <div class="titulo_perfil_campos">
                                     R$ 300,00
                                 </div>
                                 <div class="titulo_perfil_campos">
                                     00/00/0000
                                 </div>
                             </div>

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