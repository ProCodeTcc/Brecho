<?php 
    session_start();
    $usuario = $_SESSION['usuario_cms'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 2;
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
    </head>

    <script>
        var url = '../../';
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
        })
		
		function adicionar(){
			$.ajax({
                type: 'POST',
                url: 'frm_nivel.php',
                success: function(dados){
                    $('.modal').html(dados);
                }
            });
		}
        
        //função que envia o id para a página do formulário, onde será realizado a busca
        function buscar(idItem){
            $.ajax({
               type: 'POST', //tipo de requisição
               url:'frm_nivel.php', //url para onde será enviada a requisição
               data: {id:idItem}, //dados enviados
               success: function(dados){
                    $('.modal').html(dados);
               } 
            });
        }
        
        //função para verificar qual o status
        function status(idItem, status){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url para onde será enviada a requisição
                data: {modo: 'status', controller: 'nivel', id:idItem, status:status}, //dados enviados
                success: function(dados){
                    listar(); //caso tudo ocorra com sucesso, listar os dados
                }
            });
        }

        //função para listar os dados da tabela
        function listar(){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: 'dados.php', //url para onde será enviada a requisição
                success: function(dados){
                    //em caso de sucesso, insere os dados na div de consulta
                    $('#consulta').html(dados);
                }
            });
        }
		
		//função que mostra a tela de permissão
		function listarPermissao(){
			//oculta página de dados
			$('#consulta').hide();
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'permissao.php', //página que será enviada a requisição
				success: function(dados){
					$('#permissao').html(dados); //mostrando todas as páginas na tela
				}
			});
		}
		
		function permissao(idItem){
			listarPermissao();
			sessionStorage.setItem('idItem', idItem);
		}
        
        //função que realiza a requisição de exclusão
        function excluir(idItem){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url para onde será enviada a requisição
                data: {id:idItem, modo: 'excluir', controller: 'nivel'}, //dados que serão enviados
                success: function(dados){
                    if(dados != 1){
                        alert("Não foi possível realizar a exclusão! Há usuários cadastrados nesse nível.")
                    }
                    listar();
                }
            });
        }
    </script>

    <body>
        <div class="container_modal">
            <div class="modal" id="modal_nivel">

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
            <span class="page_title">Níveis</span>

            <div class="page_search_container">
                <input type="text" class="page_search">
            </div>

            <button class="page_btn" onclick="adicionar();" id="adicionar">
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
                        <div class="users_view_itens">Nome</div>
                        <div class="users_view_itens">Ações</div>
                    </div>

                    <div id="consulta">

                    </div>
					
					<div id="permissao">
						
					</div>
                </div>

            </div>
        </div>

        <footer>
            brechó bernadete©
        </footer>

    </body>
</html>