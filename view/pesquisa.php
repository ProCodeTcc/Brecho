<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerProduto.php');
    require_once('arquivos/check_login.php');
    
    if(isset($_POST['txtpesquisa'])){
        $pesquisa = $_POST['txtpesquisa'];
    }
    
    if(isset($_GET['mobile'])){
        $mobile = 'true';
    }else{
        $mobile = 'false';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/funcoes.js"></script>
		
		<script>
            //função para filtrar por classificação
			function filtrarClassificacao(classificacao){
                //pegando o nome do produto
                var pesquisa = $('#categoria').data('pesquisa');

                //verificando se o acesso é pelo celular
                if(verificarMobile() == true){
                    //url para o mobile
                    url = 'arquivos/pesquisa/produtos.php?mobile=true';
                }else{
                    //url para o desktop
                    url = 'arquivos/pesquisa/produtos.php';
                }
                
				$.ajax({
					type: 'POST', //tipo de requisição
					url: url, //url onde será enviada a requisição
					data: {tipoFiltro: 'classificacao', filtro: classificacao, termo:pesquisa}, //dados enviados
					success: function(dados){
                        //colocando os dados na div
						$('#categoria').html(dados);
					}
				});
			}
			
            //função para filtrar por tamanho
			function filtrarTamanho(tamanho){
                //pegando o nome do produto
                var pesquisa = $('#categoria').data('pesquisa');

                //verificando se o acesso é pelo celular
                if(verificarMobile() == true){
                    //url para o mobile
                    url = 'arquivos/pesquisa/produtos.php?mobile=true';
                }else{
                    //url para o desktop
                    url = 'arquivos/pesquisa/produtos.php';
                }
                
                $.ajax({
					type: 'POST', //tipo de requisição
					url: url, //url onde será enviada a requisição
					data: {tipoFiltro: 'tamanho', filtro: tamanho, termo:pesquisa}, //dados enviados
					success: function(dados){
                        //colocando o conteúdo na div
						$('#categoria').html(dados);
					}
				});
			}

            //função para filtrar por cor
            function filtrarCor(cor){
                //pegando o conteúdo da pesquisa
                var pesquisa = $('#categoria').data('pesquisa');

                //verificando se o acesso é pelo celular
                if(verificarMobile() == true){
                    //url para o mobile
                    url = 'arquivos/pesquisa/produtos.php?mobile=true';
                }else{
                    //url para o desktop
                    url = 'arquivos/pesquisa/produtos.php';
                }
                
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: url, //url onde será enviada a requisição
                    data: {tipoFiltro: 'cor', filtro:cor, termo:pesquisa}, //dados enviados
                    success: function(dados){
                        //colocando o conteúdo na div
                        $('#categoria').html(dados);
                    }
                });
            }

            //função para filtrar por marca
            function filtrarMarca(marca){
                //pegando o conteúdo da pesquisa
                var pesquisa = $('#categoria').data('pesquisa');

                //verificando se o acesso é pelo celular
                if(verificarMobile() == true){
                    //url para o mobile
                    url = 'arquivos/pesquisa/produtos.php?mobile=true';
                }else{
                    //url para o desktop
                    url = 'arquivos/pesquisa/produtos.php';
                }
                
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: url, //url onde será enviada a requisição
                    data: {tipoFiltro: 'marca', filtro:marca, termo:pesquisa}, //dados enviados
                    success: function(dados){
                        //colocando o conteúdo na div
                        $('#categoria').html(dados);
                    }
                });
            }
            
            //função para filtrar pelo preço
            function filtrarPreco(){
                var pesquisa = $('#categoria').data('pesquisa');
                var min = $('#min').val();
                var max = $('#max').val();
                
                //verificando se o acesso é pelo celular
                if(verificarMobile() == true){
                    //url para o mobile
                    url = 'arquivos/pesquisa/produtos.php?mobile=true';
                }else{
                    //url para o desktop
                    url = 'arquivos/pesquisa/produtos.php';
                }
                
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: url, //url onde será a requisição
                    data: {tipoFiltro:'preco', min:min, max:max, termo:pesquisa}, //dados enviados
                    success: function(dados){
                        //colocando os dados na div
                        $('#categoria').html(dados);
                    }
                })
            }
			
			$(document).ready(function(){
				$('.filtrar').click(function(){
					$('#categoria').children().empty();
                });
                $('#pesquisa').hide();
                
                if(verificarMobile() == true){
                    painelUsuario();
                    filtroResponsivo();
                }
                
                verificarProdutos();
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
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
		
        <main id="categoria" data-pesquisa="<?php echo($pesquisa) ?>">
                <div class="caixa_categoria">
                    <div class="categoria_pesquisa">
                        <div class="categoria_pesquisa_centro">
                            <form name="search" method="POST" action="pesquisa.php?mobile=<?php echo($mobile) ?>">
                               <input type="search" name="txtpesquisa" class="campo_pesquisa_categoria"> 
                               <input type="submit" class="botao_pesquisa_categoria" value="Pesquisar">
                            </form>
                        </div>
                    </div>
                    
                    <?php
                        if(isset($_GET['mobile'])){
                            $mobile = $_GET['mobile'];

                            if($mobile == 'true'){
                                require_once('arquivos/pesquisa/filtro_responsivo_pesquisa.php');
                            }
                        }
                    ?>
                        <div class="categoria">
                            <div class="titulo_categoria_primeiro">
                                Classificação
                            </div>
                            <div class="categoria_linha filtrar" onClick="filtrarClassificacao('A')">
                                A
                            </div>
                            <div class="categoria_linha filtrar" onClick="filtrarClassificacao('B')">
                                B
                            </div>
                            <div class="categoria_linha filtrar" onClick="filtrarClassificacao('C')">
                                C
                            </div>
                            
                            <div class="titulo_categoria">
                                Preço
                            </div>
                            
                            <div class="preco_container">
                                <input class="preco_min" id="min" type="number" name="txtmin" placeholder="min">
                                <input class="preco_max" id="max" type="number" name="txtmax" placeholder="max" onblur="filtrarPreco()">
                            </div>
                            
                            <div class="titulo_categoria">
                                Medidas
                            </div>
                            <div class="categoria_tamanhos container_tamanho">
								<?php
									$listMedidas = new controllerProduto();
									$rsMedidas = $listMedidas->listarMedidas();
									$cont = 0;
									while($cont < count($rsMedidas)){
								?>
								
                                <div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>)">
									<?php echo($rsMedidas[$cont]->getTamanho()) ?>
								</div>
							<?php $cont++;
								} ?>
                            </div>
							
							<div class="titulo_categoria">
                                Números
                            </div>
                            <div class="categoria_tamanhos container_tamanho">
								<?php
									$listNumeros = new controllerProduto();
									$rsNumeros = $listNumeros->listarNumeros();
									$cont = 0;
									while($cont < count($rsNumeros)){
								?>
								
                                <div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsNumeros[$cont]->getId()) ?>)">
									<?php echo($rsNumeros[$cont]->getTamanho()) ?>
								</div>
							<?php $cont++;
								} ?>
                            </div>
                            <div class="titulo_categoria">
                                Cores
                            </div>
                            <div class="container_cor">
                            <?php
                                $listCor =  new controllerProduto();
                                $rsCor = $listCor->listarCores();
                                $cont = 0;
                                while($cont < count($rsCor)){
                            ?>
                                <div class="cores" style="background-color: <?php echo($rsCor[$cont]->getCor()) ?>;" onclick="filtrarCor(<?php echo($rsCor[$cont]->getId()) ?>)">
                                    <span class="nome_cor">
                                        <?php echo($rsCor[$cont]->getNome()) ?>
                                    </span>
                                </div>                       

                            <?php
                            $cont++;
                                }
                            ?>         
                            </div>

                            <div class="titulo_categoria">
                                Marcas
                            </div>

                        <?php
                            $listMarca = new controllerProduto();
                            $rsMarca = $listMarca->listarMarca();
                            $cont = 0;
                            while($cont < count($rsMarca)){
                        ?>
                            <div class="categoria_linha filtrar" onClick="filtrarMarca(<?php echo($rsMarca[$cont]->getId()) ?>)">
                                <?php
                                    echo($rsMarca[$cont]->getMarca());
                                ?>
                            </div>
                        <?php
                        $cont++;
                            }
                        ?>
                        </div>
                                            
                        <div class="filtro_categoria">
                            <?php
                                $listProduto = new controllerProduto();
                                $rsProduto = $listProduto->pesquisarProduto($pesquisa);
                                
                                $cont = 0;

                                while($cont < count($rsProduto)){
                            ?>
                            <a href="visualizar_produto.php?id=<?php echo($rsProduto[$cont]->getId())?>" onclick="atualizarClique(this, event, <?php echo($rsProduto[$cont]->getId()) ?>)">
                                <div class="produto">
                                    <div class="imagem_produto">
                                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsProduto[$cont]->getImagem())?>" alt="#">
                                    </div>
                                    <div class="descritivo_produto">
                                        <div class="titulo_produto">
                                            <?php echo($rsProduto[$cont]->getNome())?>
                                        </div>
                                        <div class="descricao">
                                            <?php echo($rsProduto[$cont]->getDescricao())?>
                                        </div>
                                        <div class="tamanho">
                                           <?php echo($rsProduto[$cont]->getTamanho())?>
                                        </div>
                                        <div class="preco">
                                            R$ <?php echo($rsProduto[$cont]->getPreco())?>
                                        </div>
                                        <div class="opcoes">
                                            <div class="comprar_produto">
                                                Conferir
                                            </div>
                                            <div class="carrinho_produto" onclick="adicionarCarrinho(<?php echo($rsProduto[$cont]->getId()) ?>, event)">
                                                <img  alt="#" src="icones/carrinho.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                                    $cont++;
                                    }
                                ?>
                            </a>
                     </div>
					
					<div class="nenhum_produto">
                        <strong>NENHUM RESULTADO ENCONTRADO</strong>
                        <p>Encontramos 0 resultado para sua busca</p>

                        <strong>Dicas para melhorar sua busca</strong>
                        <p>Verifique se não houve erro de digitação.</p>
                        <p>Procure por um termo similar ou sinônimo.</p>
                        <p>Tente procurar termos mais gerais e filtrar o resultado da busca.</p>
                    </div>
                        
                  </div>  
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