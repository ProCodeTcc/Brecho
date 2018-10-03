<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
	if(isset($_SESSION['imagem'])){
		//armazenando a imagem na variável de sessão
		$imagem = $_SESSION['imagem'];
		
		//separando a imagem da url relativa, pra não dar conflito de caminhos
		$newImagem = explode('../', $imagem);
		
		//armazenando o caminho separado na variável imagem
		$imagem = $newImagem[1];
	}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Início</title>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
    </head>
	
	<script>
		$(document).ready(function(){
			$('#logout').click(function(){
				$.ajax({
					type: 'POST',
					url: '../router.php',
					data: {controller: 'usuario', modo: 'deslogar'},
					success: function(dados){
						window.location.href='../index.php';
					}
				});
			});
		});
	</script>

    <body>
        <header>
            <div class="logo">
                <img src="imagens/logoBrecho3.png">
            </div>

            <div class="painel_usuario">
				<?php
					if($imagem == null){
						echo('<img src="imagens/user.png">');
					}else{
						echo("<img src='$imagem'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="content">
            <div class="container">
                <div class="dashboard">
                    <div class="dashboard_title_container">
                        <span class="page_title">Dashboard</span>
                    </div>

                    <div class="pages">
                        <a class="paginas_link" href="usuario/usuario_view.php">
                            Usuários
                        </a>

                        <a class="paginas_link" href="nivel/nivel_view.php">
                            Níveis
                        </a>

                        <a class="paginas_link" href="enquete/enquete_view.php">
                            Enquetes
                        </a>
                    </div>
                </div>

                <div class="home_pages">
                    <div class="home_pages_row">
                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/usuario.png">
                            </div>

                            <p class="pages_card_title">Usuários</p>

                            <div class="pages_card_desc">
                                Área responsável pelo gerenciamento dos usuários que fazem uso do CMS
                            </div>
                        </div>

                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/employee.png">
                            </div>

                            <p class="pages_card_title">Níveis</p>

                            <div class="pages_card_desc">
                                Área responsável por todos os níveis de usuário do sistema
                            </div>
                        </div>

                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/enquete.png">
                            </div>

                            <p class="pages_card_title">Enquetes</p>

                            <div class="pages_card_desc">
                                Área responsável por todas as enquetes disponíveis para os clientes
                            </div>
                        </div>
                    </div>
					
					<div class="home_pages_row" style="margin-top: 20px;">
                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/analise.png">
                            </div>

                            <p class="pages_card_title">Análise</p>

                            <div class="pages_card_desc">
                                Área responsável pela aprovação ou não de produtos dos clientes
                            </div>
                        </div>

                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/roupa.png">
                            </div>

                            <p class="pages_card_title">Produtos</p>

                            <div class="pages_card_desc">
                                Área responsável por todos os produtos que são exibidos no site
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <footer>
                brechó bernadete©
            </footer>
    </body>
</html>