<?php 
    session_start();
    $usuario = $_SESSION['usuario'];
	if(isset($_SESSION['imagem'])){
		$imagem = $_SESSION['imagem'];
	}
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
		
		function adicionar(){
			$.ajax({
				type: 'POST',
				url: 'frm_enquete.php',
				success: function(dados){
					$('.modal').html(dados);
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
					
					//colocando os valores 
					$('#qtdA').text("Quantidade de Cliques na Alternativa A: " + json.qtdAlternativaA);
					$('#qtdB').text("Quantidade de Cliques na Alternativa B: " + json.qtdAlternativaB);
					$('#qtdC').text("Quantidade de Cliques na Alternativa C: " + json.qtdAlternativaC);
					$('#qtdD').text("Quantidade de Cliques na Alternativa D: " + json.qtdAlternativaD);
				}
			});
		}

        function excluir(idItem){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url onde será feita a requisição
                data: {id:idItem, modo: 'excluir', controller: 'enquete'}, //dados a serem enviados
                success: function(dados){
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
						echo("<img src='{$imagem}'>");
					}
				?>
                <span class="dados_usuario"><?php echo($usuario) ?></span>
                <span class="dados_usuario" id="logout">logout</span>
            </div>
        </header>

        <div class="page_view">
            <span class="page_title">Enquetes</span>

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
                        <a class="paginas_link" href="../usuario/usuario_view.php">
                            Usuários
                        </a>

                        <a class="paginas_link" href="../nivel/nivel_view.php">
                            Níveis
                        </a>
                    </div>
                </div>

                <div class="users_view">
                    <div class="users_view_title">
                        <div class="users_view_itens">Pergunta</div>
                        <div class="users_view_itens">Tema</div>
                        <div class="users_view_itens">Término</div>
                        <div class="users_view_itens">Ações</div>
                    </div>

                    <div id="consulta">

                    </div>
					
					<div id="resultado">
						<div id="resultado_itens">
							<span id="qtdA"></span>
							<span id="qtdB"></span>
							<span id="qtdC"></span>
							<span id="qtdD"></span>

							<input type="button" id="voltar" value="VOLTAR">
						</div>
					</div>
                </div>

            </div>

            <div class="next_itens">
                <div class="next_itens_btn" id="pages">
                    1
                </div>

                <div class="next_itens_btn" id="pages">
                    2
                </div>
                
                <div class="next_itens_btn" id="pages">
                    3
                </div>
            </div>
        </div>

        <footer>
            brechó bernadete©
        </footer>
    </body>
</html>