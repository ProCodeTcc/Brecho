<?php
    if(isset($_SESSION['carrinho'])){
        $qtdItems = count($_SESSION['carrinho']);
        // echo($qtdItems);
    }else{
        $qtdItems = 0;
        $_SESSION['carrinho'] = array();
        $_SESSION['total'] = 0;
    }
?>