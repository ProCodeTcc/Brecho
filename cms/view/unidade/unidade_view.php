<?php 
    session_start();
    $usuario = $_SESSION['usuario_cms'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 3;
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
        <title>Unidades</title>
		<script src="../js/latlon.js"></script>
		<script src="../js/funcoes.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		
		<script>
			var url = '../../';
			
			//função que lista os dados
			function listar(){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: 'dados.php', //url onde será enviada a requisição
					success: function(dados){
						//colocando os dados na div 
						$('#consulta').html(dados);
					}
				});
			}
			
			//função que exibe os dados
			function adicionar(){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: 'frm_unidade.php', //url onde será enviada a requisição
					success: function(dados){
						//colocando os dados na modal
						$('.modal').html(dados);
					}
				});
			}
			
			//função que exibe o formulário com os dados da unidade
			function buscar(idItem){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: 'frm_unidade.php', //url onde será enviada a requisição
					data: {id:idItem}, //parâmetros envidaos
					success: function(dados){
						//mostrando os dados na modal
						$('.modal').html(dados);
					}
				});
			}
			
			//função que exclui uma unidade
			function excluir(idItem, idEndereco){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {id:idItem, idEndereco:idEndereco, controller: 'unidade', modo: 'excluir'}, //parâmetros enviados
					success: function(dados){
						//listagem dos dados
						listar();
                        
                        //conversão dos dados para JSON.
                        if(json.status == 'erro'){
                            mostrarErro('Ocorreu um erro ao excluir a unidade');
                        }
					}
				});
			}
			
			
			$(document).ready(function(){
				listar()
				
				$('#adicionar').click(function(){
					$('.container_modal').fadeIn(400);
				});
				
				//evento no click de um item do menu
				$('.menu .menu_itens').click(function(e){
					//mostrando o submenu somente do item clicado
					$(this).find('.submenu').toggle(400);

					//escondendo os submenus dos itens que não forem clicados
					$('.menu_itens').not(this).find('.submenu').hide('fast');
				});
			});
		</script>
		
    </head>

    <body>
        <div class="container_modal">
            <div class="modal">
                
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
            <span class="page_title">Unidades</span>

            <div class="page_search_container">
            	<input type="search" class="page_search" id="pesquisar" onkeydown="pesquisar(event)">
                <div class="img_pesquisa">
                    <img src="../imagens/search.png" onmousedown="pesquisar(event)">
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

                <div class="users_view">
					<div class="users_view_title">
						<div class="users_view_itens">#</div>
						<div class="users_view_itens">Nome</div>
						<div class="users_view_itens">Cidade</div>
						<div class="users_view_itens">Ações</div>
					</div>

                    <div id="consulta">
						
						
                    </div>

					<div id="pesquisa">
					
					</div>
                </div>
            </div>
		</div>
		
        <footer>
            brechó bernadete©
        </footer>
    </body>
</html>