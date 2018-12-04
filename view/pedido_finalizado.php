<?php
    if(isset($_GET['idPedido'])){
        //resgatando o ID do pedido
        $idPedido = $_GET['idPedido'];
        
        //verificando se já existe uma sessão
        if(session_id() == ''){
            //inicia a sessão
            session_start();
        }
        
        //limpa o carrinho
        unset($_SESSION['carrinho']);
        unset($_SESSION['total']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
            <?php require_once('arquivos/header.php') ?>
        </header>
        <main>
            <div class="linha">
                Pedido finalizado com sucesso!
            </div>
            <div class="pedido_finalizado">
                <div class="mensagem">
                    Seu pedido Nº<?php echo($idPedido) ?> foi finalizado com sucesso!! Nossos administradores irão agendar uma data para você realizar sua retirada. Quando isso acontecer, você será notificado por e-mail e poderá vir a nossa loja para retirar seu produto.

                </div>
                <div class="linha_botao_dados">
                    <form action="../index.php">
                        <input class="botao_login" type="submit" value="Voltar ao site">
                    </form>
                </div>

            </div>
        </main>
        <?php require_once('arquivos/footer.html') ?>
    </body>
</html>
