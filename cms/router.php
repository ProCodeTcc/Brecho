<?php
    $controller = $_POST['controller'];

    switch($controller){
        case 'usuario':

        $modo = $_POST['modo'];
        require_once('controller/controllerUsuario.php');
        switch($modo){
            case 'inserir':

                $controllerUsuario = new controllerUsuario();
            
                $controllerUsuario->inserirUsuario();

            break;

            case 'buscar':
                $id = $_POST['id'];

                $controllerUsuario = new controllerUsuario();
                $list = $controllerUsuario->buscarUsuario($id);
                echo $list;
            break;

            case 'editar':
                $id = $_POST['id'];
                
                $controllerUsuario = new controllerUsuario();
                $controllerUsuario->atualizarContato($id);

            break;

            case 'excluir':
                $id = $_POST['id'];
                $controllerUsuario = new controllerUsuario();
                $controllerUsuario->excluirUsuario($id);
            break;

            case 'status':
                $id = $_POST['id'];
                $status = $_POST['status'];

                $controllerUsuario = new controllerUsuario();
                $controllerUsuario->atualizarStatus($id, $status);
            break;

            case 'logar':
                $usuario = $_POST['txtusuario'];
                $senha = $_POST['txtsenha'];

                $controllerUsuario = new controllerUsuario();
                
                $teste = $controllerUsuario->logarUsuario($usuario, $senha);

                return $teste;
            break;
				
			case 'deslogar':
				$controllerUsuario = new controllerUsuario();
				
				$controllerUsuario->deslogarUsuario();
			break;
        }
        break;
        
        case 'nivel':

        $modo = $_POST['modo'];
        require_once('controller/controllerNivel.php');
        switch($modo){
            case 'inserir':
                $controllerNivel = new controllerNivel();
                $controllerNivel->inserirNivel();
            break;

            case 'excluir':
                $id = $_POST['id'];
                $controllerNivel = new controllerNivel();
                $controllerNivel->excluirNivel($id);
            break;

            case 'buscar':
                $id = $_POST['id'];
                $controllerNivel = new controllerNivel();
                $listNivel = $controllerNivel->buscarNivel($id);
                echo $listNivel;
            break;
				
            case 'editar':
                $id = $_POST['id'];

                $controllerNivel = new controllerNivel();
                $controllerNivel->atualizarNivel($id);
            break;
				
			case 'permitir':
				$idNivel = $_POST['idNivel'];
				$idPagina = $_POST['idPagina'];
				
				$controllerNivel = new controllerNivel();
				$controllerNivel->permitirPagina($idNivel, $idPagina);
			break;
				
			case 'negar':
				$idNivel = $_POST['idNivel'];
				$idPagina = $_POST['idPagina'];
				
				$controllerNivel = new controllerNivel();
				$controllerNivel->retirarPermissao($idNivel, $idPagina);
			break;

            case 'status':
                $id = $_POST['id'];
                $status = $_POST['status'];

                $controllerNivel = new controllerNivel();
                $controllerNivel->atualizarStatus($id, $status);
            break;
        }
        break;

        case 'enquete':

        $modo = $_POST['modo'];
        require_once('controller/controllerEnquete.php');
        switch($modo){
            case 'inserir':
                $controllerEnquete = new controllerEnquete();
                $controllerEnquete->inserirEnquete();
            break;

            case 'buscar':
                $id = $_POST['id'];

                $controllerEnquete = new controllerEnquete();
                $listEnquetes = $controllerEnquete->buscarEnquete($id);
                
                echo($listEnquetes);

            break;
				
			case 'visualizar':
				//resgatando o id da enquete
				$id = $_POST['id'];
				
				$controllerEnquete = new controllerEnquete();
				$resultado = $controllerEnquete->buscarResultado($id);
				
				echo $resultado;
			break;

            case 'editar':
                $id = $_POST['id'];

                $controllerEnquete = new controllerEnquete();
                $controllerEnquete->atualizarEnquete($id);
            break;

            case 'excluir':
                $id = $_POST['id'];
                $controllerEnquete = new controllerEnquete();
                $controllerEnquete->excluirEnquete($id);
            break;

            case 'status':
                $id = $_POST['id'];
                $status = $_POST['status'];

                $controllerEnquete = new controllerEnquete();
                $controllerEnquete->atualizarStatus($id, $status);
            break;
        }
        break;
			
		case 'FaleConosco':
			$modo = $_POST['modo'];
			require_once('controller/controllerFaleConosco.php');
			switch($modo){
				case 'buscar':
					$id = $_POST['id'];
					$controllerFaleConosco = new controllerFaleConosco();
					$listFeedback = $controllerFaleConosco->buscarFeedback($id);
					
					echo($listFeedback);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					$controllerFaleConosco = new controllerFaleConosco();
					$controllerFaleConosco->excluirFeedback($id);
				break;
			}
		break;
		
		case 'sobre':
				$modo = $_POST['modo'];
				require_once('controller/controllerSobre.php');
				switch($modo){
					case 'inserirLayout':
						$controllerSobre = new controllerSobre();
						$controllerSobre->inserirLayout();
					break;
					
					case 'buscar':
						$id = $_POST['id'];
						
						$controllerSobre = new controllerSobre();
						$listLayout = $controllerSobre->buscarLayout($id);
						
						echo $listLayout;
					break;
					
					case 'atualizarLayout':
						$controllerSobre = new controllerSobre();
						$controllerSobre->atualizarLayout();
					break;
						
						
					case 'excluir':
						$id = $_POST['id'];
						
						$controllerSobre = new controllerSobre();
						$controllerSobre->excluirLayout($id);
					break;
						
					case 'status':
						$status = $_POST['status'];
						$id = $_POST['id'];
						$layout = $_POST['layout'];
						
						$controllerSobre = new controllerSobre();
						$controllerSobre->atualizarStatus($status, $id, $layout);
					break;
				}
		break;
			
		case 'cor':
			$modo = $_POST['modo'];
			require_once('controller/controllerCor.php');
			switch($modo){
				case 'inserir':
					$controllerCor = new controllerCor();
					$controllerCor->inserirCor();
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					$controllerCor = new controllerCor();
					$controllerCor->excluirCor($id);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					$controllerCor = new controllerCor();
					$listCor = $controllerCor->buscarCor($id);
					
					echo $listCor;
				break;
					
				case 'editar':
					$controllerCor = new controllerCor();
					$controllerCor->atualizarCor();
				break;
			}
		break;
			
		case 'produto':
			$tamanho = $_POST['tamanho'];
			$controllerCor = new controllerCor();
			$listTamanho = $controllerCor->buscarTamanho($tamanho);
			
			echo($listTamanho);
		break;
    }
?>