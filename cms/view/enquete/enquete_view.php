<?php 
    session_start();
    $usuario = $_SESSION['usuario_cms'];
	$idNivel = $_SESSION['nivel'];
	$idPagina = 4;
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
        <title>Home</title>
        
        <script src="../js/jquery.js"></script>
		<script src="../js/funcoes.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.form.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/Chart.js"></script>
        
        <script>
        var url = '../../';
		
		function adicionar(){
			$.ajax({
				type: 'POST',
				url: 'frm_enquete.php',
				success: function(dados){
                    $('.modal').html(dados);
                    $('.form').attr('data-modo', 'inserir');
				}
			});
		}
		
        //função para listar os dados da tabela
        function listar(){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: 'dados.php', //url onde será feita a requisição
                success: function(dados){
                    //em caso de sucesso, insere os dados na div consulta
                    $('#consulta').html(dados);
                    verificarDados('#consulta');
                }
            });
        }
		
		function visualizar(idItem){
			$('#resultado').fadeIn(400);
			$.ajax({
				type: 'POST',//tipo de requisição
				url: url+'/router.php', //url para onde a requisição será enviada
				data: {id:idItem, modo: 'visualizar', controller: 'enquete'},//dados que serão enviados
				success: function(dados){
					//conversão dos dados recebidos para json
					json = JSON.parse(dados);
					

                        graficoPizza(json.qtdAlternativaA, json.qtdAlternativaB, json.qtdAlternativaC, json.qtdAlternativaD);
				}
			});
		}

        function excluir(idItem){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url onde será feita a requisição
                data: {id:idItem, modo: 'excluir', controller: 'enquete'}, //dados a serem enviados
                success: function(dados){
                    //conversão dos dados para JSON
                    json = JSON.parse(dados);

                    //verificando o status
                    if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao realizar a exclusão');
                    }else if(json.status == 'limite'){
                        //mensagem de informação
                        mostrarInfo('Deve haver ao menos uma enquete ativa');
                    }

                    listar();
                }
            });
        }
		
		//função que envia o id para página do formulário
        function buscar(idItem){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: 'frm_enquete.php', //url para onde será enviada a requisição
                data: {id:idItem}, //dados a serem enviados
                success: function(dados){
                    $('.modal').html(dados);
                    $('.form').attr('data-modo', 'buscar');
                    $('#tabs').tabs('enable', 1);
                }
            });
        }
		
        
        //função para adquirir o status ativo
        function status(idItem, status){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url onde será enviada  a requisição
                data: {id:idItem, modo: 'status', controller: 'enquete', status:status}, //dados enviados
                success: function(dados){
                    //em caso de sucesso, listar os dados
                    listar();
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
			
            $('#adicionar').click(function(){
                $('.container_modal').fadeIn(400);
            });
			
			$('#voltar').click(function(){
				$('#resultado').hide();
				$('#consulta').fadeIn(400);
			})
			
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
            <span class="page_title">Enquetes</span>

            <div class="page_search_container">
                <input type="search" class="page_search" id="pesquisar" onkeydown="pesquisar(event)">
                <div class="img_pesquisa">
                    <img src="../imagens/search.png" onmousedown="pesquisar(event)" alt="ícone para pesquisar">
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
                    <div class="users_view_title" id="titulo">
                        <div class="users_view_itens">Pergunta</div>
                        <div class="users_view_itens">Tema</div>
                        <div class="users_view_itens">Término</div>
                        <div class="users_view_itens">Ações</div>
                    </div>

                    <div id="consulta">
                        
                    </div>
					
					<div id="resultado">
						<canvas id="grafico" width="600" height="200"></canvas>
                        <button class="sub_btn" type="button" id="voltar">
                            <strong>VOLTAR</strong>
                        </button>
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