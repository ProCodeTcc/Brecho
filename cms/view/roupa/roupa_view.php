<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
	if(isset($_SESSION['imagem'])){
		$imagem = $_SESSION['imagem'];
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Produtos</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		
		<script>
			var url = '../../';
			$(document).ready(function(){
				$('#adicionar').click(function(){
					$('.container_modal').fadeIn(400);
					
					$.ajax({
						type: 'POST',
						url: 'frm_roupa.php',
						success: function(dados){
							$('.modal').html(dados);
						}
					});
				});
				
				$('#logout').click(function(){
					$.ajax({
						type: 'POST',
						url: url+'/router.php',
						data: {controller: 'usuario', modo: 'deslogar'},
						success: function(dados){
							window.location.href=url+'index.php';
						}
					});
				});
			});
		</script>
    </head>

    <body>
        <div class="container_modal">
            <div class="modal">
                
            </div>
        </div>

        <header>
            <div class="logo">
                <a href="../home.php">
                    <img src="../imagens/logoBrecho3.png">
                </a>
            </div>

            <div class="painel_usuario">
				<?php
					if($imagem == null){
						echo('<img src="../imagens/user.png">');
					}else{
						echo("<img src='{$imagem}'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Produtos</span>

            <div class="page_search_container">
                <input type="text" class="page_search">
            </div>

            <button class="page_btn" onclick="Adicionar();" id="adicionar" data-modo="novo">
                Adicionar
            </button>
        </div>

        <div class="content">
            <div class="container">
                <div class="dashboard">
                    <div class="dashboard_title_container">
                        <span class="page_title">Dashboard</span>
                    </div>

                    <div class="pages">
                        <a class="paginas_link" href="../usuario/usuario_view.php">
                            Usuários
                        </a>

                        <a class="paginas_link" href="../nivel/nivel_view.php">
                            Níveis
                        </a>
                    </div>
                </div>

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">Produtos do Brechó</div>
                    </div>

                    <div id="consulta">
						
						
						<div class="produtos_linha">
							<div class="produtos">
								<div class="produtos_imagem">
								
								</div>
								
								<article>
									<p class="produtos_titulo">nome</p>
									<p class="produtos_titulo">preço</p>
								</article>
								
								<div class="acoes">
									<img src="../imagens/delete16.png">
									<img src="../imagens/pencil.png">
									<img src="../imagens/ativar.png">
								</div>
							</div>
						
						</div>
						
						
                    </div>
                </div>

            </div>

            <div class="next_itens">
                <div class="next_itens_btn" id="pages">
                    1
                </div>

                <div class="next_itens_btn" id="pages">
                    2
                </div>
                
                <div class="next_itens_btn" id="pages">
                    3
                </div>
            </div>
        </div>

        <footer>
            brechó bernadete©
        </footer>
    </body>
</html>