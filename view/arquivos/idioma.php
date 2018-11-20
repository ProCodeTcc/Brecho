<?php
    //verificando se o usuário escolheu um idioma
    if(isset($_GET['lang'])){
        //criando a variável de sessão com o idioma escolhido
        $_SESSION['idioma'] = $_GET['lang'];
    }

    //verificando se existe algum idioma escolhido
    if(empty($_SESSION['idioma'])){
        //cria a variável de sessão com o idioma padrão
        $_SESSION['idioma'] = 'ptbr';
    }
?>