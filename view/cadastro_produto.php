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
			});
			
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
        <header>
            <div class="menu_paginas">
                <div class="menu_paginas_site">
                    <a href="fale_conosco.php" class="link_paginas"> Fale Conosco </a>
                    <a href="nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
                    <a href="sobre.php" class="link_paginas"> Sobre </a>
                
                    <div class="pesquisa_cabecalho_icone">
                        
                        <img alt="#"  src="icones/pesquisa.png">
                    </div>
                    
                <div class="pesquisa_cabecalho">
                    <input class="campo_pesquisa_cabecalho" type="text">
                </div>
                </div>
            </div>
            
            <div class="menu_principal">
                <div class="menu_principal_site">
                    <div class="menu_lado_esquerdo">
                        <div class="menu_responsivo">
                        
                        </div>
                        <a href="../index.php">
                            <div class="logo">
                                <img alt="#"  src="imagens/logoBrecho3.png">
                            </div>
                        </a>
                    </div>
                    <div class="menu_lado_direito">
                        <div class="login_carrinho">
                            
                                <div class="login">
                                    <div class="icone_login">
                                        <img alt="#"  src="icones/login.png">
                                    </div>
                                    <a  href="login.php">
                                        <div class="texto_login">
                                            Entrar   
                                        </div>
                                    </a>
                                    <div class="sub_login">
                                        <a href="perfil.php">
                                            <div class="texto_perfil">
                                                Perfil   
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            
                            <a href="carrinho.php">
                                <div class="login">
                                    <div class="icone_login">
                                        <img alt="#"  src="icones/carrinho.png">
                                    </div>
                                    <div class="texto_login">
                                        Carrinho   
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="menu_categoria">
                <div class="menu">
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Comum
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Alfaiataria
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Banho
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Pijamas
                        </div>
                    </a>
                    <a href="visualizar_categoria.php">
                        <div class="menu_item">
                            Social
                        </div>
                    </a>
                    <a href="promocao.php">
                        <div class="menu_item">
                            Promoção
                        </div> 
                    </a>
                    <a href="eventos.php">
                        <div class="menu_item">
                            Eventos
                        </div> 
                    </a>
                    
                </div>
            </div>
        </header>
        <main>
            <div class="linha">
                Cadastar Produto           
            </div>
            
            <form method="POST" name="frmProduto" enctype="multipart/form-data" class="cadastro_produto" action="../router.php?controller=avaliação&modo=cadastrar">
                <div class="cadastro_esquerdo">
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Nome do Produto:
                        </div>
                        <div class="caixa_cadastro_produto">
                            <input class="campo_cadastro_produto" name="txtnome" type="text">
                        </div>
                    </div>
					<div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Tamanho:
                        </div>
						
						<div class="caixa_cadastro_produto" id="radio_produto">
							<label>Medida</label>
                            <input type="radio" name="txttipo" class="txttipo" value="1">
							
							<label>Número</label>
							<input type="radio" name="txttipo" class="txttipo" value="2">
                        </div>
						
                        <div class="caixa_cadastro_produto">
                            <select class="campo_cadastro_produto" name="txttamanho" id="txttamanho">
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
                            <input class="campo_cadastro_produto_meio" name="txtvalor" type="number">
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
                            <textarea class="campo_cadastro_produto_descricao" name="txtestado"></textarea>
                        </div>
                    </div>
                    <div class="linha_cadastro">
                        <div class="titulo_cadastro_produto">
                            Fotos:
                        </div>
                    </div>
                    <div class="caixa_fotos">
                        <div class="fotos_container">
							<div class="foto">
                            	<img alt="#" id="prev_imagem" src="icones/foto.png">
							</div>

							<div class="foto">
								<img alt="#" id="prev_imagem2" src="icones/foto.png">
							</div>
							<div class="foto">
								<img alt="#" id="prev_imagem3" src="icones/foto.png">
							</div>
						</div>
						
						<div class="selecao_container">
							<div class="selecao_fotos">
								<input class="escolha_fotos" id="imagem" name="fleimagem[]" type="file" onChange="mostrarPrevia(this, '#prev_imagem')">
								<label for="imagem">
									<div class="botao_imagem">
										selecionar
									</div>
								</label>

							</div>
							<div class="selecao_fotos">
								<input class="escolha_fotos" id="imagem2" name="fleimagem[]" type="file" onChange="mostrarPrevia(this, '#prev_imagem2')">
								<label for="imagem2">
									<div class="botao_imagem">
										selecionar
									</div>
								</label>
							</div>
							<div class="selecao_fotos">
							   <input class="escolha_fotos" id="imagem3" name="fleimagem[]" type="file" onChange="mostrarPrevia(this, '#prev_imagem3')">
								<label for="imagem3">
									<div class="botao_imagem">
										selecionar
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