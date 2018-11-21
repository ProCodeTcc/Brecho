<?php
	session_start();

	if(isset($_SESSION['login'])){
		$login = 1;
	}else{
		$login = 0;
	}

    if(isset($_SESSION['atividade']) && (time() - $_SESSION['atividade'] > 1800)){
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
    $_SESSION['atividade'] = time();
?>