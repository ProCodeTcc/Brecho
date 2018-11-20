<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/funcoes.js"></script>
		
		<script>
			$(document).ready(function(){
                submenuMobile();
				//função no click do botão logar
				$('#logar').click(function(e){
					//desativando o submit do botão
					e.preventDefault();
					$.ajax({
						type: 'POST', //tipo de requisição
						url: '../router.php?controller=login&modo=logar', //url onde será enviada a requisição
						data: new FormData($('#frmLogin')[0]), //enviando os dados do formulário
						cache: false,
						contentType: false,
						processData: false,
						async: true,
						success: function(dados){
                            json = JSON.parse(dados);

							//verificando o retorno dos dados
							if(json.status == 'sucesso'){
								//se for verdadeiro, redireciona pro login
								window.location.href="../index.php";
							}else{
								//se for falso, mostra mensagem de esrro
								mostrarErro('Usuário ou Senha incorretos!!');
							}
						}
					});
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
                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>
        </div>
        <header>
            <div class="menu_principal_logo">
                <div class="menu_responsivo">
                    <img id="menu" src="icones/menu_responsivo.png">
                    <div class="submenu_responsivo" id="submenu">
                        <div class="submenu_responsivo_itens">
                            <div id="categorias">
                                Categorias
                            </div>

                            <div class="menu_responsivo_categorias" id="menu_categoria">
                                <?php
                                    require_once('../controller/controllerCategoria.php');
                                    $listCategoria = new controllerCategoria();
                                    $rsCategoria = $listCategoria->listarCategoria();
                                    $cont = 0;
                                    while($cont < count($rsCategoria)){
                                ?>
                                <div class="categorias_responsivo_itens categoria_item">
                                    <?php echo($rsCategoria[$cont]->getNome()) ?>

                                    <div class="subcategorias_responsivo" id="subcategorias">

                                    <?php
                                        require_once('../controller/controllerCategoria.php');
                                        $listSubcategoria = new controllerCategoria();
                                        $rsSubcategoria = $listSubcategoria->listarSubcategoria($rsCategoria[$cont]->getId());
                                        $index = 0;
                                        while($index < count($rsSubcategoria)){    
                                    ?>
                                        <div class="subcategorias_responsivo_itens">
                                            <a href="visualizar_subcategoria.php?idSubcategoria=<?php echo($rsSubcategoria[$index]->getId()) ?>&mobile=true">
                                                <?php
                                                    echo($rsSubcategoria[$index]->getNome());
                                                ?>
                                            </a>
                                        </div>
                                    <?php
                                        $index++;
                                        }
                                    ?>
                                    </div>
                                </div>

                            <?php
                                $cont++;
                                }
                            ?>

                            </div>
                        </div>

                        <div class="submenu_responsivo_itens">
                            <a href="fale_conosco.php">
                                Fale Conosco
                            </a>
                        </div>

                        <div class="submenu_responsivo_itens">
                            <a href="nossas_lojas.php">
                                Nossas Lojas
                            </a>
                        </div>

                        <div class="submenu_responsivo_itens">
                            <a href="sobre.php">
                                Sobre
                            </a>
                        </div>
                    </div>
                </div>
                <a href="../index.php">
                    <div class="logo_centro">
                        <img src="imagens/logoBrecho3.png" alt="#">
                    </div>
                </a>
            </div>

        </header>
        <main>
            <div class="linha">
                Autenticação
            </div>
            <div class="fundo_login">
                <div class="login_centro">
                    <div class="dados">
                        <div class="titulo_login">
                                Já Sou Cliente
                        </div>
                        <form method="POST" id="frmLogin">
                            <div class="caixa_campos">
                                Usuário:
                                <div class="campos">

                                    <input class="campos_login" type="text" name="txtLogin" required>
                                </div>
                                Senha:
                                <div class="campos">
                                    <input class="campos_login" type="password" name="txtSenha" required>
                                </div> 
								
								<div class="campos">
                                	<label>
										<input type="radio" name="txtcliente" value="F" id="txtcliente" onClick="mostrarFormulario('F')" checked> Físico
									</label>

									<label>
										<input type="radio" name="txtcliente" value="J" id="txtcliente" onClick="mostrarFormulario('J')"> Jurídico
									</label>
                                </div>
								
                                <div class="campos">
                                    <input class="botao_login" id="logar" type="submit" value="Acessar Conta">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="divisao">

                    </div>
                    <div class="dados">
                        <div class="titulo_login">
                                Criar Conta
                        </div>
                        <form action="cadastro_usuario.php" method="post">
                            <div class="caixa_campos_direita">
                                E-mail:
                                <div class="campos">

                                    <input class="campos_login" name="txtemail" type="email">
                                </div>
                                <div class="campos">
                                </div>
                                <div class="campos_direita">
                                     <input class="botao_login" type="submit" value="Proximo">
                                </div>
                            </div>
                        </form>
                    </div>
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
