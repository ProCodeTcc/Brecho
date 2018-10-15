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
			
		case 'tema':
			$modo = $_POST['modo'];
			require_once('controller/controllerTema.php');
			switch($modo){
				case 'inserir':
					$controllerTema = new controllerTema();
					$controllerTema->inserirTema();
				break;
					
				case 'editar':
					$id = $_POST['id'];
					
					$controllerTema = new controllerTema();
					$controllerTema->atualizarTema($id);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerTema = new controllerTema();
					$listTema = $controllerTema->buscarTema($id);
					
					echo($listTema);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerTema = new controllerTema();
					$controllerTema->excluirTema($id);
				break;
			}
		break;
			
		case 'produto':
			$modo = $_POST['modo'];
			require_once('controller/controllerProduto.php');
			switch($modo){
				case 'inserir':
					$controllerProduto = new controllerProduto();
					
					$controllerProduto->inserirProduto();
				break;
					
				case 'editar':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$controllerProduto->atualizarProduto($id);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$listProduto = $controllerProduto->buscarProduto($id);
					
					echo($listProduto);
				break;
					
				case 'status':
					$id = $_POST['id'];
					$status = $_POST['status'];
					
					$controllerProduto = new controllerProduto();
					
					$controllerProduto->atualizarStatus($status, $id);
				break;
					
				case 'atualizarImagem':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					$controllerProduto->atualizarImagem($id);
				break;
					
				case 'excluirImagem':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					$controllerProduto->excluirImagem($id);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$controllerProduto->excluirProduto($id);
				break;
					
				case 'inserirPromocao':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$controllerProduto->inserirPromocao($id);
				break;
					
				case 'buscarMedida':
					$tamanho = $_POST['tamanho'];
					$controllerProduto = new controllerProduto();
					$listTamanho = $controllerProduto->buscarTamanho($tamanho);

					echo($listTamanho);
				break;
					
				case 'buscarCor':
					$controllerProduto = new controllerProduto();
					$listCor = $controllerProduto->listarCor();
					
					echo($listCor);
				break;
					
				case 'buscarMarca':
					$controllerProduto = new controllerProduto();
					$listMarca = $controllerProduto->listarMarca();
					
					echo($listMarca);
				break;
					
				case 'buscarCategoria':
					$controllerProduto = new controllerProduto();
					$listCategoria = $controllerProduto->listarCategoria();
					
					echo($listCategoria);
				break;
					
			}
		break;
			
		case 'promoção':
			$modo = $_POST['modo'];
			require_once('controller/controllerPromocao.php');
			switch($modo){
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerPromocao = new controllerPromocao();
					$listProduto = $controllerPromocao->buscarProduto($id);
					
					echo($listProduto);
				break;
					
				case 'inserir':
					$id = $_POST['id'];
					
					$controllerPromocao = new controllerPromocao();
					$controllerPromocao->cadastrarPromocao($id);
				break;
				
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerPromocao = new controllerPromocao();
					$controllerPromocao->excluirPromocao($id);
				break;
					
				case 'status':
					$status = $_POST['status'];
					$id = $_POST['id'];
					
					$controllerPromocao = new controllerPromocao();
					$controllerPromocao->atualizarStatus($status, $id);
				break;
			}
		break;
			
		case 'avaliação':
			$modo = $_POST{'modo'};
			require_once('controller/controllerAvaliacao.php');
			switch($modo){
				case 'aprovar':
					$id = $_POST['id'];
					
					$controllerAvaliacao = new controllerAvaliacao();
					$controllerAvaliacao->aprovarProduto($id);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerAvaliacao = new controllerAvaliacao();
					$listProduto = $controllerAvaliacao->buscarProduto($id);
					
					echo($listProduto);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerAvaliacao = new controllerAvaliacao();
					$controllerAvaliacao->excluirImagemDiretorio($id);
					$controllerAvaliacao->excluirProduto($id);
				break;
			}
		break;
    }
?>