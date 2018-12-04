<?php
    //iniciando a sessão
    session_start();

    //resgatando o login do usuário
    $usuario = $_SESSION['usuario_cms'];

    //resgatando o nível do usuário
	$idNivel = $_SESSION['nivel'];

    //identificando a página
	$idPagina = 9;
    
    //verificando se o usuário possui alguma imagem
	if(isset($_SESSION['imagem'])){
        //resgatando a imagem
		$imagem = $_SESSION['imagem'];
	}

    //armazenando o diretório numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão das controllers
	require_once($diretorio.'controller/controllerNivel.php');
	require_once($diretorio.'controller/controllerUsuario.php');
    
    //instância da controller
	$controllerNivel = new controllerNivel();

    //verificando se o usuário tem acesso à página
	$controllerNivel->checarPermissao($idNivel, $idPagina);
	
    //instância da controller
	$controllerUsuario = new controllerUsuario();

    //verificando se o usuário está logado
	$controllerUsuario->checarLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Avaliação</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		<script src="../js/funcoes.js"></script>
        	<script>
		var url = '../../';
		
		function listar(){
			$.ajax({
				type: 'POST',
				url: 'dados.php',
				success: function(dados){
					$('#consulta').html(dados);
                    verificarDados('#consulta');
				}
			});
		}
		
		//função para aprovar um produto
		function aprovar(id, idCliente, preco, tipoCliente){
			$.ajax({
				type: 'POST',
				url: 'frm_avaliacao.php',
				data: {id:id, idCliente:idCliente, preco:preco, tipoCliente:tipoCliente},
				success: function(dados){
					$('.modal').html(dados);
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
            <span class="page_title">Avaliação</span>

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
                        <div class="users_view_itens">Produtos em Análise</div>
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