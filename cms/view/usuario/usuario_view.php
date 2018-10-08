<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 1;
	if(isset($_SESSION['imagem'])){
		$imagem = $_SESSION['imagem'];
	}

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require_once($diretorio.'controller/controllerNivel.php');
	require_once($diretorio.'controller/controllerUsuario.php');
	$controllerNivel = new controllerNivel();
	$controllerNivel->checarPermissao($idNivel, $idPagina);
	
	$controllerUsuario = new controllerUsuario();
	$controllerUsuario->checarLogin();
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

        <script>
            var url = '../../';
			
            function buscar(idItem){
                $.ajax({
                    type: 'POST',
                    url: 'frm_usuario.php',
                    data: {id:idItem},
					success: function(dados){
						$('.modal').html(dados);
					}
                });
            }

            //função para adquirir o status ativo
            function status(idItem, status){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: url+'/router.php', //url onde será enviada a requisição
                    data: {modo: 'status', controller: 'usuario', id:idItem, status:status}, //dados enviados
                    success: function(dados){
                        //em caso de sucesso, lista os dados
                        listar();
                    }
                });
            }
            
            //função enviar a requisição de exclusão para a router.php
            function excluir(idItem){
                $.ajax({
                    type: 'POST',
                    url: url+'/router.php',
                    data: {modo: 'excluir', id:idItem, controller: 'usuario'},
                    success: function(dados){
                        listar()
                    }
                });
            }
            
            //função para exibir os dados da tabela
            function listar(){
                $.ajax({
                    type: 'POST',
                    url: 'dados.php',
                    success: function(dados){
                        $('#consulta').html(dados);    
                    }
                });
            }
            
            //função para abrir a modal
            $(document).ready(function(){                
                listar();
                
                $('#adicionar').click(function(){
                    $('.container_modal').fadeIn(400);
					
					$.ajax({
                    type: 'POST',
                    url: 'frm_usuario.php',
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
						echo("<img id='img_perfil' src='{$imagem}'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Usuários</span>

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
                        <a class="paginas_link" href="../nivel/nivel_view.php">
                            Níveis
                        </a>

                        <a class="paginas_link" href="../enquete/enquete_view.php">
                            Enquetes
                        </a>
                    </div>
					
					<div class="estatisticas">
						<div class="dashboard_title_container">
                        	<span class="page_title">Estatísticas</span>
                    	</div>
						
						<?php
							$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
							require_once($diretorio.'controller/controllerUsuario.php');
							$controllerUsuario = new controllerUsuario();
							
							$totalUsuarios = $controllerUsuario->totalUsuarios();
							
							$usuariosAtivos = $controllerUsuario->usuariosAtivos();
						?>
						<p>Total de Usuários: <?php echo($totalUsuarios)?> </p>
						<p>Usuários ativos: <?php echo($usuariosAtivos)?> </p>
					</div>
                </div>

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">#</div>
                        <div class="users_view_itens">Usuario</div>
                        <div class="users_view_itens">Nível</div>
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