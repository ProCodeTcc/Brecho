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
        <title>Promoção</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		
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
			
			//função para adicionar um percentual de desconto
			function cadastrarPromocao(idItem){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: 'frm_promocao.php', //url onde será enviada a requisição
					data: {id:idItem}, //parâmetros enviados
					success: function(dados){
						//colocando os dados na modal
						$('.modal').html(dados);
					}
				});
			}
			
			//função para atualizar o status de uma promoção
			function status(status, id){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {status:status, id:id, modo: 'status', controller: 'promoção'}, //parâmetros enviados
					success: function(dados){
						//lista os dados em caso de sucesso
						listar();
					}
				});
			}
			
			//função que exclui uma promoção
			function excluir(id){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {id:id, modo: 'excluir', controller: 'promoção'}, //parâmetros enviados
					success: function(dados){
						//mensagem de sucesso
						alert(dados);
						
						//listagem dos dados atualizados
						listar();
					}
				});
			}
			
			$(document).ready(function(){
				listar()
			});
		</script>
		
    </head>

    <body>
        <div class="container_modal">
            <div class="modal" id="modal_roupa">
                
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
            <span class="page_title">Promoção</span>

            <div class="page_search_container">
                <input type="text" class="page_search">
            </div>
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