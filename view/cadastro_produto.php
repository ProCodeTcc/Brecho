<?php
	require_once('arquivos/check_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery.form.js"></script>
		<script src="js/funcoes.js"></script>
		
		<script>
			var url = '../';
			
			//função para listar as cores
			function listarCor(){
				$.ajax({
					type: 'GET', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {modo: 'listarCor', controller: 'avaliação'}, //parâmetros enviados
					success: function(dados){
						//conversão dos dados para json
						json = JSON.parse(dados);
						
						//percorrendo os dados
						for(var i = 0; i < json.length; i++){
							//criando um novo option para o select com os dados
							$('#txtcor').append(new Option(json[i].nome, json[i].idCor));
						}
					}
				});
			}
			
			//função para listar as marcas
			function listarMarca(){
				$.ajax({
					type: 'GET', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {modo: 'listarMarca', controller: 'avaliação'}, //parâmetros enviados
					success: function(dados){
						//conversão dos dados para json
						json = JSON.parse(dados);
						
						//percorrendo os dados
						for(var i = 0; i < json.length; i++){
							$('#txtmarca').append(new Option(json[i].nomeMarca, json[i].idMarca));
						}
					}
				});
			}
			
			//função para listar as categorias
			function listarCategoria(){
				$.ajax({
					type: 'GET', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {modo: 'listarCategoria', controller: 'avaliação'}, //parâmetros enviados
					success: function(dados){
						//conversão dos dados para json
						json = JSON.parse(dados);
						
						//percorrendo os dados
						for(var i = 0; i < json.length; i++){
							$('#txtcategoria').append(new Option(json[i].nomeCategoria, json[i].idCategoria));
                        }
                        
                        var idCategoria = $('#txtcategoria').find('option:selected').val();
                        selecionarSubcategoria(idCategoria);
					}
				});
			}
			
			//função que lista os tamanhos
			function buscarTamanho(tipoTamanho){
				$.ajax({
					type: 'GET', //tipo de requisição
					url: url+'router.php', //url onde será enviada a requisição
					data: {modo: 'buscarTamanho', controller: 'avaliação', tipo: tipoTamanho}, //parâmetros enviados
					success: function(dados){
						//conversão dos dados para json
						json = JSON.parse(dados);
						
						//percorrendo os dados
						for(var i = 0; i < json.length; i++){
							$('#txttamanho').append(new Option(json[i].tamanho, json[i].idTamanho));
						}
					}
				});
            }
            
            //função para listar as subcategorias de uma categoria
            function selecionarSubcategoria(idCategoria){
                //removendo as options anteriores
                $('#txtsubcategoria').children().remove();
                
                //resgatando o ID da categoria
                var idCategoria = $('#txtcategoria').find('option:selected').val();
            
                $.ajax({
                    type: 'GET', //tipo de requisição
                    url: url+'router.php', //url onde será enviada a requisição
                    data: {controller: 'avaliação', modo: 'buscarSubcategoria', id:idCategoria}, //dados enviados
                    success: function(dados){
                        $('#subcategoria').show();
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);

                        //percorrendo os dados
                        for(var i = 0; i < json.length; i++){
                            //criando uma nova option com os dados
                            $('#txtsubcategoria').append(new Option(json[i].nome, json[i].idSubcategoria));
                        }
                    }
                });
            }

            //função para listar as subcategorias de uma categoria
            function selecionarSubcategoria(idCategoria){
                //removendo as options anteriores
                $('#txtsubcategoria').children().remove();
                
                //verificando se o ID da categoria é indefinido
                if(idCategoria == undefined){
                    //resgatando o ID da categoria
                    var idCategoria = $('#txtcategoria').find('option:selected').val();
                }

                //verificando se existe o ID da categoria
                if(typeof idCategoria == 'string'){
                    //mostra a subcategoria
                    $('#subcategoria').show();
                }
            
                $.ajax({
                    type: 'GET', //tipo de requisição
                    url: url+'router.php', //url onde será enviada a requisição
                    data: {controller: 'avaliação', modo: 'buscarSubcategoria', id:idCategoria}, //dados enviados
                    success: function(dados){
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);

                        //percorrendo os dados
                        for(var i = 0; i < json.length; i++){
                            //criando uma nova option com os dados
                            $('#txtsubcategoria').append(new Option(json[i].nome, json[i].idSubcategoria));
                        }
                    }
                });
            }
			
			//função que mostra a prévia da imagem
			function mostrarPrevia(input, localPrevia){
				if(input.files && input.files[0]){
					//criando um novo leitor
					var leitor = new FileReader();
					
					//função no momento em que a imagem é carregada
					leitor.onload = function(event){
						//lugar onde vai mostrar a prévia
						$(localPrevia).attr('src', event.target.result);
					}
					
					leitor.readAsDataURL(input.files[0]);
				}
            }
            
            //função para validar as imagens
            function verificarImagem(){
                var arquivos = 0;

                //percorrendo os inputs
                $('input[type=file]').each(function(){
                    //verificando se estão vazios
                    if(!$(this).val()){
                        //conta quantos inputs estão vazios
                        arquivos += 1;
                    }
                });
                //retorna a quantidade
                return arquivos;
            }
			
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
				
				//listagem da cor
				listarCor();
				listarMarca();
				listarCategoria();
				
				$('.txttipo').click(function(){
					$('#txttamanho').find('option').remove();
					
					var tipoTamanho = $('input[name=txttipo]:checked').val();
					
					$('#txttamanho').show();
					
					buscarTamanho(tipoTamanho);
                });
                
                //função no submit do form
                $('#frmProduto').submit(function(e){
                    //desativando o submit do form
                    e.preventDefault();

                    //verificando se as imagens foram selecionadas
                    if(verificarImagem() != 0){
                        //informando para que selecioneas imagens
                        mostrarInfo('Selecione todas as imagens!!');
                    }else{
                        //resgatando a url
                        url = $('#frmProduto').attr('action');
                    }

                    $.ajax({
                        type: 'POST', //tipo de requisição
                        url: url, //url onde será enviada a requisição
                        data: new FormData($('#frmProduto')[0]), //dados enviados
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function(dados){
                            //conversão dos dados para JSON
                            json = JSON.parse(dados);

                            //verifica se deu certo
                            if(json.status == 'sucesso'){
                                //mensagem de sucesso
                                mostrarSucesso('Produto enviado para avaliação!!');
                            }else if(json.status == 'erro'){
                                //mensagem de erro
                                mostrarErro('Ocorreu um erro ao enviar o produto');
                            }
                        }
                    })
                });
			});
			
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    
    <body>
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

            <div class="mensagem-info" id="info">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>
        </div>
        
        <header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
        
        <main>
            <div class="linha">
                Cadastar Produto           
            </div>
            
            <form method="POST" name="frmProduto" id="frmProduto" enctype="multipart/form-data" class="cadastro_produto" action="../router.php?controller=avaliação&modo=cadastrar">
                <div class="cadastro_esquerdo">
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Nome do Produto:
                        </div>
                        <div class="caixa_cadastro_produto">
                            <input class="campo_cadastro_produto" name="txtnome" type="text" required>
                        </div>
                    </div>
					<div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Tamanho:
                        </div>
						
						<div class="caixa_cadastro_produto" id="radio_produto">
							<label>Medida</label>
                            <input type="radio" name="txttipo" class="txttipo" value="1" required>
							
							<label>Número</label>
							<input type="radio" name="txttipo" class="txttipo" value="2">
                        </div>
						
                        <div class="caixa_cadastro_produto">
                            <select class="campo_cadastro_produto" name="txttamanho" id="txttamanho" required>
                            </select>                      
                        </div>
                    </div>
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Categoria do Produto:
                        </div>
                        <div class="caixa_cadastro_produto">
                            <select id="txtcategoria" name="txtcategoria" class="campo_cadastro_produto" onchange="selecionarSubcategoria()"></select>
                        </div>
                    </div>
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Marca do Produto:
                        </div>
                        <div class="caixa_cadastro_produto">
                            <select id="txtmarca" name="txtmarca" class="campo_cadastro_produto"></select>
                        </div>
                    </div>
                    <div class="linha_cadastro" id="subcategoria">
                        <div class="titulo_cadastro_produto">
                            Subcategoria do Produto:
                        </div>
                        <div class="caixa_cadastro_produto">
                            <select id="txtsubcategoria" name="txtsubcategoria" class="campo_cadastro_produto"></select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="cadastro_direito">
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto_meio">
                            Sugestão de valor:
                        </div>
                        <div class="titulo_cadastro_produto_meio">
                            Cor:
                        </div>
                        <div class="caixa_cadastro_produto_meio">
                            <input class="campo_cadastro_produto_meio" name="txtvalor" type="number" required>
                        </div>
                        <div class="caixa_cadastro_produto_meio">
                            <select class="campo_cadastro_produto" name="txtcor" id="txtcor"></select>
                        </div>
                    </div>
					<div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Classificação
                        </div>
                        <div class="caixa_cadastro_produto">
                            <select id="txtclassificacao" name="txtclassificacao" class="campo_cadastro_produto">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
							</select>
                        </div>
                    </div>
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Estado da Roupa:
                        </div>
                        <div class="caixa_cadastro_produto_descricao">
                            <textarea class="campo_cadastro_produto_descricao" name="txtestado" required></textarea>
                        </div>
                    </div>
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Fotos:
                        </div>
                    </div>
                    <div class="caixa_fotos">
						<div class="selecao_container">
							<div class="selecao_fotos">
								<input class="escolha_fotos" id="imagem" name="fleimagem[]" type="file" onChange="mostrarPrevia(this, '#prev_imagem')">
								<label for="imagem">
									<div class="botao_imagem">
										<img alt="#" id="prev_imagem" src="icones/foto.png">
									</div>
								</label>

							</div>
							<div class="selecao_fotos">
								<input class="escolha_fotos" id="imagem2" name="fleimagem[]" type="file" onChange="mostrarPrevia(this, '#prev_imagem2')">
								<label for="imagem2">
									<div class="botao_imagem">
										<img alt="#" id="prev_imagem" src="icones/foto.png">
									</div>
								</label>
							</div>
							<div class="selecao_fotos">
							   <input class="escolha_fotos" id="imagem3" name="fleimagem[]" type="file" onChange="mostrarPrevia(this, '#prev_imagem3')">
								<label for="imagem3">
									<div class="botao_imagem">
										<img alt="#" id="prev_imagem" src="icones/foto.png">
									</div>
								</label> 
							</div>
						</div>
                    </div>
                </div>
                <div class="linha_botao_cadastro">
                    <input class="botao_cadastro" type="submit" value="Cadastrar">
            	</div>
            </form>
        </main>
        <footer>
            <div class="footer_centro">
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Mais Informações
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="fale_conosco.php"> Fale Conosco</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="nossas_lojas.php"> Nossas Lojas</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="sobre.php"> Sobre</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="perfil.php"> Minha Conta</a>
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Sobre o Brechó
                    </div>
                    <div class="linha_rodape">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Contatos
                    </div>
                    <div class="linha_rodape">
                        Endereço: Rua Lauro Linhares, 2123 – 202A
Florianópolis, SC, Brasil
                    </div>
                    <div class="linha_rodape">
                        Fone: (11)4002.8922 / Whatsapp: (11)99999.9999
                    </div>
                    <div class="linha_rodape">
                        E-mail: admin@brecho.com.br
                    </div>
                </div>
                <div class="rodape_final">
                    BERNADET Brechó Online. Todos os Direitos Reservados.
                </div>
            </div>
        </footer>
    </body>
</html>