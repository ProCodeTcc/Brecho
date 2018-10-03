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
        <title>Sobre</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
    </head>
	
	<script>
		var url = '../../';
		function adicionar(){
			$.ajax({
				type: 'POST',
				url: 'layouts.php',
				success: function(dados){
					$('.modal').html(dados);
				}
			});
		}
		
		function listarLayout1(){
			$.ajax({
				type: 'POST',
				url: 'dados_layout1.php',
				success: function(dados){
					$('#consulta_layout1').html(dados);
				}
			});
		}
		
		$(document).ready(function(){
			$('#adicionar').click(function(){
				$('.container_modal').fadeIn(400);
			});
			
			$('#showLayout1').click(function(){
				$('#dados').hide();
				$('#dados_layout1').show();
				listarLayout1();
			});
			
			$('#voltar').click(function(){
				$('#dados_layout1').hide();
				$('#dados').show();
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
						echo("<img src='{$imagem}'>");
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

            <button class="page_btn" onclick="adicionar();" id="adicionar" data-modo="novo">
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

                <div class="users_view" id="dados">
                    <div class="users_view_title">
                        <div class="users_view_itens">Layouts ativos</div>
						<div class="users_view_itens" id="showLayout1">L1</div>
                    </div>

                    <div id="consulta">
						
						
						<div class="sobre_linha">
							<div class="sobre">
								<div class="sobre_imagem">
									<img src="../imagens/enquete.png">
								</div>
								
								<article>
									<p class="sobre_titulo">bla bla bla</p>
									<p class="sobre_descricao">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
								</article>
								
								<div class="acoes">
									<img src="../imagens/visualizar.png">
									<img src="../imagens/ativar.png">
									<img src="../imagens/delete16.png">
								</div>
							</div>
							
							<div class="sobre">
								<div class="sobre_imagem">
									<img src="../imagens/enquete.png">
								</div>
								
								<article>
									<p class="sobre_titulo">bla bla bla</p>
									<p class="sobre_descricao">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI</p>
								</article>
								
								<div class="acoes">
									<img src="../imagens/visualizar.png">
									<img src="../imagens/ativar.png">
									<img src="../imagens/delete16.png">
								</div>
							</div>
						
						</div>
						
						<div class="quebrar_linha"></div>
						
						
                    </div>
                </div>
				
				<div class="users_view" id="dados_layout1">
                    <div class="users_view_title">
                        <div class="users_view_itens">Layout 1</div>
						<div class="users_view_itens" id="voltar">Voltar</div>
                    </div>

                    <div id="consulta_layout1">
						
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