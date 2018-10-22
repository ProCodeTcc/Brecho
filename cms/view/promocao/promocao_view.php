<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 11;
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
        <title>Promoção</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
		
		<script>
			var url = '../../';
			
			function listar(){
				$.ajax({
					type: 'POST',
					url: 'dados.php',
					success: function(dados){
						$('#consulta').html(dados);
					}
				});
			}
			
			//função para adicionar um percentual de desconto
			function cadastrarPromocao(idItem){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: 'frm_promocao.php', //url onde será enviada a requisição
					data: {id:idItem}, //parâmetros enviados
					success: function(dados){
						//colocando os dados na modal
						$('.modal').html(dados);
					}
				});
			}
			
			//função para atualizar o status de uma promoção
			function status(status, id){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {status:status, id:id, modo: 'status', controller: 'promoção'}, //parâmetros enviados
					success: function(dados){
						//lista os dados em caso de sucesso
						listar();
					}
				});
			}
			
			//função que exclui uma promoção
			function excluir(id){
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {id:id, modo: 'excluir', controller: 'promoção'}, //parâmetros enviados
					success: function(dados){
						if(dados == 'limite'){
							alert('Não foi possível realizar a exclusão!! Deve haver ao menos uma promoção ativa');
						}else if(dados == 'erro'){
							alert('Ocorreu um erro ao realizar a exclusão');
						}else{
							//mensagem de sucesso
							alert(dados);

							//listagem dos dados atualizados
							listar();
						}
					}
				});
			}
			
			$(document).ready(function(){
				listar()
				
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
            <div class="modal" id="modal_roupa">
                
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
            <span class="page_title">Promoção</span>

            <div class="page_search_container">
                <input type="text" class="page_search">
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
                        <div class="users_view_itens">Produtos do Brechó</div>
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