<?php
	require_once('arquivos/check_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
         
        <script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
        <script src="js/jquery.mask.js"></script>
        
        <script type="text/javascript">
            
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
				
				
			});
 
        </script>
        
    </head>
    <body>
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
					
					<div class="escolha_cliente">
						<div class="linha_cadastro_usuario">
							<label>
								<input type="radio" name="txtcliente" value="F" id="txtcliente" onClick="mostrarFormulario('F')" checked> Físico
							</label>

							<label>
								<input type="radio" name="txtcliente" value="J" id="txtcliente" onClick="mostrarFormulario('J')"> Jurídico
							</label>
						</div>
					</div>
					
                    <div class="cadastro_usuario" id="formulario">
                        <form method="POST" action="../router.php?controller=ClienteFisico&modo=cadastrar" id="fisico">
							<div class="titulo_cadastro_usuario_meio">
								Nome*
							</div>
							<div class="titulo_cadastro_usuario_meio">
								Sobrenome*
							 </div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="text" name="txtNome" required onkeypress="return validar(event,'number')">
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="text" name="txtSobrenome" required onkeypress="return validar(event,'number')">
							</div>

							<div class="titulo_cadastro_usuario">
								E-mail*
							</div>
							<div class="linha_cadastro_usuario">
								<input class="campo_cadastro_usuario" type="email" name="txtEmail" required>
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Usuario*
							</div>
							<div class="titulo_cadastro_usuario_meio">
								Senha*
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input class="campo_cadastro_usuario_meio" type="text" name="txtUsuario" required>
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
								<input id="txt_cpf" class="campo_cadastro_usuario_meio" type="text" name="txtCpf"required onkeypress="return validar(event,'caracter')">
								<script type="text/javascript">$("#txt_cpf").mask("000.000.000-00");</script>
							</div>


							<div class="titulo_cadastro_usuario_meio">
								Telefone*
							</div>
							 <div class="titulo_cadastro_usuario_meio">
								Celular
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input id="txt_telefone" class="campo_cadastro_usuario_meio" type="text" name="txtTelefone"required onkeypress="return validar(event,'caracter')">
								<script type="text/javascript">$("#txt_telefone").mask("(00) 0000-0000");</script>
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input id="txt_celular" class="campo_cadastro_usuario_meio" type="text" name="txtCelular"onkeypress="return validar(event,'caracter')">
								<script type="text/javascript">$("#txt_celular").mask("(00) 00000-0000");</script>
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Sexo*
							 </div>


							<div class="linha_cadastro_usuario">
								<label>
									<input type="radio" class="radio_sexo" name="rb_sexo" checked value="M"> Masculino
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
								<input class="campo_cadastro_usuario_meio txt_cep" type="text" onkeypress="return validar(event,'caracter')" name="txtCep">
								<script type="text/javascript">$(".txt_cep").mask("00000-000");</script>
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
								<input class="campo_cadastro_usuario_meio txtestado"  type="text" id="txtcidade" name="txtCidade">
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Nº*
							</div>

							<div class="titulo_cadastro_usuario_meio">
								Complemento
							</div>

							<div class="linha_cadastro_usuario_meio">
								<input  class="campo_cadastro_usuario_meio" type="text" name="txtNumero">
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
