<?php
    //verificando se existe o carrinho
    if(isset($_SESSION['carrinho'])){
        //armazena a quantidade de produtos numa variável
        $qtdItems = count($_SESSION['carrinho']);
        // echo($qtdItems);
    }else{
        //seta a quantidade de produtos para 0;
        $qtdItems = 0;
        
        //instanciando o carrinho
        $_SESSION['carrinho'] = array();
        
        //instanciando o total
        $_SESSION['total'] = 0;
    }
?>