<?php
    //inclusão do arquivo que verifica o login
    require_once('arquivos/check_login.php');

    if(isset($_SESSION['login'])){
        //verificando se existe algum total
        if(!$_SESSION['total'] > 0){
            //se não, redireciona para a tela de login
            header('location: login.php');
        }
    }else{
        header('location: login.php');
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
        
        <script>
            //função para gerar o pedido
            function gerarPedido(){
                var qtdParcela = $('#qtdparcela').val();
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: '../router.php?controller=pedido&modo=gerar', //url onde será enviada a requisição
                    data: {qtdParcela:qtdParcela}, //parâmetros enviados
                    success: function(dados){
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);
                        
                        //verificando o status
                        if(json.dados.status == 'sucesso'){
                            //gerando uma duplicata e passando os parâmetros necessários
                            gerarDuplicata(json.dados.pedido, json.dados.parcelas, json.dados.dtPagamento, json.dados.valor);
                        }else if(dados == 'erro'){
                            alert('Ocorreu um erro ao gerar o pedido!!');

                            window.location.href="carrinho.php";
                        }
                    }
                });
            }
            
            //função para gerar a duplicata
            function gerarDuplicata(idPedido, qtdParcela, dtPagamento, valor){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: '../router.php?controller=pedido&modo=gerarDuplicata', //url onde será enviada a requisição
                    data: {pedido:idPedido, parcela:qtdParcela, pagamento:dtPagamento, valor:valor}, //parâmetros enviados
                    success: function(dados){
                        //conversão dos dados para JSON
                        json = JSON.parse(dados);
                        
                        //verificando o status
                        if(json.status == 'sucesso'){
                            //redireciona para a tela de pedido finalizado
                            window.location.href='pedido_finalizado.php?idPedido='+idPedido;
                        }
                    }
                });
            }
            
            $(document).ready(function(){
                if(verificarMobile == true){
                    submenuResponsivo();
                }
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
            <div class="caixa_dados_pagamento" id="dados">
                <div class="dados_esquedo">
                    <div class="titulo_pagamento">
                        Cartão de Crédito 
                    </div>
                    
                    <div class="linha_pagamento">
                        Numero do Cartão:
                    </div>
                    
                    <div class="linha_pagamento">
                        <input class="campo_cadastro_usuario_meio" type="text">
                    </div>
                    
                    <div class="linha_pagamento">
                        Nome do Titular:
                    </div>
                    
                    <div class="linha_pagamento">
                        <input class="campo_cadastro_usuario_meio" type="text">
                    </div>
                    
                    <div class="linha_pagamento">
                        Código de Segurança:
                    </div>
                    
                    <div class="linha_pagamento">
                        <input class="campo_cadastro_usuario_meio" type="text">
                    </div>
                    
                    <div class="linha_pagamento">
                        Vencimento:
                    </div>
                    
                    <div class="linha_pagamento">
                        <input class="campo_cadastro_usuario_meio" type="text">
                    </div>
                    
                    <div class="linha_pagamento">
                        Parcelas:
                    </div>
                    
                    <div class="linha_pagamento">
                        <select class="campo_cadastro_usuario_meio" id="qtdparcela">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
               
                <div class="dados_direito">
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
                            //percorrendo os produtos do carrinho
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
                        <input class="botao_login" type="submit" value="Comprar" onclick="gerarPedido()">
                    </div>
                </div>
            </div>
        </main>
        <?php require_once('arquivos/footer.html') ?>
    </body>
</html>