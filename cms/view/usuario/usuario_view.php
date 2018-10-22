<?php 
    session_start();
    $usuario = $_SESSION['usuario_cms'];
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
        <title>Usuários</title>
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
						console.log(dados);
                        if(dados == false){
							alert('Não foi possível realizar a exclusão!! Tem de haver ao menos um usuário cadastrado.');
						}else{
							alert('Usuario excluído com sucesso!!');
						}
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
                
				//evento no click de um item do menu
				$('.menu .menu_itens').click(function(e){
					//mostrando o submenu somente do item clicado
					$(this).find('.submenu').toggle(400);

					//escondendo os submenus dos itens que não forem clicados
					$('.menu_itens').not(this).find('.submenu').hide('fast');
				});
				
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
						echo("<img src='../arquivos/$imagem'>");
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
                   		<?php require_once('../menu.php') ?>
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
        </div>

        <footer>
            brechó bernadete©
        </footer>
    </body>

</html>