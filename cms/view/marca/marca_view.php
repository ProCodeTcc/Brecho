<?php 
    //iniciando a sessão
    session_start();

    //resgatando o usuário
    $usuario = $_SESSION['usuario_cms'];

    //resgatando o nível
	$idNivel = $_SESSION['nivel'];

    //identificando a página
	$idPagina = 17;
    
    //verificando se existe a imagem
	if(isset($_SESSION['imagem'])){
        //resgatando a imaagem
		$imagem = $_SESSION['imagem'];
	}

    //armazenando o diretório numa variável
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

    //verificando se o usuário está logado
	$controllerUsuario->checarLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Marca</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		<script src="../js/funcoes.js"></script>
		<script src="../js/jquery-ui.js"></script>
        	<script>
		var url = '../../';
		
		//função que lista os dados
		function listar(){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'dados.php', //url onde será enviada a requisição
				success: function(dados){
					//listando os dados na div de consulta
					$('#consulta').html(dados);
				}
			});
		}
		
		//função que carrega a modal
		function adicionar(){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'frm_marca.php', //url onde será enviada a requisição
				success: function(dados){
					//listando os dados na modal
					$('.modal').html(dados);
				}
			});
		}

		//função para buscar uma categoria
		function buscar(id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'frm_marca.php', //url onde será enviada a requisição
				data: {id:id}, //parâmetros enviados
				success: function(dados){
					//colocando os dados na modal
					$('.modal').html(dados);
				}
			});
		}

		//função para excluir uma categoria
		function excluir(id){
			$.ajax({
				type:'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: {id:id, controller: 'marca', modo: 'excluir'}, //parâmetros enviados
				success: function(dados){
                    //listando os dados
                    listar();
                    
					//conversão dos dados para JSON
					json = JSON.parse(dados);
					
					//verificando se foi excluido
					if(json.status == 'erro'){
						//mensagem de erro
						mostrarErro('Ocorreu um erro ao realizar a exclusão!!');
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
			
            //função no click do botão de adicionar
			$('#adicionar').click(function(){
                //exibindo os dados na modal
				$('.container_modal').fadeIn(400);
			});
			
            //função no click do logout
			$('#logout').click(function(){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'/router.php', //url onde será enviada a requisição
					data: {controller: 'usuario', modo: 'deslogar'}, //dados enviados
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
			<div class="modal" id="modal_tema">
                
            </div>
		</div>
		
		<div class="mensagens">
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
            <span class="page_title">Categorias</span>

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

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">#</div>
                        <div class="users_view_itens">Nome</div>
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