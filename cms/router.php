<?php
    $controller = $_POST['controller'];

    switch($controller){
        case 'usuario':

        $modo = $_POST['modo'];
        require_once('controller/controllerUsuario.php');
        switch($modo){
            case 'inserir':

                $controllerUsuario = new controllerUsuario();
            
                $status = $controllerUsuario->inserirUsuario();

				echo($status);
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
                $status = $controllerUsuario->atualizarContato($id);
                echo($status);
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
				$status = $controllerNivel->inserirNivel();
				
				echo($status);
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
				$status = $controllerNivel->atualizarNivel($id);
				
				echo($status);
            break;
				
			case 'permitir':
				$idNivel = $_POST['idNivel'];
				$idPagina = $_POST['idPagina'];
				
				$controllerNivel = new controllerNivel();
				$status = $controllerNivel->permitirPagina($idNivel, $idPagina);

				echo($status);
			break;
				
			case 'negar':
				$idNivel = $_POST['idNivel'];
				$idPagina = $_POST['idPagina'];
				
				$controllerNivel = new controllerNivel();
				$status = $controllerNivel->retirarPermissao($idNivel, $idPagina);

				echo($status);
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
				$retorno = $controllerEnquete->inserirEnquete();
				
				echo($retorno);
            break;

            case 'buscar':
				$id = $_POST['id'];
				$idioma = $_POST['idioma'];

                $controllerEnquete = new controllerEnquete();
                $listEnquetes = $controllerEnquete->buscarEnquete($id, $idioma);
                
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
                $controllerEnquete = new controllerEnquete();
				$retorno = $controllerEnquete->atualizarEnquete();
				
				echo($retorno);
			break;
			
			case 'atualizarTraducao':
				
				$controllerEnquete = new controllerEnquete();

				$status = $controllerEnquete->atualizarTraducao();
				
				echo($status);
			break;

            case 'excluir':
                $id = $_POST['id'];
                $controllerEnquete = new controllerEnquete();
				$status = $controllerEnquete->excluirEnquete($id);
				
				echo($status);
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
					$status = $controllerFaleConosco->excluirFeedback($id);
                    
                    echo($status);
				break;
			}
		break;
		
		case 'sobre':
				$modo = $_POST['modo'];
				require_once('controller/controllerSobre.php');
				switch($modo){
					case 'inserirLayout':
						$controllerSobre = new controllerSobre();
						$retorno = $controllerSobre->inserirLayout();

						echo($retorno);
					break;
					
					case 'buscar':
						$id = $_POST['id'];
						$idioma = $_POST['idioma'];
						
						$controllerSobre = new controllerSobre();
						$listLayout = $controllerSobre->buscarLayout($id, $idioma);
						
						echo $listLayout;
					break;
					
					case 'atualizarLayout':
						$controllerSobre = new controllerSobre();
						$retorno = $controllerSobre->atualizarLayout();

						echo($retorno);
					break;

					case 'atualizarTraducao':
						$controllerSobre = new controllerSobre();

						$retorno = $controllerSobre->atualizarTraducao();

						echo($retorno);
					break;
						
						
					case 'excluir':
						$id = $_POST['id'];
						$layout = $_POST['layout'];
						
						$controllerSobre = new controllerSobre();
						$status = $controllerSobre->excluirLayout($id, $layout);
                        
                        echo($status);
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
					$status = $controllerCor->inserirCor();
                    echo($status);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					$controllerCor = new controllerCor();
					$status = $controllerCor->excluirCor($id);
                    echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					$controllerCor = new controllerCor();
					$listCor = $controllerCor->buscarCor($id);
					
					echo $listCor;
				break;
					
				case 'editar':
					$controllerCor = new controllerCor();
					$status = $controllerCor->atualizarCor();
                    echo($status);
				break;
			}
		break;
			
		case 'tema':
			$modo = $_POST['modo'];
			require_once('controller/controllerTema.php');
			switch($modo){
				case 'inserir':
					$controllerTema = new controllerTema();
					$status = $controllerTema->inserirTema();
                    echo($status);
				break;
					
				case 'editar':
					$id = $_POST['id'];
					
					$controllerTema = new controllerTema();
					$status = $controllerTema->atualizarTema($id);
                    echo($status);
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
					$status = $controllerTema->excluirTema($id);
                    echo($status);
				break;
					
				case 'status':
					$id = $_POST['id'];
					$status = $_POST['status'];
					$genero = $_POST['genero'];
					
					$controllerTema = new controllerTema();
					$controllerTema->atualizarStatus($status, $id, $genero);
				break;
			}
		break;
			
		case 'produto':
			$modo = $_POST['modo'];
			require_once('controller/controllerProduto.php');
			switch($modo){
				case 'inserir':
					$controllerProduto = new controllerProduto();
					
					$status = $controllerProduto->inserirProduto();

					echo($status);
				break;
					
				case 'editar':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$status = $controllerProduto->atualizarProduto($id);

					echo($status);
				break;

				case 'atualizarTraducao':
					$id = $_POST['id'];

					$controllerProduto = new controllerProduto();

					$status = $controllerProduto->atualizarTraducao($id);

					echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					$idioma = $_POST['idioma'];

					$controllerProduto = new controllerProduto();
					
					$listProduto = $controllerProduto->buscarProduto($id, $idioma);
					
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
					$status = $controllerProduto->atualizarImagem($id);
                    
                    echo($status);
				break;
					
				case 'excluirImagem':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					$status = $controllerProduto->excluirImagem($id);
                    
                    echo($status);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$status = $controllerProduto->excluirProduto($id);
                    
                    echo($status);
				break;
					
				case 'inserirPromocao':
					$id = $_POST['id'];
					
					$controllerProduto = new controllerProduto();
					
					$status = $controllerProduto->inserirPromocao($id);
                    
                    echo($status);
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

				case 'buscarSubcategoria':
					$idCategoria = $_POST['id'];

					$controllerProduto = new controllerProduto();

					$listSubcategoria = $controllerProduto->listarSubcategoria($idCategoria);

					echo($listSubcategoria);
				break;
					
                case 'verificar':
                    $id = $_POST['id'];
                    
                    $controllerProduto = new controllerProduto();
                    
                    $status = $controllerProduto->verificarTraducao($id);
                    
                    echo($status);
                break;
			}
		break;

		case 'categoria':
			$modo = $_POST['modo'];
			require_once('controller/controllerCategoria.php');
			switch($modo){
				case 'inserir':
					$controllerCategoria = new controllerCategoria();

					$retorno = $controllerCategoria->inserirCategoria();

					echo $retorno;
				break;

				case 'inserirSubcategoria':
					$controllerCategoria = new controllerCategoria();

					$status = $controllerCategoria->inserirSubcategoria();

					echo($status);
				break;

				case 'buscar':
					$id = $_POST['id'];
					$controllerCategoria = new controllerCategoria();

					$listCategoria = $controllerCategoria->buscarCategoria($id);

					echo($listCategoria);
				break;

				case 'buscarSubcategoria':
					$id = $_POST['id'];

					$controllerCategoria = new controllerCategoria();

					$listSubcategoria = $controllerCategoria->buscarSubcategoria($id);

					echo($listSubcategoria);
				break;

				case 'editar':
					$controllerCategoria = new controllerCategoria();

					$status = $controllerCategoria->atualizarCategoria();

					echo $status;
				break;

				case 'editarSubcategoria':
					$controllerCategoria = new controllerCategoria();

					$status = $controllerCategoria->atualizarSubcategoria();

					echo($status);
				break;

				case 'excluir':
					$id = $_POST['id'];

					$controllerCategoria = new controllerCategoria();

					$status = $controllerCategoria->excluirCategoria($id);

					return $status;
				break;

				case 'status':
					$id = $_POST['id'];
					$status = $_POST['status'];

					$controllerCategoria = new controllerCategoria();

					$retorno = $controllerCategoria->atualizarStatus($status, $id);

					echo($retorno);
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
					$status = $controllerPromocao->cadastrarPromocao($id);
                    echo($status);
				break;
				
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerPromocao = new controllerPromocao();
					$status = $controllerPromocao->excluirPromocao($id);
                    echo($status);
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
			$modo = $_POST['modo'];
			require_once('controller/controllerAvaliacao.php');
			switch($modo){
				case 'consignado':
					$tipoCliente = $_POST['tipoCliente'];
					$idCliente = $_POST['idCliente'];
					$idProdutoAvaliacao = $_POST['idProduto'];
					
					$controllerAvaliacao = new controllerAvaliacao();
					$status = $controllerAvaliacao->inserirConsignacao($tipoCliente, $idCliente, $idProdutoAvaliacao);
                    
                    echo($status);
				break;
				
				case 'compra':
					$tipoCliente = $_POST['tipoCliente'];
					$idCliente = $_POST['idCliente'];

					$idProdutoAvaliacao = $_POST['idProduto'];

					$controllerAvaliacao = new controllerAvaliacao();
					$status = $controllerAvaliacao->inserirCompra($tipoCliente, $idCliente, $idProdutoAvaliacao);
                    
                    echo($status);
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
			
		case 'unidade':
			$modo = $_POST['modo'];
			require_once('controller/controllerUnidade.php');
			switch($modo){
				case 'inserir':
					$controllerUnidade = new controllerUnidade();
					$status = $controllerUnidade->inserirUnidade();
                    echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerUnidade = new controllerUnidade();
					$listUnidade = $controllerUnidade->buscarUnidade($id);
					
					echo($listUnidade);
				break;
					
				case 'editar':
					$id = $_POST['id'];
					$idEndereco = $_POST['idEndereco'];
					
					$controllerUnidade = new controllerUnidade();
					$status = $controllerUnidade->atualizarUnidade($id, $idEndereco);
                    echo($status);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					$idEndereco = $_POST['idEndereco'];
					
					$controllerUnidade = new controllerUnidade();
					$status = $controllerUnidade->excluirUnidade($id, $idEndereco);
                    echo($status);
				break;
			}
		break;
			
		case 'evento':
			$modo = $_POST['modo'];
			require_once('controller/controllerEvento.php');
			switch($modo){
				case 'inserir':
					$controllerEvento = new controllerEvento();
					$retorno = $controllerEvento->inserirEvento();

					echo($retorno);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					$idioma = $_POST['idioma'];
					
					$controllerEvento = new controllerEvento();
					$listEvento = $controllerEvento->buscarEvento($id, $idioma);
					
					echo($listEvento);
				break;
					
				case 'editar':
					$controllerEvento = new controllerEvento();
					$retorno = $controllerEvento->atualizarEvento();

					echo($retorno);
				break;

				case 'atualizarTraducao':
					$controllerEvento = new controllerEvento();

					$status = $controllerEvento->atualizarTraducao();

					echo($status);
				break;
					
				case 'status':
					$id = $_POST['id'];
					$status = $_POST['status'];
					
					$controllerEvento = new controllerEvento();
					$controllerEvento->atualizarStatus($id, $status);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerEvento = new controllerEvento();
					$status = $controllerEvento->excluirEvento($id);
                    echo($status);
				break;
			}
		break;
		
		case 'slider':
			$modo = $_POST['modo'];
			require_once('controller/controllerSlider.php');
			switch($modo){
				case 'inserir':
					$controllerSlider = new controllerSlider();
					$status = $controllerSlider->inserirSlider();
                    echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerSlider = new controllerSlider();
					$listSlider = $controllerSlider->buscarSlider($id);
					
					echo($listSlider);
				break;
					
				case 'editar':
					$controllerSlider = new controllerSlider();
					$status = $controllerSlider->atualizarSlider();
                    echo($status);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerSlider = new controllerSlider();
					$status = $controllerSlider->excluirSlider($id);
                    
                    echo($status);
				break;
					
				case 'status':
					$status = $_POST['status'];
					$id = $_POST['id'];
					
					$controllerSlider = new controllerSlider();
					$status = $controllerSlider->atualizarStatus($status, $id);
                    echo($status);
				break;
			}
		break;
			
		case 'retirada':
			$modo = $_POST['modo'];
			require_once('controller/controllerRetirada.php');
			switch($modo){
				case 'inserir':
					$controllerRetirada = new controllerRetirada();
					$status = $controllerRetirada->inserirRetirada();
                    echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerRetirada = new controllerRetirada();
					$listRetirada = $controllerRetirada->buscarRetirada($id);
					
					echo($listRetirada);
				break;
					
				case 'editar':
					$controllerRetirada = new controllerRetirada();
					$status = $controllerRetirada->atualizarRetirada();
                    echo($status);
				break;
					
				case 'excluir':
					$id = $_POST['id'];
					
					$controllerRetirada = new controllerRetirada();
					$status = $controllerRetirada->excluirRetirada($id);
                    echo($status);
				break;
					
				case 'listarLojas':
					$controllerRetirada = new controllerRetirada();
					$listLojas = $controllerRetirada->listarLojas();
					
					echo($listLojas);
				break;
				
				case 'listarPedidos':
					$controllerRetirada = new controllerRetirada();
					$listPedido = $controllerRetirada->listarPedidos();
					
					echo($listPedido);
				break;
                    
                case 'listarCliente':
                    $id = $_POST['pedido'];
                    $controllerRetirada = new controllerRetirada();
                    $listCliente = $controllerRetirada->listarCliente($id);
                    echo($listCliente);
                break;
                
                case 'enviarEmail':
                    $controllerRetirada = new controllerRetirada();
                    $status = $controllerRetirada->enviarEmail();
                    echo($status);
                break;
			}
		break;

		case 'consignação':
			$modo = $_POST['modo'];
			require_once('controller/controllerConsignacao.php');
			switch($modo){
				case 'buscar':
					$id = $_POST['id'];

					$controllerConsignacao = new controllerConsignacao();
					$listConsignacao = $controllerConsignacao->buscarConsignacao($id);

					echo($listConsignacao);
				break;

				case 'editar':
					$controllerConsignacao = new controllerConsignacao();
					$status = $controllerConsignacao->atualizarConsignacao();
                    
                    echo($status);
				break;
			}
		break;
    }
?>