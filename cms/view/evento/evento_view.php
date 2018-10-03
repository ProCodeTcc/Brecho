<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
    </head>
	
	<script>
		function Adicionar(){
			$.ajax({
				type: 'POST',
				url: 'evento_view.php',
				success: function(dados){
					$('.container_modal').fadeIn(400);
				}
			});
		}
		
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: 'frm_evento.php',
				success: function(dados){
					$('.modal').html(dados);
				}
			});
		});
	</script>
	
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

            <div class="user_info">
                <span class="user_data"><?php echo($usuario) ?></span>
                <span class="user_data">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Eventos</span>

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
						
						<a class="paginas_link" href="../enquete/enquete_view.php">
                            Enquetes
                        </a>
                    </div>
                </div>

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">Pergunta</div>
                        <div class="users_view_itens">Tema</div>
                        <div class="users_view_itens">Término</div>
                        <div class="users_view_itens">Ações</div>
                    </div>

                    <div id="consulta">

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