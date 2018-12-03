<?php 
    session_start();
    $usuario = $_SESSION['usuario_cms'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 5;
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
<html lang="pt-br">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sobre</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		<script src="../js/jquery-ui.js"></script>
		<script src="../js/funcoes.js"></script>
        
        	<script>
		var url = '../../';
		//função que exibe os dados na modal
		function adicionar(){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'layouts.php', //url onde será enviada a requisição
				success: function(dados){
					$('.modal').html(dados); //colocando os dados na modal
				}
			});
		}
		
		//função que lista os dados na tabela
		function listar(){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'dados.php', //url onde será enviada a requisição
				success: function(dados){
					$('#consulta').html(dados); //lista os dados na tabela
                    verificarDados('#consulta');
				}
			});
		}
		
		//função que busca o layout 1
		function buscar(idItem){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'frm_layout1.php', //url onde será enviada a requisição
				data: {id:idItem}, //parâmetros enviados
				success: function(dados){
					//listando o form
					$('.modal').html(dados);

					//habilitando a aba em inglês para edição
					$('#tabs').tabs('enable', 1);
				}
			});
		}
		
		//função que busca o layout 2
		function buscarLayout2(idItem){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'frm_layout2.php', //url onde será enviada a requisição
				data: {id:idItem}, //parâmetros enviados
				success: function(dados){
					//listando o form
					$('.modal').html(dados);

					//habilitando a aba em inglês para edição
					$('#tabs').tabs('enable', 1);
				}
			});
		}
		
		//função para realizar exclusão
		function excluir(idItem, layout){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'/router.php', //url onde será enviada a requisição
				data: {id:idItem, layout:layout, controller: 'sobre', modo: 'excluir'}, //parâmetros que serão enviados
				success: function(dados){
                    listar();
                    //conversão dos dados para JSON
					json = JSON.parse(dados);
                    
                    //verificando o status
                    if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao realizar a exclusão');
                    }else if(json.status == 'limite'){
                        //mensagem de informação
                        mostrarInfo('Tem de haver ao menos um layout ativo');
                    }
				}
			});
		}
		
		function visualizarLayout1(idItem){
			$.ajax({
				type: 'POST',
				url: 'preview_layout1.php',
				data: {id:idItem},
				success: function(dados){
					$('#previa').html(dados);
				}
			});
		}
		
		function visualizarLayout2(idItem){
			$.ajax({
				type: 'POST',
				url: 'preview_layout2.php',
				data: {id:idItem},
				success: function(dados){
					$('#previa').html(dados);
				}
			});
		}
		
		//função para alterar o status
		function status(status, idItem, layout){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: {status:status, id:idItem, layout:layout, controller: 'sobre', modo: 'status'}, //parâmetros enviados
				success: function(dados){
					listar(); //listagem dos dados
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
			
			$('#adicionar').click(function(){
				$('.container_modal').fadeIn(400);
			});
			
			$('#voltar').click(function(){
				$('#preview').hide();
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
    </head>
    
    <body>
        <div class="container_modal">
            <div class="modal" id="modal_sobre">
                
            </div>
        </div>

        <div class="mensagens">
            <div class="mensagem-info" id="info">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>

            <div class="mensagem-sucesso" id="sucesso">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>

            <div class="mensagem-erro" id="erro">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>
        </div>

        <header>
            <div class="logo">
                <a href="../home.php">
                    <img src="../imagens/logoBrecho3.png" alt="logo do brechó">
                </a>
            </div>

            <div class="painel_usuario">
				<?php
					if($imagem == null){
						echo('<img src="../imagens/user.png" alt="imagem padrão do usuário">');
					}else{
						echo("<img src='../arquivos/$imagem' alt='imagem do usuário'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Sobre nós</span>

            <div class="page_search_container">
				<input type="search" class="page_search" id="pesquisar" onkeydown="pesquisar(event)">
                <div class="img_pesquisa">
                    <img src="../imagens/search.png" onmousedown="pesquisar(event)" alt="ícone para pesquisa">
                </div>
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
                        <?php require_once('../menu.php') ?>
                    </div>
                </div>

                <div class="users_view" id="dados">
                    <div class="users_view_title">
                        <div class="users_view_itens">Layouts ativos</div>
						<div class="users_view_itens" id="showLayout1">L1</div>
                    </div>

                    <div id="consulta">						
                        
                    </div>

					<div id="pesquisa">
					
					</div>
                </div>
				
				<div class="users_view" id="preview">
                    <div class="users_view_title">
                        <div class="users_view_itens">Prévia</div>
						<div class="users_view_itens" id="voltar">Voltar</div>
                    </div>

                    <div id="previa">
						
                    </div>
                </div>

            </div>
        </div>

        <footer>
            brechó bernadete©
        </footer>
    </body>
</html>