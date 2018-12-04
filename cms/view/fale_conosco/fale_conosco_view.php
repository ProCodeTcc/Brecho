<?php 
    //iniciando a sessão
    session_start();
    
    //resgatando o usuário
    $usuario = $_SESSION['usuario_cms'];

    //resgatando o nível
	$idNivel = $_SESSION['nivel'];

    //identificando a página
	$idPagina = 8;

    //verificando se existe alguma imagem
	if(isset($_SESSION['imagem'])){
        //armazenando a imagem
		$imagem = $_SESSION['imagem'];
	}

    //armazenando os dados numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require_once($diretorio.'controller/controllerNivel.php');
	require_once($diretorio.'controller/controllerUsuario.php');

    //instância da controller
	$controllerNivel = new controllerNivel();

    //verificando o acesso do usuário
	$controllerNivel->checarPermissao($idNivel, $idPagina);
	
    //instância da controller
	$controllerUsuario = new controllerUsuario();

    //verificando o login
	$controllerUsuario->checarLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Fale Conosco</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
		<script src="../js/funcoes.js"></script>
        <script src="../js/jquery.form.js"></script>
        
        	<script>
		var url = '../../';
		
        //função para listar os dados
		function listar(){
			$.ajax({
				type: 'POST', //tipo de requisiçao
				url: 'dados.php', //url onde será enviada a requisição
				success: function(dados){
                    //exibindo os dados na div
					$('#consulta').html(dados);
				}
			});
		}
		
        //função para visualizar um item
		function visualizar(idItem){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'modal.php', //url onde será enviada a requisição
				data: {id:idItem}, //parâmetros enviados
				success: function(dados){
                    //exibindo os dados na modal
					$('.modal').html(dados);
				}
			});
		}
		
		function excluir(idItem){
			$.ajax({
				type: 'POST',
				url: url+'router.php',
				data: {id:idItem, controller: 'FaleConosco', modo: 'excluir'},
				success: function(dados){
					//listagem dos dados
                    listar();
                    
                    //conversão dos dados para JSON
                    json = JSON.parse(dados);
                    
                    //verificando o status
                    if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao realizar a exclusão');
                    }
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
			
            //função no click do logout
			$('#logout').click(function(){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'/router.php', //url onde será enviada a requisição
					data: {controller: 'usuario', modo: 'deslogar'}, //parâmetros enviados
					success: function(dados){
                        //redirecionando o usuário
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
            <span class="page_title">Fale Conosco</span>

            <div class="page_search_container">
				<input type="search" class="page_search" id="pesquisar" onkeydown="pesquisar(event)">
                <div class="img_pesquisa">
                    <img src="../imagens/search.png" onmousedown="pesquisar(event)" alt="ícone para pesquisa">
                </div>
            </div>
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
						<div class="users_view_itens">Assunto</div>
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