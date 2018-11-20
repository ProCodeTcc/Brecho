<?php
    require_once('arquivos/check_login.php');

    if(isset($_SESSION['login'])){
        if(!$_SESSION['total'] > 0){
            header('location: login.php');
        }
        
        
        $idCliente = $_SESSION['idCliente'];
        $tipoCliente = $_SESSION['tipoCliente'];
    }else{
        header('location: login.php');
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
            //função para finalizar o pedido
            function finalizarPedido(id, tipo){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: '../router.php?controller=cartao&modo=verificar', //parâmetros enviados
                    data: {id:id, tipo:tipo},
                    success: function(dados){
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);
                        
                        //verificando se o cliente possui um cartão ativo
                        if(json.status == 'desativado'){
                            //mensagem de erro
                            mostrarErro('Você não possui nenhum cartão ativo!!');
                            
                            //redirecionando o usuário
                            redirecionarUsuario('cartao.php?status=desativado');
                        }else{
                            //verificando o status do pagamento
                            var status = $('#dados').attr('data-pagamento');
                            
                            //verificando se é pra finalizar
                            if(status == 'finalizar'){
                                //mensagem de confirmação
                                mostrarDialogo('Deseja finalizar o pagamento?')
                            }
                        }
                    }
                });
            }
            
            //função para selecionar o cartão do cliente
            function selecionarCartao(id, tipo){
                $.ajax({
                   type: 'POST', //tipo de requisição
                    url: '../router.php?controller=cartao&modo=selecionar', //parâmetros enviados
                    data: {id:id, tipo:tipo},
                    success: function(dados){
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);
                        
                        //limpando os dados
                        $('.dados_esquedo').children('.linha_pagamento').empty();
                        
                        //preenchendo os dados do cartão
                        $('#txtnome').html('Titular: ' + json.nomeTitular);
                        $('#txtnumero').html('Número: ' + json.numeroCartao);
                        $('#txtvencimento').html('Vencimento: ' + json.vencimento);
                        $('#txtcodigo').html('Código: ' + json.codseguranca);
                        
                        //atualizando o status do pagamento
                        $('#dados').attr('data-pagamento', 'finalizar');
                        
                    }
                });
            }
            
            //função para verificar a opção escolhida pelo cliente
            function verificarOpcao(opcao){
                //se for sim
                if(opcao == 'sim'){
                    //redireciona o cliente
                    window.location.href='pedido_finalizado.php';
                }else{
                    //fecha a mensagem
                    $('.mensagens').fadeOut(400);
                }
            }
            
            $(document).ready(function(){
                var id = $('#dados').attr('data-id');
                var tipo = $('#dados').attr('data-tipo');
                
                //selecionando o cartão
                selecionarCartao(id, tipo);
                
                $('#frmPedido').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '../router.php?controller=pedido&modo=gerar',
                        data: new FormData($('#frmPedido')[0]),
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function(dados){
                            if(dados == 'sucesso'){
                                window.location.href="pedido_finalizado.php";
                            }else if(dados == 'erro'){
                                alert('Ocorreu um erro ao gerar o pedido!!');

                                window.location.href="carrinho.php";
                            }
                        }
                    });
                });
            });
        </script>
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
            
            <div class="mensagem-dialog" id="dialog">
                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
                
                <div class="dialog">
                    <div class="dialog-msg">
                        Deseja finalizar o pagamento?
                    </div>
                    
                    <div class="dialog_opcoes">
                        <div class="dialog-yes" onclick="verificarOpcao('sim')">
                            Sim
                        </div>

                        <div class="dialog-no" onclick="verificarOpcao('não')">
                            Não
                        </div>
                    </div>
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
                Dados Do Pagamento
            </div>
            <div class="caixa_dados_pagamento" id="dados" data-id="<?php echo($idCliente) ?>" data-tipo="<?php echo($tipoCliente) ?>">
                <div class="dados_esquedo">
                    <div class="titulo_pagamento">
                        Cartão de Crédito 
                    </div>
                    <div class="linha_pagamento" id="txtnumero">
                        Numero do Cartão: 0000 0000 0000 0000
                    </div>
                    <div class="linha_pagamento" id="txtnome">
                        Nome do Titular: Fulano da Silva
                    </div>
                    <div class="linha_pagamento" id="txtcodigo">
                        Código de Segurança: 000
                    </div>
                    <div class="linha_pagamento" id="txtvencimento">
                        Vencimento: 08/20
                    </div>
                    <div class="linha_pagamento">
                        Bandeira: Visa
                    </div>
                </div>
               
                <div class="dados_direito">
<!--
                    <div class="titulo_pagamento_direito">
                        RESUMO DO PEDIDO 
                    </div>
                    <div class="endereco_retirada">
                        <div class="linha_pagamento_titulo">
                            Endereço de Retirada
                        </div>
                        <div class="linha_pagamento">
                            Rua: Elton Silva
                        </div>
                        <div class="linha_pagamento">
                            Bairro: Centro
                        </div>
                        <div class="linha_pagamento">
                            Cidade:Jandira - SP
                        </div>
                        <div class="linha_pagamento">
                            CEP: 06600-025
                        </div>
                        <div class="linha_pagamento">
                            Telefone: (11)4002-8922
                        </div>
                    </div>
-->
                        
<!--
                        <div class="tabela_produto">
                            <div class="coluna_tabela_produto_maior">
                                Itens do Pedido
                            </div>
                            <div class="coluna_tabela_produto_menor">
                                Valor
                            </div>
                        </div>
-->
                    <div class="tabela_produto">
                        <div class="linha_titulo_produtos">
                            <div class="coluna_tabela_produto_maior">
                                Itens do Pedido
                            </div>
                            <div class="coluna_tabela_produto_menor">
                                Valor
                            </div>
                        </div>

                        <?php
                            foreach($_SESSION['carrinho'] as $produtos){                  
                        ?>
                        <div class="linha_item_produtos">
                            <div class="coluna_tabela_produto_maior">
                                <?php echo($produtos['nome']) ?>
                            </div>
                            <div class="coluna_tabela_produto_menor">
                                <?php
                                    $total = $_SESSION['total'];
                                    echo('R$'.number_format($total, 2, ',', '.'));
                                ?>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <div class="linha_botao_dados">
                        <input class="botao_login" type="submit" value="Comprar" onclick="finalizarPedido(<?php echo($idCliente) ?>, '<?php echo($tipoCliente) ?>')">
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