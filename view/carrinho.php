<?php
    require_once('arquivos/check_login.php');
    
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/funcoes.js"></script>
		<script src="js/jquery-3.2.1.min.js"></script>
		<script>
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
            });
            
            //função para remover o item do carrinho
            function removerItem(id){
                $.ajax({
                    type: 'POST', //tipo de requisição
                    url: '../router.php?controller=produto&modo=removerItem', //url onde será enviada a requisição
                    data: {id:id}, //parâmetros enviados
                    success: function(dados){
                        //removendo o item do HTML
                        $('#item'+id).parent().remove();
                        
                        //atualizando o valor
                        $('#total').html('R$ '+dados);
                    }
                });
            }
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
        <main>
            <div class="linha">
                Carrinho           
            </div>
            
            <div class="carrinho_full">
                <div class="caixa_carrinho">
                    <div class="carrinho_esquerda">
                       
                        <div class="itens_carrinho">

                            <?php
                                $cont = 0;
                                foreach($_SESSION['carrinho'] as $produtos){
                            ?>

                            <div class="produto_carrinho">
                                <img src="icones/remover.png" id="item<?php echo($produtos['id']) ?>" onClick="removerItem(<?php echo($produtos['id']) ?>)">
                                <div class="foto_carrinho">
                                    <img alt="#"  src="../cms/view/arquivos/<?php echo($produtos['imagem']) ?>">
                                </div>
                                <div class="informacao_carrinho">
                                    <div class="informacao_carrinho">
                                        <div class="informacao_linha">
                                            Produto: <?php echo($produtos['nome']) ?>
                                        </div>
                                        <div class="informacao_linha">
                                            Tamanho: <?php echo($produtos['tamanho']) ?>
                                        </div>
                                        <div class="informacao_linha">
                                            Cor: <?php echo($produtos['cor']) ?>
                                        </div>
                                        <div class="informacao_linha">
                                            R$ <?php echo($produtos['preco']) ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                        <?php
                            $cont++;
                            }
                        ?> 

                        </div> 
                    </div>
                    <div class="caixa_total_carrinho">
                        <div class="linha_titilo_total">
                            Total
                        </div> 
                        <div class="linha_valor_total" id="total">
                            R$ <?php echo($_SESSION['total']) ?>
                        </div>
                        <div class="linha_botao_comprar_carrinho">
                            <form action="dados_pagamento.php">
                                <input class="botao_cadastro" type="submit" value="Comprar">
                            </form>
                        </div>
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