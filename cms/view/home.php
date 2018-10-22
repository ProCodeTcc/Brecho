<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
	if(isset($_SESSION['imagem'])){
		//armazenando a imagem na variável de sessão
		$imagem = $_SESSION['imagem'];
	}

	if(!isset($_SESSION['usuario'])){
		//se não existir, redireciona o usuário pra página de login
		header("location: ../index.php");
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
			
			//evento no click de um item do menu
			$('.menu .menu_itens').click(function(e){
				//mostrando o submenu somente do item clicado
				$(this).find('.submenu').toggle(400);
				
				//escondendo os submenus dos itens que não forem clicados
				$('.menu_itens').not(this).find('.submenu').hide('fast');
			});
			
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
						echo("<img src='arquivos/$imagem'>");
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
						<ul class="menu">
							<li class="menu_itens">
								<div class="menu_item_container">
									<img src="imagens/admin.png">
									
									<p class="item_titulo">Administração</p>
								</div>
								
								<ul class="submenu">
									<li class="submenu-itens">
										<a class="paginas_link" href="usuario/usuario_view.php">
											Usuários
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="nivel/nivel_view.php">
											Níveis
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="unidade/unidade_view.php">
											Unidades
										</a>
									</li>
								</ul>
							</li>
							
							<li class="menu_itens">
								<div class="menu_item_container">
									<img src="imagens/content.png">
									
									<p class="item_titulo">Conteúdo</p>
								</div>
								
								<ul class="submenu">
									<li class="submenu-itens">
										<a class="paginas_link" href="enquete/enquete_view.php">
											Enquetes
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="sobre/sobre_view.php">
											Sobre nós
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="evento/evento_view.php">
											Eventos
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="slider/slider_view.php">
											Slider
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="fale_conosco/fale_conosco_view.php">
											Fale Conosco
										</a>
									</li>
								</ul>
							</li>
							
							<li class="menu_itens">
								<div class="menu_item_container">
									<img src="imagens/cart.png">
									
									<p class="item_titulo">Produtos</p>
								</div>
								
								<ul class="submenu">
									<li class="submenu-itens">
										<a class="paginas_link" href="avaliacao/avaliacao_view.php">
											Avaliação
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="roupa/roupa_view.php">
											Roupas
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="promocao/promocao_view.php">
											Promoção
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="retirada/retirada_view.php">
											Retiradas
										</a>
									</li>
								</ul>
							</li>
							
							<li class="menu_itens">
								<div class="menu_item_container">
									<img src="imagens/visual.png">
									
									<p class="item_titulo">Visual</p>
								</div>
								
								<ul class="submenu">
									<li class="submenu-itens">
										<a class="paginas_link" href="tema/tema_view.php">
											Temas
										</a>
									</li>
									
									<li class="submenu-itens">
										<a class="paginas_link" href="cor/cor_view.php">
											Cores
										</a>
									</li>
								</ul>
							</li>
						</ul>
                    </div>
                </div>

                <div class="home_pages">
                    <div class="home_pages_row">
                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/admin128.png">
                            </div>

                            <p class="pages_card_title">Administração</p>

                            <div class="pages_card_desc">
                                Área responsável pelo gerenciamento de todos os usuários e níveis que acessam o sistema
                            </div>
                        </div>

                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/content128.png">
                            </div>

                            <p class="pages_card_title">Conteúdo</p>

                            <div class="pages_card_desc">
                                Área responsável por gerenciar o conteúdo de todas as páginas do site
                            </div>
                        </div>

                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/cart128.png">
                            </div>

                            <p class="pages_card_title">Produtos</p>

                            <div class="pages_card_desc">
                                Área responsável por gerenciar tudo que é relacionado aos produtos do site
                            </div>
                        </div>
                    </div>
					
					<div class="home_pages_row" style="margin-top: 20px;">
                        <div class="pages_card">
                            <div class="pages_card_image">
                                <img src="imagens/color-picker128.png">
                            </div>

                            <p class="pages_card_title">Visual</p>

                            <div class="pages_card_desc">
                                Área responsável por gerenciar as cores e temas que são utilizados no site
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