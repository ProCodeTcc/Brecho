<?php
    
    //armazenando a controller em uma variável
	$controller = $_GET['controller'];	
	
	//switch na controller para verificar qual a controller
    switch($controller){
        //controlando as ações da enquete
		case 'enquete':
            //resgatando o modo
			$modo = $_GET['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerEnquete.php');
            
            //switch no modo par averificar qual o modo
			switch($modo){
				case 'qtdA':
                    //instância da controller da enquete
					$controllerEnquete = new controllerEnquete();
                    
                    //atualizando a quantidade da alternativa e retornando o status
					$status = $controllerEnquete->atualizarQtdA();
                    
                    //echo no status
                    echo($status);
				break;
				
				case 'qtdB':
                    //instância da controller da enquete
					$controllerEnquete = new controllerEnquete();
                    
                    //atualizando a quantidade da alternativa e retornando o status
					$status = $controllerEnquete->atualizarQtdB();
                    
                    //echo no status
                    echo($status);
				break;
					
				case 'qtdC':
                    //instância da controller da enquete
					$controllerEnquete = new controllerEnquete();
                    
                    //atualizando a quantidade da alternativa e retornando o status
					$status = $controllerEnquete->atualizarQtdC();
                    
                    //echo no status
                    echo($status);
				break;
					
				case 'qtdD':
                    //instância da controller da enquete
					$controllerEnquete = new controllerEnquete();
                    
                    //atualizando a quantidade da alternativa e retornando o status
					$status = $controllerEnquete->atualizarQtdD();
                    
                    //echo no status
                    echo($status);
				break;
			}
		break;
		
		case 'FaleConosco':
            //inclusão do arquivo da controller
            require_once('controller/controllerFaleConosco.php');
            
            //instância da controller do fale conosco
            $controllerFaleConosco = new controllerFaleConosco();
            
            //enviando a pergunta e armazenando o status
            $status = $controllerFaleConosco->inserirFaleConosco();

            //echo no status
            echo $status;
        break;
            
        case 'ClienteFisico':
            //resgatando o modo e armazenando em uma variável
			$modo = $_GET['modo'];
            
            //inclusão do arquivo da controller
            require_once('controller/controllerClienteFisico.php');
            
            //switch no modo para verificar qual o modo
            switch($modo){
				case 'cadastrar':
                    //instância da controller
					$controllerClienteFisico = new controllerClienteFisico();
                    
                    //cadastrando o cliente e armazenando o status
					$status = $controllerClienteFisico->inserirCliente();

                    //echo no status
					echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
                    
					//instância da controller
					$controllerClienteFisico = new controllerClienteFisico();
                    
                    //armazenando os dados do cliente em uma variável
					$listCliente = $controllerClienteFisico->listarCliente($id);
					
                    //echo nos dados do cliente
					echo($listCliente);
				break;
					
				case 'atualizar':
                    //instância da controller
					$controllerClienteFisico = new controllerClienteFisico();
                    
                    //atualizando os dados e armazenando o status
					$status = $controllerClienteFisico->atualizarCliente();
                    
                    //echo no status
                    echo $status;
				break;

				case 'validarUsuario':
                    //resgatando o campo
					$usuario = $_POST['campo'];

                    //instância da controller
					$controllerClienteFisico = new controllerClienteFisico();
                    
                    //armazenando o resultado da validação
					$resultado = $controllerClienteFisico->validarUsuario($usuario);

                    //echo no resultado
					echo($resultado);
				break;
				
				case 'validarEmail':
                    //resgatando o campo
					$email = $_POST['campo'];

                    //instância da controller
					$controllerClienteFisico = new controllerClienteFisico();

                    //armazenando o resultado da validação
					$resultado = $controllerClienteFisico->validarEmail($email);

                    //echo no resultado
					echo($resultado);
				break;

				case 'validarCpf':
                    //resgatando o camp
					$cpf = $_POST['campo'];

                    //instância da controller
					$controllerClienteFisico = new controllerClienteFisico();

                    //armazenando o resultado da validação
					$resultado = $controllerClienteFisico->validarCpf($cpf);

                    //echo no resultado
					echo($resultado);
				break;
			}
            
		break;
		
		case 'ClienteJuridico':
            //resgatando o modo
			$modo = $_GET['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerClienteJuridico.php');
            
            //switch no modo para verificar qual o modo
			switch($modo){
				case 'cadastrar':
                    //instância da controller
					$controllerClienteJuridico = new controllerClienteJuridico();
                    
                    //cadastrando o cliente e armazenando o status
					$status = $controllerClienteJuridico->inserirCliente();

                    //echo no status
					echo($status);
				break;
					
				case 'buscar':
                    //resgatando o ID
					$id = $_POST['id'];
					
                    //instância da controller
					$controllerClienteJuridico = new controllerClienteJuridico();
                    
                    //armazenando os dados do cliente em
					$listCliente = $controllerClienteJuridico->buscarCliente($id);
					
                    //echo nos dados do cliente
					echo($listCliente);
				break;
					
				case 'atualizar':
                    //instância da controller
					$controllerClienteJuridico = new controllerClienteJuridico();
                    
                    //atualizando os dados do cliente e armazenando o status
					$status = $controllerClienteJuridico->atualizarCliente();
            
                    //echo no status
                    echo $status;
				break;

				case 'validarUsuario':
                    //resgatando o campo
					$usuario = $_POST['campo'];

                    //instância da controller
					$controllerClienteJuridico = new controllerClienteJuridico();
                    
                    //armazenando o resultado da validação
					$resultado = $controllerClienteJuridico->validarUsuario($usuario);

                    //echo no resultado
					echo $resultado;
				break;

				case 'validarEmail':
                    //resgatando o campo
					$email = $_POST['campo'];

                    //instância da controller
					$controllerClienteJuridico = new controllerClienteJuridico();
                    
                    //armazenando o resultado da validação
					$resultado = $controllerClienteJuridico->validarEmail($email);

                    //echo no resultado
					echo($resultado);
				break;

				case 'validarCnpj':
                    //resgatando o campo
					$cnpj = $_POST['campo'];

                    //instância da controller
					$controllerClienteJuridico = new controllerClienteJuridico();
                    
                    //armazenando o resultado da validação
					$resultado = $controllerClienteJuridico->validarCnpj($cnpj);

                    //echo no resultado
					echo($resultado);
				break;
				
			}
		break;
			
		case 'avaliação':
            //resgatando o modo
			$modo = $_GET['modo'];
            
            //inclusão do arquivo da controller
			require_once('controller/controllerAvaliacao.php');
            
            //switch no modo para verificar qual o modo
			switch($modo){
				case 'cadastrar':
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //inserindo o produto e armazenando o status
					$status = $controllerAvaliacao->inserirProduto();

                    //echo no status
					echo($status);
				break;
				
				case 'listarCor':
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //armazenando os dados da cor
					$listCor = $controllerAvaliacao->listarCor();
					
                    //echo nos dados
					echo($listCor);
				break;
					
				case 'listarMarca':
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //armazenando os dados da marca
					$listMarca = $controllerAvaliacao->listarMarca();
					
                    //echo nos dados
					echo($listMarca);
				break;
					
				case 'listarCategoria':
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //armazenando os dados da categoria
					$listCategoria = $controllerAvaliacao->listarCategoria();
					
                    //echo nos dados
					echo($listCategoria);
				break;
					
				case 'buscarTamanho':
                    //resgatando o tipo do tamanho
					$tipo = $_GET['tipo'];
                    
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //armazenando os tamanhos em uma variável
					$listTamanho = $controllerAvaliacao->listarTamanho($tipo);
					
                    //echo nos tamanhos
					echo($listTamanho);
				break;

				case 'buscarSubcategoria':
                    //resgatando o ID da categoria
					$idCategoria = $_GET['id'];
                    
                    //instância da controller
					$controllerAvaliacao = new controllerAvaliacao();
                    
                    //armazenando as subcategorias
					$listSubcategoria = $controllerAvaliacao->listarSubcategoria($idCategoria);

                    //echo nas subcategorias
					echo($listSubcategoria);
				break;
			}
            
        case 'login':
            //inclusão do arquivo da controller
            require_once('controller/controllerLogin.php');
            
            //resgatando o modo
            $modo = $_GET['modo'];
            
            //switch no modo para verificar qual o modo
            switch($modo){
				case 'logar':
                    //instância da controller
					$controllerLogin = new controllerLogin();
                    
                    //buscando a conta e armazenando o status
					$status = $controllerLogin->BuscarConta();

                    //echo no status
					echo($status);
				break;
					
				case 'deslogar':
                    //instância da controller
					$controllerLogin = new controllerLogin();
                    
                    //chamada da função para deslogar
					$controllerLogin->deslogar();
				break;
			}
            
            
		break;
			
		case 'produto':
            //inclusão do arquivo da controller
			require_once('controller/controllerProduto.php');
            
            //resgatando o modo
			$modo = $_GET['modo'];
            
            //switch no modo para verificar qual o modo
			switch($modo){
				case 'clique':
                    //resgatando o ID do produto
					$id = $_POST['id'];

                    //instância da controller
					$controllerProduto = new controllerProduto();

                    //chamada da função para atualizar o clique
					$controllerProduto->atualizarClique($id);
				break;

				case 'adicionarCarrinho':
                    //resgatando o ID do produto
					$id = $_POST['id'];
                    
                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //armazenando os dados do produto
					$listProduto = $controllerProduto->adicionarCarrinho($id);

                    //echo nos dados
					echo($listProduto);
				break;

				case 'listarProdutos':
                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //armazenando os dados do produto
					$listProduto = $controllerProduto->listarProdutosCarrinho();

                    //retornando os dados do produto
					return $listProduto;
				break;

				case 'removerItem':
					$id = $_POST['id'];

                    //instância da controller
					$controllerProduto = new controllerProduto();
                    
                    //chamada da função que remove o item do carrinho
					$controllerProduto->removerItemCarrinho($id);
				break;
			}
		break;
			
		case 'NossasLojas':
            //inclusão do arquivo da controller
			require_once('controller/controllerNossasLojas.php');
            
            //resgatando o modo
			$modo = $_GET['modo'];
            
            //switch no modo para verificar qual o modo
			switch($modo){
				case 'buscarCidade':
                    //resgatando o restado
					$estado = $_POST['estado'];
                    
                    //instância da controller
					$controllerNossasLojas = new ControllerNossasLojas();
                    
                    //armazenando os dados da cidade
					$listCidade = $controllerNossasLojas->listarCidades($estado);
					
                    //retornando os dados
					echo($listCidade);
				break;
					
				case 'buscarLoja':
                    //resgatando a cidade
					$cidade = $_POST['cidade'];
                    
					//instância da controller
					$controllerNossasLojas = new ControllerNossasLojas();
                    
                    //armazenando os dados das lojas
					$listLoja = $controllerNossasLojas->listarLojas($cidade);
					
                    //echo nos dados
					echo($listLoja);
				break;
			}
		break;

		case 'pedido':
            //inclusão do arquivo da controller
			require_once('controller/controllerPedido.php');
            
            //resgatando o modo
			$modo = $_GET['modo'];
            
            //switch no modo para verificar qual o modo
			switch($modo){
				case 'gerar':
                    $qtdParcela = $_POST['qtdParcela'];
                    //instância da controller
					$controllerPedido = new controllerPedido();
                    
                    //chamada da função que gera o pedido
					$status = $controllerPedido->gerarPedido($qtdParcela);
                    echo($status);
                    //verificando se o pedido foi feito
					if($status == 'sucesso'){
                        //redirecionando o usuário
						header('location: view/pedido_finalizado.php');
					}
				break;
                    
                case 'gerarDuplicata':
                    //instância da controller
                    $controllerPedido = new controllerPedido();
                    
                    //gerando uma duplicata
                    $status = $controllerPedido->gerarDuplicata();
                    
                    echo($status);
                break;
			}
		break;
    }
?>