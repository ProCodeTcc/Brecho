<?php
    require_once('arquivos/check_login.php');
    $tipoCliente = $_SESSION['tipoCliente'];
    $id = $_SESSION['idCliente'];
    
    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }else{
        $status = '';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/funcoes.js"></script>
		<script src="js/jquery.js"></script>
        <script src="js/jquery.cycle.all.js"></script>
        <script src="js/jquery.film_roll.js"></script>
        <script src="js/jquery.mask.js"></script>
		<script>
            function adicionar(){
                $('.container_modal').fadeIn(400);
                $('#frmCartao').trigger('reset');
            }
            
            //função para se existe algum cartão
            function verificarCartao(){
                //pegando os dados do resultado
                var resultado = $.trim($('#dados').html()).length;
                
                //verificando os resultados
                if(resultado == 157){
                    //mostrando a div para adicionar cartão
                    $('.addCartao').show();
                    
                    //removendo os dados restantes
                    $('#dados').empty();
                    
                    $('.cartao_full').hide();
                }
            }
            
            //função para verificar se o usuário ativou o cartão
            function validarStatus(){
                //armazendando o status em uma variável
                var ativo = $('#prosseguir').attr('data-ativo');
                
                //verificando se foi ativado
                if(ativo == 'false'){
                    //se não foi, mostra uma mensagem
                    mostrarInfo('Você deve ativar um cartão para prosseguir com o pagamento');
                }else if(ativo == 'true'){
                    //se foi, mostra outra mensagem
                    mostrarInfo('Você será redirecionado para continuar com o pagamento');
                    
                    //redireciona o usuário
                    redirecionarUsuario('dados_pagamento.php?status=ativo');
                }
            }
            
            //função para listar os cartões
            function listar(){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: 'arquivos/dados_cartao.php', //url onde será enviada a requisição
                    success:function(dados){
                        //mostrando os dados
                        $('#dados').html(dados);
                        
                        //verificando os dados
                        verificarCartao();
                    }
                });
            }
            
            //função para atualizar o status
            function atualizarStatus(id, status){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: '../router.php?controller=cartao&modo=status', //parâmetros enviados
                    data: {id:id, status:status}, //dados enviados
                    success: function(dados){
                        //listando os dados com o status atualizado
                        listar();
                        
                        //armazenando o status do cartão em uma variável
                        var cartaoativo = $('#dados').attr('data-status');
                        
                        //verificando se está desativado
                        if(cartaoativo == 'desativado'){
                            //verificando se está ativando o cartão
                            if(status == 0){
                                //mudando o status do data-atributo
                                $('#prosseguir').attr('data-ativo', 'true');
                            }
                        }
                    }
                });
            }
            
            //função para buscar os dados de um cartão
            function buscarCartao(id){
                $.ajax({
                   type: 'POST', //tipo de requisição
                    url: '../router.php?controller=cartao&modo=buscarCartao', //url onde será enviada a requisição
                    data: {id:id}, //parâmetros enviados
                    success: function(dados){
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);
                        
                        //colocando os valores nas caixas de texto
                        $('#txttitular').val(json.nomeTitular);
                        $('#txtcartao').val(json.numeroCartao);
                        $('#txtcodigo').val(json.codseguranca);
                        $('#txtvencimento').val(json.vencimento);
                        $('#frmCartao').attr('data-id', json.idCartao);
                        $('#frmCartao').attr('data-modo', 'editar');
                    }
                });
            }
            
            //função para excluir o cartão
            function excluirCartao(id){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: '../router.php?controller=cartao&modo=excluir', //url onde será enviada a requisição
                    data: {id:id}, //parâmetros enviados
                    success: function(dados){
                        //listagem dos dados
                        listar();
                        
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);
                        
                        //verificando o status
                        if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao excluir o cartão');
                        }
                    }
                });
            }
            
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
                listar();
                
                //armazenando o status em uma variável
                var status = $('#dados').attr('data-status');
                
                //verificando se está desativado
                if(status == 'desativado'){
                    //mostra uma mensagem
                    mostrarInfo('Você deve selecionar ativar um cartão para prosseguir com o pagamento');
                    
                    //mostra o botão para prosseguir
                    $('#prosseguir').show();
                }
                
                $('#frmCartao').submit(function(e){
                   e.preventDefault();
                    
                    //armazenando o formulario em uma variável
                    var formulario = new FormData($('#frmCartao')[0]);
                    
                    //armazenando o modo em uma variável
                    var modo = $('#frmCartao').attr('data-modo');
                    
                    //armazenando o ID em uma variável
                    var id = $('#frmCartao').attr('data-id');
                    
                    //verificando o modo
                    if(modo == 'editar'){
                        //atualizando a url
                        url = '../router.php?controller=cartao&modo=editar';
                        
                        //setando o ID no formulário
                        formulario.set('id', id);
                    }else{
                        //url padrão de inserção
                        url = $('#frmCartao').attr('action');
                    }
                    
                    $.ajax({
                       type: 'POST', //tipo de requisição
                        url: url, //url onde será enviada a requisição
                        data: formulario, //dados enviados
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function(dados){
                            //conversão dos dados para JSON
                            json = JSON.parse(dados);
                            
                            //verificando o modo
                            if(modo != 'editar'){
                                if(json.status == 'sucesso'){
                                    //mensagem de sucesso
                                    mostrarSucesso('Cartao inserido com sucesso');
                                    
                                    //listando os dados
                                    listar();
                                    
                                    //mostrando os dados
                                    $('.cartao_full').show();
                                }else if(json.status == 'erro'){
                                    //mensagem de erro
                                    mostrarErro('Ocorreu um erro ao adicionar o cartao');
                                }
                            }else{
                                if(json.status == 'atualizado'){
                                    //mensagem de sucesso
                                    mostrarSucesso('Cartão atualizado com sucesso');
                                    
                                    //mensagem de erro
                                    listar();
                                }else if(json.status == 'erro'){
                                    //mensagem de erro
                                    mostrarErro('Ocorreu um erro ao atualizar o cartão');
                                }
                            }
                        }
                    });
                });
                
                if(verificarMobile() == true){
                    //removendo os títulos dos inputs
                    $('#frmCartao').find('div.titulo_cadastro_usuario_mini').remove();
                    $('#frmCartao').find('div.titulo_cadastro_usuario').remove();
                    
                    //adicionando placeholders
                    $('#txtcartao').attr('placeholder', 'Número do Cartão');
                    $('#txttitular').attr('placeholder', 'Nome do Titular');
                    $('#txtcodigo').attr('placeholder', 'Cod. de Segurança');
                    $('#txtvencimento').attr('placeholder', 'Vencimento');
                
                    //trocando a classe do tamanho das linhas
                    $('div.linha_cadastro_usuario_mini').removeClass('linha_cadastro_usuario_mini').addClass('linha_cadastro_usuario');

                    //trocando a classe do tamanho dos campos
                    $('input.campo_cadastro_usuario_mini').removeClass('campo_cadastro_usuario_mini').addClass('campo_cadastro_usuario');
                }
            });
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
        <div class="container_modal">
            <div class="modal modal_cartao">
                <img class="close" src="icones/fechar.png" onclick="fecharModal()">
                <div class="informacao_conta">
                     <form name="frmCartao" id="frmCartao" method="post" action="../router.php?controller=cartao&modo=inserir&tipo=<?php echo($tipoCliente) ?>&id=<?php echo($id) ?>">
                        <div class="titulo_cadastro_usuario">
                        Nome do Titular*
                        </div>
                        <div class="linha_cadastro_usuario">
                            <input class="campo_cadastro_usuario" type="text" onkeypress="return validar(event,'number')" name="txttitular" id="txttitular">
                        </div>

                        <div class="titulo_cadastro_usuario">
                            Numero do Cartão*
                        </div>
                        <div class="linha_cadastro_usuario">
                            <input class="campo_cadastro_usuario" type="text" onkeypress="return validar(event,'caracter')" name="txtnumero" id="txtcartao">
                            <script type="text/javascript">$("#txtcartao").mask("0000.0000.0000.0000");</script>
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
                            <input class="campo_cadastro_usuario_mini" type="text" onkeypress="return validar(event,'caracter')" maxlength="3" name="txtcodigo" id="txtcodigo">
                        </div>

                        <div class="linha_cadastro_usuario_mini">

                            <input class="campo_cadastro_usuario_mini" type="text" onkeypress="return validar(event,'number')" maxlength="5" name="txtvencimento" id="txtvencimento">
                            <script type="text/javascript">$("#txtvencimento").mask("00/00");</script>
                        </div>

                        <div class="linha_cadastro_usuario_mini">
                             <select class="campo_cadastro_usuario_mini" name="txtbandeira">
                                 <option>Visa</option>
                                 <option>Mastercard</option>
                                 <option>Elo</option>
                            </select>
                        </div>

                        <div class="linha_cadastro_usuario_botao">
                            <input class="botao_cadastro" type="submit" value="enviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
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
                Cartão
            </div>
            
            <div class="cartao_full">
                <div class="cartao_container" id="dados" data-status="<?php echo($status) ?>">
                    
                </div>
            </div>
            
            <div class="addCartao">
                <h3>
                    O senhor não possui nenhum cartão. Que tal adicionar um?
                </h3>
                
                <div class="linha_cadastro_usuario_botao">
                    <div class="linha_cadastro_usuario_botao">
                        <input class="botao_cadastro" type="button" value="adicionar" onclick="adicionar()">
                    </div>
                </div>
            </div>
            
            <div id="prosseguir" data-ativo="false">
                    <input class="botao_cadastro" type="button" value="PROSSEGUIR" onclick="validarStatus()">
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