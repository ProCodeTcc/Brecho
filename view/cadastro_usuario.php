<?php
	require_once('arquivos/check_login.php');
    
    if(isset($_POST['txtemail'])){
        $email = $_POST['txtemail'];
        $_SESSION['email'] = $email;
    }else{
        $email == '';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
         
        <script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
        <script src="js/jquery.mask.js"></script>
        
        <script>
            
            function validar (caracter,blockType){
                if(window.event){
                    var letra = caracter.charCode;
                }else{
                    var letra = caracter.which;
                }
                
                if (blockType == 'caracter'){
                    if(letra<48 || letra>57){
                        if(letra !=8 && letra!=32){
                            alert('Você não pode digitar letras neste campo');
                            return false;
                        }
                    }
                }else if(blockType == 'number'){
                    if(letra >=48 && letra<=57){
                        alert('Você não pode digitar numeros neste campo');
                        return false;
                    }
                }
            }
			
			//função para mostrar o formulário
			function mostrarFormulario(tipoCliente){
				//verifica qual o tipo do cliente
				if(tipoCliente == 'F'){
					$('#formulario').empty();
					$.ajax({
						type: 'POST',
						url: 'arquivos/form_fisico.php',
						success: function(dados){
							$('#formulario').html(dados);
						}
					});
				}else if(tipoCliente == 'J'){
					$('#formulario').empty();
					$.ajax({
						type: 'POST',
						url: 'arquivos/form_juridico.php',
						success: function(dados){
							$('#formulario').html(dados);
						}
					});
				}
			}
			
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
				
				$('.txt_cep').blur(function(){
					var cep = $('.txt_cep').val();
					$('.txtlogradouro').val('...');
					$('.txtbairro').val('...');
					$('.txtestado').val('...');
					$('.txtcidade').val('...');
					
					$.getJSON("https://viacep.com.br/ws/"+cep+"/json/", function(dados){
						$('.txtlogradouro').val(dados.logradouro);
						$('.txtbairro').val(dados.bairro);
						$('.txtestado').val(dados.uf);
						$('.txtcidade').val(dados.localidade);
					});
				});
				
				//função no submit do form
				$('#frmUsuario').submit(function(e){
					//desativando o submit
					e.preventDefault();

					//resgatando o url
					url = $('#frmUsuario').attr('action');

					$.ajax({
						type: 'POST', //tipo de requisição
						url: url, //url onde será enviada a requisição
						data: new FormData($('#frmUsuario')[0]), //dados enviados
						cache: false,
                        contentType: false,
                        processData: false,
						async: true,
						success: function(dados){
							//conversão dos dados para JSON
							json = JSON.parse(dados);

							//verificando o status
							if(json.status == 'sucesso'){
								//mensagem de sucesso
								mostrarSucesso('Cadastro efetuado com sucesso!!');
								redirecionarUsuario('../index.php');
							}else{
								//mensagem de erro
								mostrarErro('Ocorreu um erro ao efetuar o cadastro.');
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
                    Cadastro De Usuário
                </div>

                <div class="caixa_cadastro_usuario">
					<div id="erro_campo"></div>
					<div class="escolha_cliente">
						<div class="linha_cadastro_usuario">
							<label>
								<input type="radio" name="txtcliente" value="F" onClick="mostrarFormulario('F')" checked> Físico
							</label>

							<label>
								<input type="radio" name="txtcliente" value="J" onClick="mostrarFormulario('J')"> Jurídico
							</label>
						</div>
					</div>
					
                    <div class="cadastro_usuario" id="formulario">
                        <form method="POST" id="frmUsuario" action="../router.php?controller=ClienteFisico&modo=cadastrar" id="fisico">
							<div class="titulo_cadastro_usuario_meio">
								Nome*
							</div>
							<div class="titulo_cadastro_usuario_meio">
								Sobrenome*
							 </div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="text" name="txtNome" onkeypress="return validar(event,'number')" required>
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="text" name="txtSobrenome" onkeypress="return validar(event,'number')" required>
							</div>

							<div class="titulo_cadastro_usuario">
								E-mail*
							</div>
							<div class="linha_cadastro_usuario">
								<input class="campo_cadastro_usuario" type="email" onBlur="checkDados('ClienteFisico', 'Email', this)" name="txtEmail" required value="<?php echo($email) ?>">
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Usuario*
							</div>
							<div class="titulo_cadastro_usuario_meio">
								Senha*
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="text" name="txtUsuario" onBlur="checkDados('ClienteFisico', 'Usuario', this)" required>
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="password" name="txtSenha" required>
							</div>
							<div class="titulo_cadastro_usuario_meio">
								Data de Nascimento*
							</div>

							<div class="titulo_cadastro_usuario_meio">
								CPF*
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="date" name="txtDataNasc" required>
							</div>
							<div class="linha_cadastro_usuario_meio">
								<input id="txt_cpf" class="campo_cadastro_usuario_meio" type="text" onBlur="checkDados('ClienteFisico', 'Cpf', this)" name="txtCpf" onkeypress="return validar(event,'caracter')" required>
								<script>$("#txt_cpf").mask("000.000.000-00");</script>
							</div>


							<div class="titulo_cadastro_usuario_meio">
								Telefone*
							</div>
							 <div class="titulo_cadastro_usuario_meio">
								Celular
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input id="txt_telefone" class="campo_cadastro_usuario_meio" type="text" name="txtTelefone" onkeypress="return validar(event,'caracter')" required>
								<script>$("#txt_telefone").mask("(00) 0000-0000");</script>
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input id="txt_celular" class="campo_cadastro_usuario_meio" type="text" name="txtCelular" onkeypress="return validar(event,'caracter')">
								<script>$("#txt_celular").mask("(00) 00000-0000");</script>
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Sexo*
							 </div>


							<div class="linha_cadastro_usuario">
								<label>
									<input type="radio" class="radio_sexo" name="rb_sexo" checked value="M" required> Masculino
								</label>

								<label>
									<input type="radio" class="radio_sexo" name="rb_sexo" value="F"> Feminino
								</label>

							</div>


							<div class="titulo_cadastro_usuario_meio">
								CEP*
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Bairro*
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio txt_cep" type="text" onkeypress="return validar(event,'caracter')" name="txtCep" required>
								<script>$(".txt_cep").mask("00000-000");</script>
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input type="text" class="campo_cadastro_usuario txtbairro" id="txtbairro" name="txtbairro">
							</div>


							<div class="titulo_cadastro_usuario">
								Logradouro*
							</div>

							<div class="linha_cadastro_usuario">
								<input class="campo_cadastro_usuario txtlogradouro" id="txtlogradouro" type="text" name="txtLogradouro">
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Estado*
							 </div>

							<div class="titulo_cadastro_usuario_meio">
								Cidade*
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input  class="campo_cadastro_usuario_meio txtestado" type="text" id="txtestado" name="txtEstado">
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio txtcidade"  type="text" id="txtcidade" name="txtCidade">
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Nº*
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Complemento
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input  class="campo_cadastro_usuario_meio" type="text" name="txtNumero" required>
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input  class="campo_cadastro_usuario_meio" type="text" name="txtComplemento">
							</div>

							<div class="linha_cadastro_usuario_botao">
									<input class="botao_cadastro" type="submit" value="Cadastrar">
							</div>
						</form>
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
