<?php

	$controller = $_GET['controller'];	
	
	
    switch($controller){
		case 'enquete':
			$modo = $_GET['modo'];
			require_once('controller/controllerEnquete.php');
			switch($modo){
				case 'qtdA':
					$controllerEnquete = new controllerEnquete();
					$status = $controllerEnquete->atualizarQtdA();
                    
                    echo($status);
				break;
				
				case 'qtdB':
					$controllerEnquete = new controllerEnquete();
					$status = $controllerEnquete->atualizarQtdB();
                    
                    echo($status);
				break;
					
				case 'qtdC':
					$controllerEnquete = new controllerEnquete();
					$status = $controllerEnquete->atualizarQtdC();
                    
                    echo($status);
				break;
					
				case 'qtdD':
					$controllerEnquete = new controllerEnquete();
					$status = $controllerEnquete->atualizarQtdD();
                    
                    echo($status);
				break;
			}
		break;
		
		case 'FaleConosco':
            require_once('controller/controllerFaleConosco.php');
            
            $controllerFaleConosco = new controllerFaleConosco();
            $status = $controllerFaleConosco->inserirFaleConosco();

            echo $status;
        break;
            
        case 'ClienteFisico':
			$modo = $_GET['modo'];
            require_once('controller/controllerClienteFisico.php');
            switch($modo){
				case 'cadastrar':
					$controllerClienteFisico = new controllerClienteFisico();
					$status = $controllerClienteFisico->inserirCliente();

					echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerClienteFisico = new controllerClienteFisico();
					$listCliente = $controllerClienteFisico->listarCliente($id);
					
					echo($listCliente);
				break;
					
				case 'atualizar':
					$controllerClienteFisico = new controllerClienteFisico();
					$status = $controllerClienteFisico->atualizarCliente();
                    echo $status;
				break;

				case 'validarUsuario':
					$usuario = $_POST['campo'];

					$controllerClienteFisico = new controllerClienteFisico();
					$resultado = $controllerClienteFisico->validarUsuario($usuario);

					echo($resultado);
				break;
				
				case 'validarEmail':
					$email = $_POST['campo'];

					$controllerClienteFisico = new controllerClienteFisico();

					$resultado = $controllerClienteFisico->validarEmail($email);

					echo($resultado);
				break;

				case 'validarCpf':
					$cpf = $_POST['campo'];

					$controllerClienteFisico = new controllerClienteFisico();

					$resultado = $controllerClienteFisico->validarCpf($cpf);

					echo($resultado);
				break;
			}
            
		break;
		
		case 'ClienteJuridico':
			$modo = $_GET['modo'];
			require_once('controller/controllerClienteJuridico.php');
			switch($modo){
				case 'cadastrar':
					$controllerClienteJuridico = new controllerClienteJuridico();
					$status = $controllerClienteJuridico->inserirCliente();

					echo($status);
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerClienteJuridico = new controllerClienteJuridico();
					$listCliente = $controllerClienteJuridico->buscarCliente($id);
					
					echo($listCliente);
				break;
					
				case 'atualizar':
					$controllerClienteJuridico = new controllerClienteJuridico();
					$status = $controllerClienteJuridico->atualizarCliente();
                    echo $status;
				break;

				case 'validarUsuario':
					$usuario = $_POST['campo'];

					$controllerClienteJuridico = new controllerClienteJuridico();
					$resultado = $controllerClienteJuridico->validarUsuario($usuario);

					echo $resultado;
				break;

				case 'validarEmail':
					$email = $_POST['campo'];

					$controllerClienteJuridico = new controllerClienteJuridico();
					$resultado = $controllerClienteJuridico->validarEmail($email);

					echo($resultado);
				break;

				case 'validarCnpj':
					$cnpj = $_POST['campo'];

					$controllerClienteJuridico = new controllerClienteJuridico();
					$resultado = $controllerClienteJuridico->validarCnpj($cnpj);

					echo($resultado);
				break;
				
			}
		break;
			
		case 'avaliação':
			$modo = $_GET['modo'];
			require_once('controller/controllerAvaliacao.php');
			switch($modo){
				case 'cadastrar':
					$controllerAvaliacao = new controllerAvaliacao();
					$status = $controllerAvaliacao->inserirProduto();

					echo($status);
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

				case 'buscarSubcategoria':
					$idCategoria = $_GET['id'];
					$controllerAvaliacao = new controllerAvaliacao();
					$listSubcategoria = $controllerAvaliacao->listarSubcategoria($idCategoria);

					echo($listSubcategoria);
				break;
			}
            
        case 'login':
            require_once('controller/controllerLogin.php');
            $modo = $_GET['modo'];
            switch($modo){
				case 'logar':
					$controllerLogin = new controllerLogin();
					$status = $controllerLogin->BuscarConta();

					echo($status);
				break;
					
				case 'deslogar':
					$controllerLogin = new controllerLogin();
					$controllerLogin->deslogar();
				break;
			}
            
            
		break;
			
		case 'produto':
			require_once('controller/controllerProduto.php');
			$modo = $_GET['modo'];
			switch($modo){
				case 'clique':
					$id = $_POST['id'];

					$controllerProduto = new controllerProduto();

					$controllerProduto->atualizarClique($id);
				break;

				case 'adicionarCarrinho':
					$id = $_POST['id'];

					$controllerProduto = new controllerProduto();
					$listProduto = $controllerProduto->adicionarCarrinho($id);

					echo($listProduto);
				break;

				case 'listarProdutos':
					$controllerProduto = new controllerProduto();
					$listProduto = $controllerProduto->listarProdutosCarrinho();

					return $listProduto;
				break;

				case 'removerItem':
					$id = $_POST['id'];

					$controllerProduto = new controllerProduto();
					$controllerProduto->removerItemCarrinho($id);
				break;
			}
		break;
			
		case 'NossasLojas':
			require_once('controller/controllerNossasLojas.php');
			$modo = $_GET['modo'];
			switch($modo){
				case 'buscarCidade':
					$estado = $_POST['estado'];
					$controllerNossasLojas = new ControllerNossasLojas();
					$listCidade = $controllerNossasLojas->listarCidades($estado);
					
					echo($listCidade);
				break;
					
				case 'buscarLoja':
					$cidade = $_POST['cidade'];
					
					$controllerNossasLojas = new ControllerNossasLojas();
					$listLoja = $controllerNossasLojas->listarLojas($cidade);
					
					echo($listLoja);
				break;
			}
		break;

		case 'pedido':
			require_once('controller/controllerPedido.php');
			$modo = $_GET['modo'];
			switch($modo){
				case 'gerar':
					$controllerPedido = new controllerPedido();
					$status = $controllerPedido->gerarPedido();

					if($status == 'sucesso'){
						header('location: view/pedido_finalizado.php');
					}
				break;
			}
		break;
        
        case 'cartao':
            require_once('controller/controllerCartao.php');
            $modo = $_GET['modo'];
            switch($modo){
                case 'inserir':
                    $tipo = $_GET['tipo'];
                    $id = $_GET['id'];
                    
                    $controllerCartao = new controllerCartao();
                    
                    $status = $controllerCartao->inserirCartao($tipo, $id);
                    
                    echo($status);
                break;
                    
                case 'buscarCartao':
                    $id = $_POST['id'];
                    $controllerCartao = new controllerCartao();
                    $listCartao = $controllerCartao->buscarCartao($id);
                    
                    echo($listCartao);
                break;
                    
                case 'editar':
                    $controllerCartao = new controllerCartao();
                    
                    $status = $controllerCartao->atualizarCartao();
                    
                    echo $status;
                break;
                    
                case 'excluir':
                    $id = $_POST['id'];
                    $controllerCartao = new controllerCartao();
                    
                    $status = $controllerCartao->excluirCartao($id);
                    echo $status;
                break;
                    
                case 'status':
                    $id = $_POST['id'];
                    $status = $_POST['status'];
                    $controllerCartao = new controllerCartao();
                    $controllerCartao->atualizarStatus($id, $status);
                break;
                    
                case 'verificar':
                    $id = $_POST['id'];
                    $tipo = $_POST['tipo'];
                    
                    $controllerCartao = new controllerCartao();
                    $status = $controllerCartao->verificarCartao($id, $tipo);
                    echo($status);
                break;
                    
                case 'selecionar':
                    $id = $_POST['id'];
                    $tipo = $_POST['tipo'];
                    
                    $controllerCartao = new controllerCartao();
                    $listCartao = $controllerCartao->selecionarAtivo($id, $tipo);
                    echo($listCartao);
                break;
            }
        break;
        
    }
?>