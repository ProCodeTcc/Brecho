<?php
	session_start();
	
	if(isset($_SESSION['idCliente'])){
		$id = $_SESSION['idCliente'];
	}else{
		$id = null;
	}

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerClienteFisico.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.mask.js"></script>
		
		<script>
			function exibirDados(id){
				$.ajax({
					type: 'POST',
					url: '../router.php?controller=ClienteFisico&modo=buscar',
					data: {id:id},
					success: function(dados){
						json = JSON.parse(dados);
						
						$("#txtemail").val(json.email);
						$('#txtsenha').val(json.senha);
						$('#txtnome').val(json.nome);
						$('#txtsobrenome').val(json.sobrenome);
						$('#txttelefone').val(json.telefone);
						$('#txtcelular').val(json.celular);
						$('#txtdata').val(json.dataNascimento);
						$('#txtcep').val(json.cep);
						$('#txtbairro').val(json.bairro);
						$('#txtlogradouro').val(json.logradouro);
						$('#txtestado').val(json.estado);
						$('#txtcidade').val(json.cidade);
						$('#txtnumero').val(json.numero);
						$('#txtcomplemento').val(json.complemento);
						$('#frmAtualizar').data('idEndereco', json.idEndereco);
					}
				});
			}
			
			$(document).ready(function(){
				var id = $('#frmAtualizar').data('id');
				if(id != ""){
					exibirDados(id);
				}
				
				$('#txtcep').blur(function(){
					var cep = $('#txtcep').val();
					
					$('#txtbairro').val('...');
					$('#txtlogradouro').val('...');
					$('#txtestado').val('...');
					$('#txtcidade').val('...');
					$('#txtnumero').val('...');
					$('#txtcomplemento').val('...');
					
					$.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(dados){
						$('#txtbairro').val(dados.bairro);
						$('#txtlogradouro').val(dados.logradouro);
						$('#txtestado').val(dados.uf);
						$('#txtcidade').val(dados.localidade);
					});
					
				});
				
				$('#frmAtualizar').submit(function(e){
					e.preventDefault();
					var idEndereco = $('#frmAtualizar').data('idEndereco');
					var formulario = new FormData($('#frmAtualizar')[0]);
					formulario.append('id', id);
					formulario.append('idEndereco', idEndereco);
					
					$.ajax({
						type: 'POST',
						url: '../router.php?controller=ClienteFisico&modo=atualizar',
						data: formulario,
						cache: false,
						contentType: false,
						processData: false,
						async: true,
						success: function(dados){
							alert(dados);
						}
					});
					
				});
			});
            
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
		</script>
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
                                    <a  href="login.php">
                                        <div class="icone_login">
                                            <img alt="#"  src="icones/login.png">
                                        </div>
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
                    Atualizar Dados
                </div>
                
                <div class="caixa_atualizar_dados">
                    <div class="titulo_atualizar">
                        Atualizar Informações da Conta 
                    </div>
					
                    <form method="POST" id="frmAtualizar" name="frmAtualizar" class="atualizar" data-id="<?php echo($id) ?>">
                        <div class="informacao_conta">
                             <div class="titulo_cadastro_usuario">
                                E-mail*
                            </div>
                            <div class="linha_cadastro_usuario">
                                <input class="campo_cadastro_usuario" type="email" id="txtemail" name="txtemail">
                            </div>

                             <div class="titulo_cadastro_usuario_meio">
                                Senha*
                            </div>
                            <div class="titulo_cadastro_usuario_meio">
                                Confirme Senha*
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="password" name="txtsenha" id="txtsenha">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="password">
                            </div>
                        </div>

                        <div class="titulo_atualizar">
                            Atualizar Informações Pessoais 
                        </div>
                    
                        <div class="informacao_conta">
                             <div class="titulo_cadastro_usuario_meio">
                                Nome*
                            </div>
                            <div class="titulo_cadastro_usuario_meio">
                                Sobrenome*
                             </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txtnome" id="txtnome" required onkeypress="return validar(event,'number')">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txtsobrenome" id="txtsobrenome" required onkeypress="return validar(event,'number')">
                            </div>

                             <div class="titulo_cadastro_usuario_meio">
                                Telefone*
                            </div>
                             <div class="titulo_cadastro_usuario_meio">
                                Celular
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txttelefone" id="txttelefone" required onkeypress="return validar(event,'caracter')">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio" type="text" name="txtcelular" id="txtcelular" required onkeypress="return validar(event,'caracter')">
                            </div>


                            <div class="titulo_cadastro_usuario_meio">
                                Sexo*
                             </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Data de Nascimento*
                             </div>

                            <div class="linha_cadastro_usuario_meio">
                                <label>
                                    <input type="radio" class="radio_sexo" value="M" name="rb_sexo"> Masculino
                                </label>    

                                <label>
                                    <input type="radio" class="radio_sexo" value="F" name="rb_sexo"> Feminino
                                </label>    

                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="date" name="txtdata" id="txtdata">
                            </div>

                        </div>
                        
                        <div class="titulo_atualizar">
                            Adicionar Cartão 
                        </div>
                    
                        <div class="informacao_conta">
                             <div class="titulo_cadastro_usuario">
                                Nome do Titular*
                            </div>
                            <div class="linha_cadastro_usuario">
                                <input class="campo_cadastro_usuario" type="text" required onkeypress="return validar(event,'number')">
                            </div>
                           
                            <div class="titulo_cadastro_usuario">
                                Numero do Cartão*
                            </div>
                            <div class="linha_cadastro_usuario">
                                <input class="campo_cadastro_usuario" type="text"required onkeypress="return validar(event,'caracter')">
                               
                            </div>
                            <div class="titulo_cadastro_usuario_mini">
                                Cód de Segurança*
                             </div>
                            
                            <div class="titulo_cadastro_usuario_mini">
                                Vencimento*
                             </div>
                            
                            <div class="titulo_cadastro_usuario_mini">
                                Bandeira*
                             </div>

                            <div class="linha_cadastro_usuario_mini">
                                <input class="campo_cadastro_usuario_mini" type="text" required onkeypress="return validar(event,'caracter')" maxlength="4">
                            </div>
                            
                            <div class="linha_cadastro_usuario_mini">
                               
                                <select  class="campo_cadastro_usuario_mini"> 
                                    <option>01/20</option>
                                </select>
                            </div>
                            
                            <div class="linha_cadastro_usuario_mini">
                                 <select  class="campo_cadastro_usuario_mini" >
                                     <option>Visa</option>
                                     <option>Mastercard</option>
                                     <option>Elo</option>
                                </select>
                            </div>
                        </div>

                        <div class="titulo_atualizar">
                            Atualizar Informações de Endereço 
                        </div>
                        <div class="informacao_conta">
                            <div class="titulo_cadastro_usuario_meio">
                                CEP*
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Bairro*
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input id="txt_cep" class="campo_cadastro_usuario_meio" type="text" onkeypress="return validar(event,'caracter')" name="txtCep">
                                <script type="text/javascript">$("#txt_cep").mask("00000-000");</script>
                                
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input type="text" class="campo_cadastro_usuario" id="txtbairro" name="txtbairro"onkeypress="return validar(event,'number')">
                            </div>


                            <div class="titulo_cadastro_usuario">
                                Logradouro*
                            </div>

                            <div class="linha_cadastro_usuario">
                                <input class="campo_cadastro_usuario" type="text" name="txtlogradouro" id="txtlogradouro" onkeypress="return validar(event,'number')">
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Estado*
                             </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Cidade*
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="text" name="txtestado" id="txtestado"onkeypress="return validar(event,'number')">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input class="campo_cadastro_usuario_meio"  type="text" name="txtcidade" id="txtcidade" onkeypress="return validar(event,'number')">
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Nº*
                            </div>

                            <div class="titulo_cadastro_usuario_meio">
                                Complemento
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="text" id="txtnumero" name="txtnumero" onkeypress="return validar(event,'caracter')">
                            </div>

                            <div class="linha_cadastro_usuario_meio">
                                <input  class="campo_cadastro_usuario_meio" type="text" id="txtcomplemento" name="txtcomplemento">
                            </div>
                            <div class="linha_cadastro_usuario_botao">
                           		<input class="botao_cadastro" type="submit" value="Atualizar">
                            </div>
                            
                        </div>
                    </form>
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