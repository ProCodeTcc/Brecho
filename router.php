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
            require_once('controller/controllerEndereco.php');
            
            $controllerClienteFisico = new controllerClienteFisico();
            $controllerClienteFisico->inserirCliente();
            
            $controllerEndereco = new controllerEndereco();
            $controllerEndereco->inserirEndereco();
            
		break;
			
		case 'avaliação':
			$modo = $_GET['modo'];
			require_once('controller/controllerAvaliacao.php');
			switch($modo){
				case 'cadastrar':
					$controllerAvaliacao = new controllerAvaliacao();
					$controllerAvaliacao->inserirProduto();
				break;
				
				case 'listarCor':
					$controllerAvaliacao = new controllerAvaliacao();
					$listCor = $controllerAvaliacao->listarCor();
					
					echo($listCor);
				break;
					
				case 'listarMarca':
					$controllerAvaliacao = new controllerAvaliacao();
					$listMarca = $controllerAvaliacao->listarMarca();
					
					echo($listMarca);
				break;
					
				case 'listarCategoria':
					$controllerAvaliacao = new controllerAvaliacao();
					$listCategoria = $controllerAvaliacao->listarCategoria();
					
					echo($listCategoria);
				break;
					
				case 'buscarTamanho':
					$tipo = $_GET['tipo'];
					$controllerAvaliacao = new controllerAvaliacao();
					$listTamanho = $controllerAvaliacao->listarTamanho($tipo);
					
					echo($listTamanho);
				break;
			}
		break;
        
    }
?>