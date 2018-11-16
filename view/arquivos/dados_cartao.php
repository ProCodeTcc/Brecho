<?php
    session_start();
    $tipoCliente = $_SESSION['tipoCliente'];
    $id = $_SESSION['idCliente'];
?>

<script>
    $(function(){
        sliderCartao('#cartao', '#prev', '#next');
        
        $('.editar').click(function(){
            $('.container_modal').fadeIn(400); 
            $('.modal').height(300);
        });
    })
</script>

<img src="icones/prev.png" id="prev">
<div class="cartao_itens" id="cartao">
<?php
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
    require_once($diretorio.'/controller/controllerCartao.php');
    $controllerCartao = new controllerCartao();
    $rsCartao = $controllerCartao->listarCartao($id, $tipoCliente);
    $cont = 0;
    while($cont < count($rsCartao)){
?>
     <div class="card_cartao">
        <p>
            <?php echo($rsCartao[$cont]->getTitular())  ?>
         </p>

        <p>
            <?php echo($rsCartao[$cont]->getNumero()) ?>
         </p>

        <p>
            <?php echo($rsCartao[$cont]->getCodigo()) ?>
         </p>

        <p>
            <?php echo($rsCartao[$cont]->getVencimento()) ?>
         </p>
        <div class="acoes">
            <img class="adicionar" src="icones/ativar.png" onclick="adicionar()">
            <img class="editar" src="icones/pencil.png" onclick="buscarCartao(<?php echo($rsCartao[$cont]->getId()) ?>)">
            <img src="icones/delete16.png" onclick="excluirCartao(<?php echo($rsCartao[$cont]->getId()) ?>)">
        </div>
    </div>
    <?php
        $cont++;
        }
    ?>

</div>
<img src="icones/next.png" id="next">