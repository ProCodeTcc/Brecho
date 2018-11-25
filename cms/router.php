<?php
    //armazenando o controller em uma variável
    $controller = $_POST['controller'];

    //switch no controller para descobrir qual a controller
    switch($controller){
        case 'usuario':
        
        //armazenando o modo em uma variável
        $modo = $_POST['modo'];
        
        //inclusão do arquivo controllerUsuario
        require_once('controller/controllerUsuario.php');
            
            //switch no modo para descobrir qual o modo
            switch($modo){
            case 'inserir':

                //instância da controller
                $controllerUsuario = new controllerUsuario();
            
                //inserindo o usuário e armazenando o status
                $status = $controllerUsuario->inserirUsuario();

                //retorno do status
				echo($status);
            break;

            case 'buscar':
                //resgatando o ID
                $id = $_POST['id'];

                //instância da controller
                $controllerUsuario = new controllerUsuario();
                
                //buscando o usuário e armazenando os dados
                $list = $controllerUsuario->buscarUsuario($id);
                    
                //retorno dos dados
                echo $list;
            break;

            case 'editar':
                //resgatando o ID
                $id = $_POST['id'];
                
                //instância da controller
                $controllerUsuario = new controllerUsuario();
                
                //atualizando o usuário e armazenando o status
                $status = $controllerUsuario->atualizarContato($id);
                    
                //retornando o status
                echo($status);
            break;

            case 'excluir':
                //regatando o ID
                $id = $_POST['id'];
                    
                //instância da controller
                $controllerUsuario = new controllerUsuario();
                
                //excluindo o usuário
                $controllerUsuario->excluirUsuario($id);
            break;

            case 'status':
                //resgatando o ID
                $id = $_POST['id'];
                    
                //resgatando o status
                $status = $_POST['status'];

                //instância da controller
                $controllerUsuario = new controllerUsuario();
                    
                //atualizando o status
                $controllerUsuario->atualizarStatus($id, $status);
            break;

            case 'logar':
                //regatando o usuário
                $usuario = $_POST['txtusuario'];
                    
                //resgatando a senha
                $senha = $_POST['txtsenha'];

                //instância da controller
                $controllerUsuario = new controllerUsuario();
                
                //logando  usuário e armazenando o status
                $teste = $controllerUsuario->logarUsuario($usuario, $senha);

                //retornando o status
                return $teste;
            break;
				
			case 'deslogar':
                //instância da controller
				$controllerUsuario = new controllerUsuario();
				
                //deslogando o usuário
				$controllerUsuario->deslogarUsuario();
			break;
        }
        break;
        
        case 'nivel':
        
        //resgatando o modo
        $modo = $_POST['modo'];
            
        //inclusão do arquivo da controller
        require_once('controller/controllerNivel.php');
            
        //switch para descobrir o modo
        switch($modo){
            case 'inserir':
                //instância da controller
                $controllerNivel = new controllerNivel();
                
                //inserindo o nível e armazenando o status
				$status = $controllerNivel->inserirNivel();
				
                //retorno do status
				echo($status);
            break;

            case 'excluir':
                //resgatando o ID
                $id = $_POST['id'];
                
                //instância da controller
                $controllerNivel = new controllerNivel();
                
                //excluindo o nível
                $controllerNivel->excluirNivel($id);
            break;

            case 'buscar':
                //resgatando o ID
                $id = $_POST['id'];
                
                //instância da controller
                $controllerNivel = new controllerNivel();
                
                //buscando o nível e armazenando os dados
                $listNivel = $controllerNivel->buscarNivel($id);
                
                //retorno dos dados
                echo $listNivel;
            break;
				
            case 'editar':
                //resgatando o ID
                $id = $_POST['id'];

                //instância da controller
                $controllerNivel = new controllerNivel();
                
                //atualizando o nível e armazenando o status
				$status = $controllerNivel->atualizarNivel($id);
				
                //retorno do status
				echo($status);
            break;
				
			case 'permitir':
                //resgatando o ID do nível
				$idNivel = $_POST['idNivel'];
                
                //resgatando o ID da página
				$idPagina = $_POST['idPagina'];
				
                //instância da controller
				$controllerNivel = new controllerNivel();
                
                //permitindo o acesso e armazenando o status
				$status = $controllerNivel->permitirPagina($idNivel, $idPagina);

                //retorno do status
				echo($status);
			break;
				
			case 'negar':
                //resgatando o ID do nível
				$idNivel = $_POST['idNivel'];
                
                //resgatandoo ID da página
				$idPagina = $_POST['idPagina'];
				
                ///instância da controller
				$controllerNivel = new controllerNivel();
                
                //negando o acesso e armazenando o ID
				$status = $controllerNivel->retirarPermissao($idNivel, $idPagina);

                //retornando os dados
				echo($status);
			break;

            case 'status':
                //resgatando o ID
                $id = $_POST['id'];
                
                //resgatando o status
                $status = $_POST['status'];

                //instância da controller
                $controllerNivel = new controllerNivel();
                
                //atualizando o status
                $controllerNivel->atualizarStatus($id, $status);
            break;
        }
        break;

        case 'enquete':

        //resgatando o modo
        $modo = $_POST['modo'];
            
        //inclusão do arquivo da controller
        require_once('controller/controllerEnquete.php');
            
        //switch no modo
        switch($modo){
            case 'inserir':
                //instância da controller
                $controllerEnquete = new controllerEnquete();
                
                //inserindo a enquete e armazenando o retorno
				$retorno = $controllerEnquete->inserirEnquete();
				
                //retorno
				echo($retorno);
            break;

            case 'buscar':
                //resgatando o ID
				$id = $_POST['id'];
                
                //resgatando o idioma
				$idioma = $_POST['idioma'];

                //instância da controller
                $controllerEnquete = new controllerEnquete();
                
                //buscando a enquete e armazenando os dados
                $listEnquetes = $controllerEnquete->buscarEnquete($id, $idioma);
                
                //retorno dos dados
                echo($listEnquetes);
            break;
				
			case 'visualizar':
				//resgatando o id da enquete
				$id = $_POST['id'];
				
                //instância da controller
				$controllerEnquete = new controllerEnquete();
                
                //buscando os resultados e armazenando os dados
				$resultado = $controllerEnquete->buscarResultado($id);
				
                //retorno dos dados
				echo $resultado;
			break;

            case 'editar':
                //instância da controller
                $controllerEnquete = new controllerEnquete();
                
                //atualizando a enquete e armazenando o retorno
				$retorno = $controllerEnquete->atualizarEnquete();
				
                //retorno
				echo($retorno);
			break;
			
			case 'atualizarTraducao':
				//instância da controller
				$controllerEnquete = new controllerEnquete();

                //atualizando a tradução e armazenando o status
				$status = $controllerEnquete->atualizarTraducao();
				
                //retorno do status
				echo($status);
			break;

            case 'excluir':
                //resgatando o ID
                $id = $_POST['id'];
                
                //instância da controller
                $controllerEnquete = new controllerEnquete();
                
                //excluindo a enquete e armazenando os dados
				$status = $controllerEnquete->excluirEnquete($id);
				
                //retorno dos dados
				echo($status);
            break;

            case 'status':
                //resgatando o ID
                $id = $_POST['id'];
                
                //resgatando o status
                $status = $_POST['status'];

                //instância da enquete
                $controllerEnquete = new controllerEnquete();
                
                //atualizando o status
                $controllerEnquete->atualizarStatus($id, $status);
            break;
        }
        break;
			
		case 'FaleConosco':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão da controller
			require_once('controller/controllerFaleConosco.php');
            
            //switch no modo
			switch($modo){
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerFaleConosco = new controllerFaleConosco();
                    
                    //buscando o feedback e armazenando os dados
					$listFeedback = $controllerFaleConosco->buscarFeedback($id);
					
                    //retorno dos dados
					echo($listFeedback);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerFaleConosco = new controllerFaleConosco();
                    
                    //excluindo o feedback e armazenando o retorno
					$status = $controllerFaleConosco->excluirFeedback($id);
                    
                    //retorno do status
                    echo($status);
				break;
			}
		break;
		
		case 'sobre':
            //resgatando o status
            $modo = $_POST['modo'];
            
            //inclusão da controller
            require_once('controller/controllerSobre.php');
            
            //switch no modo
            switch($modo){
                case 'inserirLayout':
                    //instância da controller
                    $controllerSobre = new controllerSobre();
                    
                    //inserindo um layout e armazenando o retorno
                    $retorno = $controllerSobre->inserirLayout();

                    //retorno
                    echo($retorno);
                break;

                case 'buscar':
                    //resgatando o ID
                    $id = $_POST['id'];
                    
                    //resgatando o idioma
                    $idioma = $_POST['idioma'];

                    //instância da controller
                    $controllerSobre = new controllerSobre();
                    
                    //buscando um layout e armazenando os dados
                    $listLayout = $controllerSobre->buscarLayout($id, $idioma);

                    //retorno dos dados
                    echo $listLayout;
                break;

                case 'atualizarLayout':
                    //instância da controller
                    $controllerSobre = new controllerSobre();
                    
                    //atualizando o layout e armazenando o retorno
                    $retorno = $controllerSobre->atualizarLayout();

                    //retorno
                    echo($retorno);
                break;

                case 'atualizarTraducao':
                    //instância da controller
                    $controllerSobre = new controllerSobre();

                    //atualizando a tradução e armazenando o retorno
                    $retorno = $controllerSobre->atualizarTraducao();

                    //retorno
                    echo($retorno);
                break;


                case 'excluir':
                    //resgatando o id
                    $id = $_POST['id'];
                    
                    //resgatando o layout
                    $layout = $_POST['layout'];

                    //instância da controller
                    $controllerSobre = new controllerSobre();
                    
                    //excluindo um layout e armazenando o retonro
                    $status = $controllerSobre->excluirLayout($id, $layout);

                    //retorno
                    echo($status);
                break;

                case 'status':
                    //resgatando o status
                    $status = $_POST['status'];
                    
                    //resgatando o ID
                    $id = $_POST['id'];
                    
                    //resgatando o layout
                    $layout = $_POST['layout'];

                    //instância da controller
                    $controllerSobre = new controllerSobre();
                    
                    //atualizando o status
                    $controllerSobre->atualizarStatus($status, $id, $layout);
                break;
            }
		break;
			
		case 'cor':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão da controller
			require_once('controller/controllerCor.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerCor = new controllerCor();
                    
                    //inserindo a cor e armazenando o status
					$status = $controllerCor->inserirCor();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerCor = new controllerCor();
                    
                    //excluindo a cor e armazenando o status
					$status = $controllerCor->excluirCor($id);
                    
                    //retornando o status
                    echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerCor = new controllerCor();
                    
                    //buscando a cor e armazenando os dador
					$listCor = $controllerCor->buscarCor($id);
					
                    //retorno dos dados
					echo $listCor;
				break;
					
				case 'editar':
                    //instância da controller
					$controllerCor = new controllerCor();
                    
                    //atualizando a cor e armazenando o status
					$status = $controllerCor->atualizarCor();
                    
                    //retorno do status
                    echo($status);
				break;
			}
		break;
			
		case 'tema':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão da controller
			require_once('controller/controllerTema.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerTema = new controllerTema();
                    
                    //inserindo o tema e armazenando o status
					$status = $controllerTema->inserirTema();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'editar':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerTema = new controllerTema();
                    
                    //atualizando o tema e armazenando o status
					$status = $controllerTema->atualizarTema($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerTema = new controllerTema();
                    
                    //buscando o tema e armazenando os dados
					$listTema = $controllerTema->buscarTema($id);
					
                    //retorno dos dados
					echo($listTema);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerTema = new controllerTema();
                    
                    //excluindo o tema e armazenando o status
					$status = $controllerTema->excluirTema($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'status':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //resgatando o status
					$status = $_POST['status'];
                    
                    //resgatando o genero
					$genero = $_POST['genero'];
					
                    //instância da controller
					$controllerTema = new controllerTema();
                    
                    //atualizando o status
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
            
        case 'marca':
            $modo = $_POST['modo'];
            require_once('controller/controllerMarca.php');
            switch($modo){
                case 'inserir':
                    $controllerMarca = new controllerMarca();
                    $status = $controllerMarca->inserirMarca();
                        
                    echo $status;
                break;
                    
                case 'buscar':
                    $id = $_POST['id'];
                    
                    $controllerMarca = new controllerMarca();
                    $status = $controllerMarca->buscarMarca($id);
                        
                    echo $status;
                break;
                    
                case 'editar':
                    $controllerMarca = new controllerMarca();
                    $status = $controllerMarca->atualizarMarca();
                        
                    echo $status;
                break;
                    
                case 'excluir':
                    $id = $_POST['id'];
                    
                    $controllerMarca = new controllerMarca();
                    $status = $controllerMarca->excluirMarca($id);
                        
                    echo $status;
                break;
            }
		break;
    }
?>