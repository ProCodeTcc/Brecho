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
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerProduto.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerProduto = new controllerProduto();
					
                    //inserindo o produto e armazenando o status
					$status = $controllerProduto->inserirProduto();

                    //retorno do status
					echo($status);
				break;
					
				case 'editar':
                    //regatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerProduto = new controllerProduto();
					
                    //atualizando o produto e armazenando o status
					$status = $controllerProduto->atualizarProduto($id);

                    //retornando o status
					echo($status);
				break;

				case 'atualizarTraducao':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerProduto = new controllerProduto();

                    //atualizando a tradução e armazenando o status
					$status = $controllerProduto->atualizarTraducao($id);

                    //retornando o status
					echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //resgatando o idioma
					$idioma = $_POST['idioma'];
                    
                    //instância da controller
					$controllerProduto = new controllerProduto();
					
                    //buscando o produto e armazenando os dados
					$listProduto = $controllerProduto->buscarProduto($id, $idioma);
					
                    //retorno dos dados
					echo($listProduto);
				break;
					
				case 'status':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //resgatando o status
					$status = $_POST['status'];
					
                    //instância da controller
					$controllerProduto = new controllerProduto();
					
                    //atualizando o status
					$controllerProduto->atualizarStatus($status, $id);
				break;
					
				case 'atualizarImagem':
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerProduto = new controllerProduto();
					$status = $controllerProduto->atualizarImagem($id);
                    
                    echo($status);
				break;
					
				case 'excluirImagem':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //excluindo a imagem e armazenando o status
					$status = $controllerProduto->excluirImagem($id);

                    //retorno do status
                    echo($status);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerProduto = new controllerProduto();
					
                    //excluindo o produto e armazenando o status
					$status = $controllerProduto->excluirProduto($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'inserirPromocao':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerProduto = new controllerProduto();
					
                    //inserindo a promoção e armazenando o status
					$status = $controllerProduto->inserirPromocao($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'buscarMedida':
                    //resgatando o tamanho
					$tamanho = $_POST['tamanho'];
                    
                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //buscando o tamanho e armazenando os tamanhos
					$listTamanho = $controllerProduto->buscarTamanho($tamanho);

					echo($listTamanho);
				break;
					
				case 'buscarCor':
                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //armazenando os dados da cor
					$listCor = $controllerProduto->listarCor();
					
					echo($listCor);
				break;
					
				case 'buscarMarca':
                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //armazenando as marcas
					$listMarca = $controllerProduto->listarMarca();
					
                    //retorno dos dados
					echo($listMarca);
				break;
					
				case 'buscarCategoria':
                    //instância da controller
					$controllerProduto = new controllerProduto();
					$listCategoria = $controllerProduto->listarCategoria();
					
					echo($listCategoria);
				break;

				case 'buscarSubcategoria':
                    //resgatando o ID
					$idCategoria = $_POST['id'];
                    
                    //instância da controller
					$controllerProduto = new controllerProduto();

                    //listando as categorias e armazenando os dados
					$listSubcategoria = $controllerProduto->listarSubcategoria($idCategoria);

                    //retorno dos dados
					echo($listSubcategoria);
				break;
					
                case 'verificar':
                    //resgatando o ID
                    $id = $_POST['id'];
                    
                    //instância da controller
                    $controllerProduto = new controllerProduto();
                    
                    //verificando a tradução e retornando o status
                    $status = $controllerProduto->verificarTraducao($id);
                    
                    //retorno do status
                    echo($status);
                break;
			}
		break;

		case 'categoria':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerCategoria.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerCategoria = new controllerCategoria();

                    //inserindo a categoria e armazenando o retorno
					$retorno = $controllerCategoria->inserirCategoria();

                    //retorno
					echo $retorno;
				break;

				case 'inserirSubcategoria':
                    //instância da controller
					$controllerCategoria = new controllerCategoria();

                    //inserindo a subcategoria e armazenando o status
					$status = $controllerCategoria->inserirSubcategoria();

                    //retorno do status
					echo($status);
				break;

				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerCategoria = new controllerCategoria();

                    //buscando a subcategoria e armazenando os dados
					$listCategoria = $controllerCategoria->buscarCategoria($id);

                    //retorno dos dados
					echo($listCategoria);
				break;

				case 'buscarSubcategoria':
                    //resgatando o ID
					$id = $_POST['id'];

                    //instância da controller
					$controllerCategoria = new controllerCategoria();

                    //buscando a subcategoria e armazenando os dados
					$listSubcategoria = $controllerCategoria->buscarSubcategoria($id);

                    //retorno dos dados
					echo($listSubcategoria);
				break;

				case 'editar':
                    //instância da controller
					$controllerCategoria = new controllerCategoria();
                    
                    //atualizando a categoria e armazenando o status
					$status = $controllerCategoria->atualizarCategoria();

                    //retorno do status
					echo $status;
				break;

				case 'editarSubcategoria':
                    //instância da categoria
					$controllerCategoria = new controllerCategoria();

                    //atualizando a subcategoria e armazenando o status
					$status = $controllerCategoria->atualizarSubcategoria();

                    //retorno do status
					echo($status);
				break;

				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerCategoria = new controllerCategoria();

                    //excluindo a categoria e armazenando o status
					$status = $controllerCategoria->excluirCategoria($id);

                    //retorno do status
					return $status;
				break;

				case 'status':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //resgatando o status
					$status = $_POST['status'];
                    
                    //instância da controller
					$controllerCategoria = new controllerCategoria();

                    //atualizando o status
					$retorno = $controllerCategoria->atualizarStatus($status, $id);

                    //retorno
					echo($retorno);
				break;
			}
		break;
			
		case 'promoção':
			$modo = $_POST['modo'];
			require_once('controller/controllerPromocao.php');
			switch($modo){
				case 'buscar':
                    //resgatando o id
					$id = $_POST['id'];
					
                    //instância da controllers
					$controllerPromocao = new controllerPromocao();
                    
                    
                    //buscando o produto e armazenando os dados
					$listProduto = $controllerPromocao->buscarProduto($id);
					
                    //retorno dos dados
					echo($listProduto);
				break;
					
				case 'inserir':
                    //resgatando o id
					$id = $_POST['id'];
					
                    //instância da controllers
					$controllerPromocao = new controllerPromocao();
                    
                    //cadastrando a promoção e armazenando o status
					$status = $controllerPromocao->cadastrarPromocao($id);
                    
                    //retorno do status
                    echo($status);
				break;
				
				case 'excluir':
                    //resgatando o id
					$id = $_POST['id'];
					
                    //instância da controllers
					$controllerPromocao = new controllerPromocao();
                    
                    //excluindo a promoção e armazenando os dados
					$status = $controllerPromocao->excluirPromocao($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'status':
                    //resgatando o status
					$status = $_POST['status'];
                    
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerPromocao = new controllerPromocao();
                    
                    //atualizando o status
					$controllerPromocao->atualizarStatus($status, $id);
				break;
			}
		break;
			
		case 'avaliação':
            //resgatandoo modo
			$modo = $_POST['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerAvaliacao.php');
            
            //switch no modo
			switch($modo){
				case 'consignado':
                    //resgatando o tipo do cliente
					$tipoCliente = $_POST['tipoCliente'];
                    
                    //resgatando o ID do cliente
					$idCliente = $_POST['idCliente'];
                    
                    //resgatando o ID do produto
					$idProdutoAvaliacao = $_POST['idProduto'];
					
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //inserindo a consignação e armazenando o status
					$status = $controllerAvaliacao->inserirConsignacao($tipoCliente, $idCliente, $idProdutoAvaliacao);
                    
                    //echo no status
                    echo($status);
				break;
				
				case 'compra':
                    //resgatando o tipo do cliente
					$tipoCliente = $_POST['tipoCliente'];
                    
                    //resgatando o ID do cliente
					$idCliente = $_POST['idCliente'];

                    //resgatando o ID do produto
					$idProdutoAvaliacao = $_POST['idProduto'];

                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //inserindo uma compra e armazenando o status
					$status = $controllerAvaliacao->inserirCompra($tipoCliente, $idCliente, $idProdutoAvaliacao);
                    
                    //retorno do status
                    echo($status);
				break;

				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //buscando o produto e armazenando o ID
					$listProduto = $controllerAvaliacao->buscarProduto($id);
					
                    //retorno dos dados
					echo($listProduto);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //excluindo a imagem
					$controllerAvaliacao->excluirImagemDiretorio($id);
                    
                    //excluindo o produto
					$controllerAvaliacao->excluirProduto($id);
				break;
			}
		break;
			
		case 'unidade':
            //switch no modo
			$modo = $_POST['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerUnidade.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controler
					$controllerUnidade = new controllerUnidade();
                    
                    //inserindo a unidade e armazenando o status
					$status = $controllerUnidade->inserirUnidade();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'buscar':
                    //resgatando o id
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerUnidade = new controllerUnidade();
                    
                    //buscando a unidade e armazenando os dados
					$listUnidade = $controllerUnidade->buscarUnidade($id);
					
                    //retorno dos dados
					echo($listUnidade);
				break;
					
				case 'editar':
                    //resgatando o id
					$id = $_POST['id'];
                    
                    //resgatando o ID do enderelo
					$idEndereco = $_POST['idEndereco'];
                    
					//instância da controller
					$controllerUnidade = new controllerUnidade();
                    
                    //atualizando a unidade e armazenando o status
					$status = $controllerUnidade->atualizarUnidade($id, $idEndereco);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'excluir':
                    //resgatando o id
					$id = $_POST['id'];
                    
                    //resgatando o ID do endereço
					$idEndereco = $_POST['idEndereco'];
					
                    //instância da controller
					$controllerUnidade = new controllerUnidade();
                    
                    //excluindo a unidade e armazenando o status
					$status = $controllerUnidade->excluirUnidade($id, $idEndereco);
                    
                    //retorno dos dados
                    echo($status);
				break;
			}
		break;
			
		case 'evento':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerEvento.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerEvento = new controllerEvento();
                    
                    //inserindo o evento e armazenando o retorno
					$retorno = $controllerEvento->inserirEvento();

                    //retorno
					echo($retorno);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //resgatando o idioma
					$idioma = $_POST['idioma'];
					
                    //instância da controller
					$controllerEvento = new controllerEvento();
                    
                    //buscando o evento e armazenando os dados
					$listEvento = $controllerEvento->buscarEvento($id, $idioma);
					
                    //retorno dos dados
					echo($listEvento);
				break;
					
				case 'editar':
                    //instância da controller
					$controllerEvento = new controllerEvento();
                    
                    //atualizando o evento e armazenando o retorno
					$retorno = $controllerEvento->atualizarEvento();

                    //retorno
					echo($retorno);
				break;

				case 'atualizarTraducao':
                    //instância da controller
					$controllerEvento = new controllerEvento();

                    //atualizando a tradução e armazenando o status
					$status = $controllerEvento->atualizarTraducao();

                    //retorno do status
					echo($status);
				break;
					
				case 'status':
                    //resgatando o ID
					$id = $_POST['id'];
                    
                    //resgatando o status
					$status = $_POST['status'];
					
                    //instância da controller
					$controllerEvento = new controllerEvento();
                    
                    //atualizando o status
					$controllerEvento->atualizarStatus($id, $status);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controler
					$controllerEvento = new controllerEvento();
                    
                    //excluindo o evento e armazenando o status
					$status = $controllerEvento->excluirEvento($id);
                    
                    //retorno do status
                    echo($status);
				break;
			}
		break;
		
		case 'slider':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão da controller
			require_once('controller/controllerSlider.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerSlider = new controllerSlider();
                    
                    //inserindo o slider e armazenando o status
					$status = $controllerSlider->inserirSlider();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controler
					$controllerSlider = new controllerSlider();
                    
                    //buscando o slider e armazenando o status
					$listSlider = $controllerSlider->buscarSlider($id);
					
                    //retorno do status
					echo($listSlider);
				break;
					
				case 'editar':
                    //instância da controller
					$controllerSlider = new controllerSlider();
                    
                    //atualizando o slider e armazenando o status
					$status = $controllerSlider->atualizarSlider();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerSlider = new controllerSlider();
                    
                    //excluindo o slider e armazenando o status
					$status = $controllerSlider->excluirSlider($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'status':
                    //armazenando o status
					$status = $_POST['status'];
                    
                    //armazenando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerSlider = new controllerSlider();
                    
                    //atualizando o slider e armazenando o status
					$status = $controllerSlider->atualizarStatus($status, $id);
                    
                    //retorno do status
                    echo($status);
				break;
			}
		break;
			
		case 'retirada':
            //resgatando do modo
			$modo = $_POST['modo'];
            
            //inclusão da controller
			require_once('controller/controllerRetirada.php');
            
            //switch no modo
			switch($modo){
				case 'inserir':
                    //instância da controller
					$controllerRetirada = new controllerRetirada();
                    
                    //inserindo a retirada e armazenando o status
					$status = $controllerRetirada->inserirRetirada();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerRetirada = new controllerRetirada();
                    
                    //buscando a retirada e armazenando os dados
					$listRetirada = $controllerRetirada->buscarRetirada($id);
					
                    //retorno dos dados
					echo($listRetirada);
				break;
					
				case 'editar':
                    //instância da controller
					$controllerRetirada = new controllerRetirada();
                    
                    //atualizando a retirada e armazenando o status
					$status = $controllerRetirada->atualizarRetirada();
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'excluir':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerRetirada = new controllerRetirada();
                    
                    //excluindo a retirada e armazenando o status
					$status = $controllerRetirada->excluirRetirada($id);
                    
                    //retorno do status
                    echo($status);
				break;
					
				case 'listarLojas':
                    //instância da controller
					$controllerRetirada = new controllerRetirada();
                    
                    //listando as lojas e armazenando os dados
					$listLojas = $controllerRetirada->listarLojas();
					
                    //retorno dos dados
					echo($listLojas);
				break;
				
				case 'listarPedidos':
                    //instância da controller
					$controllerRetirada = new controllerRetirada();
                    
                    //listando os pedidoas e armazenando os dados
					$listPedido = $controllerRetirada->listarPedidos();
					
                    //retorno dos dados
					echo($listPedido);
				break;
                    
                case 'listarCliente':
                    //resgatando o pedido
                    $id = $_POST['pedido'];
                    
                    //instância da controller
                    $controllerRetirada = new controllerRetirada();
                    
                    //listando o cliente e armazenando os dados
                    $listCliente = $controllerRetirada->listarCliente($id);
                    
                    //retorno dos dados
                    echo($listCliente);
                break;
                
                case 'enviarEmail':
                    //instância da controller
                    $controllerRetirada = new controllerRetirada();
                    
                    //enviando o e-mail e armazenando o status
                    $status = $controllerRetirada->enviarEmail();
                    
                    //retorno do status
                    echo($status);
                break;
			}
		break;

		case 'consignação':
            //resgatando o modo
			$modo = $_POST['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerConsignacao.php');
            
            //switch no modo
			switch($modo){
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];

                    //instância da controller
					$controllerConsignacao = new controllerConsignacao();
                    
                    //buscando a consignação e armazenando os dados
					$listConsignacao = $controllerConsignacao->buscarConsignacao($id);

                    //retorno dos dados
					echo($listConsignacao);
				break;

				case 'editar':
                    //instância da controller
					$controllerConsignacao = new controllerConsignacao();
                    
                    //atualizando a consignação e armazenando o status
					$status = $controllerConsignacao->atualizarConsignacao();
                    
                    //retorno do status
                    echo($status);
				break;
			}
        break;
            
        case 'marca':
            $modo = $_POST['modo'];
            require_once('controller/controllerMarca.php');
            switch($modo){
                case 'inserir':
                    //instância da controller
                    $controllerMarca = new controllerMarca();
                    
                    //inserindo a marca e armazenando o status
                    $status = $controllerMarca->inserirMarca();
                        
                    //retorno do status
                    echo $status;
                break;
                    
                case 'buscar':
                    $id = $_POST['id'];
                    
                    //instância da controller
                    $controllerMarca = new controllerMarca();
                    
                    //buscando a marca e armazenando o status
                    $status = $controllerMarca->buscarMarca($id);
                        
                    //retorno do status
                    echo $status;
                break;
                    
                case 'editar':
                    //instância da controller
                    $controllerMarca = new controllerMarca();
                    
                    //atualizando a marca e armazenando o status
                    $status = $controllerMarca->atualizarMarca();
                        
                    //retorno do status
                    echo $status;
                break;
                    
                case 'excluir':
                    //resgatando o ID
                    $id = $_POST['id'];
                    
                    //instância da controller
                    $controllerMarca = new controllerMarca();
                    
                    //excluindo a marca e armazenando o status
                    $status = $controllerMarca->excluirMarca($id);
                    
                    //retorno do status
                    echo $status;
                break;
            }
		break;
    }
?>