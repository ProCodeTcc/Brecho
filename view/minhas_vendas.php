<?php
	require_once('arquivos/check_login.php');

	if($_SESSION['login'] != true){
		header('location: login.php');
    }
    
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
		
		<script>
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
            });
            
            function filtrarPedidos(){
                var tipoFiltro = $('#txtfiltro').val();

                if(tipoFiltro == 1){
                    $('#produtos').find('.itens_vendas').not('.avaliacao').hide();
                    $('.avaliacao').show();
                }else if(tipoFiltro == 2){
                    $('#produtos').find('.itens_vendas').not('.compra').hide();
                    $('.compra').show();
                }else{
                    $('#produtos').find('.itens_vendas').not('.venda').hide();
                    $('.venda').show();
                }
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
                Minhas Vendas           
            </div>
            <div class="vendas_centro">
                <form action="cadastro_produto.php">
                    <div class="filtro_pedidos">
                        <select id="txtfiltro" onChange="filtrarPedidos()">
                            <option value="0">filtrar pedidos</option>
                            <option value="1">Avaliação</option>
                            <option value="2">Compras</option>
                            <option value="3">Vendas</option>
                        </select>
                    </div>
                    <div class="linha_vender_produtos_botao">    
                        <a href="../view/perfil.php">
                            <input class="botao_voltar" type="button" value="Voltar">
                        </a>
                        <input class="botao_cadastro" type="submit" value="Vender Produto">
                    </div>
                </form>
                <div class="caixa_vendas" id="produtos">
                    <div class="titulo_vendas">
                        <div class="titulo_produtos_vendas">
                            Produtos
                        </div>
                        <div class="titulo_menor_produtos_vendas">
                            Valor
                        </div>
                        <div class="titulo_menor_produtos_vendas">
                            Data
                        </div>
                        <div class="titulo_menor_produtos_vendas_final">
                            Status
                        </div>
                    </div>

                    <?php
                        require_once($diretorio.'/controller/controllerAvaliacao.php');
                        $listProduto = new controllerAvaliacao();
                        $cont = 0;
                        $rsProduto = $listProduto->filtrarPedido($_SESSION['tipoCliente'], $_SESSION['idCliente']);

                        while($cont < count($rsProduto)){
                    ?>
                    
                    <div class="itens_vendas avaliacao">
                        <div class="produto_vendas">
                            <?php echo($rsProduto[$cont]->getNome()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            R$: <?php echo($rsProduto[$cont]->getPreco()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            <?php echo($rsProduto[$cont]->getData()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            Vendido
                        </div>
                    </div>

                <?php
                    $cont ++;
                        }
                ?>

                <?php
                        require_once($diretorio.'/controller/controllerPedido.php');
                        $listProduto = new controllerPedido();
                        $cont = 0;
                        $rsProduto = $listProduto->filtrarCompra($_SESSION['tipoCliente'], $_SESSION['idCliente']);

                        while($cont < count($rsProduto)){
                    ?>
                    
                    <div class="itens_vendas compra">
                        <div class="produto_vendas">
                            <?php echo($rsProduto[$cont]->getNome()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            R$: <?php echo($rsProduto[$cont]->getPreco()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            <?php echo($rsProduto[$cont]->getDtPedido()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            Vendido
                        </div>
                    </div>

                <?php
                    $cont ++;
                        }
                ?>

                <?php
                        require_once($diretorio.'/controller/controllerPedido.php');
                        $listProduto = new controllerPedido();
                        $cont = 0;
                        $rsProduto = $listProduto->filtrarVenda($_SESSION['tipoCliente'], $_SESSION['idCliente']);

                        while($cont < count($rsProduto)){
                    ?>
                    
                    <div class="itens_vendas venda">
                        <div class="produto_vendas">
                            <?php echo($rsProduto[$cont]->getNome()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            R$: <?php echo($rsProduto[$cont]->getPreco()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            <?php echo($rsProduto[$cont]->getDtPedido()) ?>
                        </div>
                         <div class="detalhe_vendas">
                            Vendido
                        </div>
                    </div>

                <?php
                    $cont ++;
                        }
                ?>

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