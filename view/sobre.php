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
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
		<header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
		
        <main>
            <div class="linha">
                Sobre Nós
            </div>
            <div class="sobre">
                
                <div class="primeiro_padrao">
					<?php
						$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
						require_once($diretorio.'controller/controllerSobre.php');
						$listSobre = new controllerSobre();
						$rsLayout = $listSobre->listarLayout();
						$rsLayout2 = $listSobre->listarLayout2();
					?>
                    <div class="texto_sobre">
                        <h2> <?php echo($rsLayout->getTitulo()) ?> </h2>
                        
						<?php echo($rsLayout->getDescricao()) ?>

                    </div>
                    <div class="imagem_sobre">
                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsLayout->getImagem()) ?>">
                    </div>
                </div>
                
                <div class="primeiro_padrao">
                    <div class="texto_sobre_esquerdo">
                        <h2> <?php echo($rsLayout2->getTitulo()) ?> </h2>
                        
						<?php echo($rsLayout2->getDescricao()) ?>

                    </div>
                    <div class="imagem_sobre_centro">
                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsLayout2->getImagem()) ?>">
                    </div>
                    <div class="texto_sobre_diteiro">
                        
						<?php echo($rsLayout2->getDescricao2()) ?>

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