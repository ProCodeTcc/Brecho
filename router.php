<?php

	$controller = $_GET['controller'];	
	
	
    switch($controller){
		case 'enquete':
			$modo = $_GET['modo'];
			require_once('controller/controllerEnquete.php');
			switch($modo){
				case 'qtdA':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdA();
				break;
				
				case 'qtdB':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdB();
				break;
					
				case 'qtdC':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdC();
				break;
					
				case 'qtdD':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdD();
				break;
			}
		break;
		
		case 'FaleConosco':
            require_once('controller/controllerFaleConosco.php');
            
            $controllerFaleConosco = new controllerFaleConosco();
            $controllerFaleConosco->inserirFaleConosco();

        break;
            
        case 'ClienteFisico':
            require_once('controller/controllerClienteFisico.php');
            
            $controllerClienteFisico = new controllerClienteFisico();
            $controllerClienteFisico->inserirCliente();
        
    }
?>