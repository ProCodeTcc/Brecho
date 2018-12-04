<?php
    //ininio da sessão
	session_start();

    //verificando se existe a sessão de login
	if(isset($_SESSION['login'])){
        //seta o login para 1
		$login = 1;
	}else{
        //seta o login para 0
		$login = 0;
	}

    //verificando se o usuárioe stá ativo no site
    if(isset($_SESSION['atividade']) && (time() - $_SESSION['atividade'] > 1800)){
        //limpa todas as sessões do usuário
        unset($_SESSION['email']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['total']);
        unset($_SESSION['idioma']);
        unset($_SESSION['login']);
        unset($_SESSION['idCliente']);
        unset($_SESSION['tipoCliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['sexo']);
        unset($_SESSION['atividade']);
    }
    //incrementa o tempo ativo
    $_SESSION['atividade'] = time();
?>