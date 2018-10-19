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
        <title>Análise</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
    </head>
	
	<script>
		var url = '../../';
		
		function listar(){
			$.ajax({
				type: 'POST',
				url: 'dados.php',
				success: function(dados){
					$('#consulta').html(dados);
				}
			});
		}
		
		//função para aprovar um produto
		function aprovar(id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: {id:id, controller: 'avaliação', modo: 'aprovar'}, //parâmetros enviados
				success: function(dados){
					alert(dados);
					listar();
				}
			});
		}
		
		//função que para excluir um produto
		function excluir(id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: {id:id, controller: 'avaliação', modo: 'excluir'}, //parâmetros enviados
				success: function(dados){
					//listagem dos dados
					listar();
				}
			});
		}
		
		//função para visualizar um produto
		function visualizar(id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'visualizar.php', //url onde será enviada a requisição
				data: {id:id}, //parâmetro enviado
				success: function(dados){
					//carregando a modal com os dados
					$('.modal').html(dados);
				}
			});
		}
		
		$(document).ready(function(){
			listar();
			
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
					url: url+'/router.php',
					data: {controller: 'usuario', modo: 'deslogar'},
					success: function(dados){
						window.location.href=url+'index.php';
					}
				});
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

            <div class="painel_usuario">
				<?php
					if($imagem == null){
						echo('<img src="../imagens/user.png">');
					}else{
						echo("<img src='../arquivos/$imagem'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Enquetes</span>

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
                        <?php require_once('../menu.php') ?>
                    </div>
                </div>

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">Produtos em Análise</div>
                    </div>

                    <div id="consulta">
						
						
						
					
					</div>
					
					<div id="visualizar">
						
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