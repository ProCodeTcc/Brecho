<?php 
    session_start();
    $usuario = $_SESSION['usuario_cms'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 7;
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
        <title>Slider</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
    </head>
	
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
				url: 'frm_slider.php', //url onde será enviada a requisição
				success: function(dados){
					//listando os dados na modal
					$('.modal').html(dados);
				}
			});
		}
		
		//função que para exibir o formulário para edição
		function buscar(id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: 'frm_slider.php', //url onde será enviada a requisiçã
				data: {id:id}, //parâmetros enviados
				success: function(dados){
					//mostrando o formulário
					$('.modal').html(dados);
				}
			});
		}
		
		//função para excluir uma imagem
		function excluir(id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: {id:id, controller: 'slider', modo: 'excluir'}, //parâmetros enviados
				success: function(dados){
					if(dados == 'limite'){
						alert('Não foi possível realizar a exclusão!! Deve haver ao menos uma imagem cadastrada.');
					}else if(dados == 'erro'){
						alert('Ocorreu um erro ao realizar a exclusão');
					}else{
						//mensagem
						alert(dados);

						//listagem dos dados atualizados
						listar();
					}
				}
			});
		}
		
		//função que atualiza o status
		function status(status, id){
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: {status:status, id:id, controller: 'slider', modo: 'status'}, //parâmetros enviados
				success: function(dados){
					//verificando se o limite foi excedido
					if(dados == 'limite'){
						//mensagem de erro
						alert('Você excedeu o limite máximo de sliders ativos!!');
					}
					
					//listagem dos dados atualizados
					listar();
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
						echo("<img src='../arquivos/$imagem'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Slider</span>

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
                        <?php require_once('../menu.php') ?>
                    </div>
                </div>

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">Sliders</div>
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