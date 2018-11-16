<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 21/10/2018
		Objetivo: cadastro e atualização do cliente
	*/

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 23/10/2018
		Objetivo: validação dos campos de email, cpf, e usuário
	*/

	class ClienteJuridicoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função para inserir o cliente juridico
		public function Insert(ClienteJuridico $cliente){
			//instância da classe de conexão do banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função pra conectar com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere um cliente juridico
			$stm = $PDO_conexao->prepare('INSERT INTO clientejuridico(razao, telefone, celular, email, cnpj, login, senha) VALUES(?,?,?,?,?,?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $cliente->getRazaoSocial());
			$stm->bindParam(2, $cliente->getTelefone());
			$stm->bindParam(3, $cliente->getCelular());
			$stm->bindParam(4, $cliente->getEmail());
			$stm->bindParam(5, $cliente->getCnpj());
			$stm->bindParam(6, $cliente->getLogin());
			$stm->bindParam(7, $cliente->getSenha());
			
			//execução do statement
			$stm->execute();
			
			//verificando o retorno das linhas
			if($stm->rowCount() != 0){
				//armazena o ID do cliente
				$idCliente = $PDO_conexao->lastInsertId();

				//retornando o ID do cliente
				return $idCliente;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que relaciona um cliente com o endereço
		public function InsertClienteEndereco($idEndereco, $idCliente){
			//intância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO endereco_clientejuridico(idEndereco, idCliente) VALUES(?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $idEndereco);
			$stm->bindParam(2, $idCliente);
			
			//execução do statement
			$stm->execute();

			//verificando o retorno
			if($stm->rowCount() != 0){
				//mensagem de sucesso
				$status = array('status' => 'sucesso');
			}else{
				//mensagem de erro
				$status = array('status' => 'erro');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function SelectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT c.*, e.* FROM clientejuridico as c INNER JOIN endereco_clientejuridico as ce ON c.idCliente = ce.idCliente INNER JOIN endereco as e ON e.idEndereco = ce.idEndereco WHERE c.idCliente = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listCliente = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listCliente);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza o cliente juridico
		public function Update(ClienteJuridico $cliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//atualizando os dados
			$stm = $PDO_conexao->prepare('UPDATE clientejuridico SET razao = ?, telefone = ?, celular = ?, email = ?, cnpj = ?, senha = ? WHERE idCliente = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $cliente->getRazaoSocial());
			$stm->bindParam(2, $cliente->getTelefone());
			$stm->bindParam(3, $cliente->getCelular());
			$stm->bindParam(4, $cliente->getEmail());
			$stm->bindParam(5, $cliente->getCnpj());
			$stm->bindParam(6, $cliente->getSenha());
			$stm->bindParam(7, $cliente->getIdCliente());
			
			//verificando retorno
			if($stm->execute()){
				//mensagem de sucesso
				$status = array('status' => 'atualizado');
			}else{
				//mensagem de erro
				$status = array('status' => 'erro');
			}
            
            //retornando os dados em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que relaciona o cliente com o produto em avaliação
		public function insertClienteProduto($idCliente, $idProduto, $data){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO clientejuridico_produtoavaliacao(idClienteJuridico, idProdutoAvaliacao, data) VALUES(?,?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);
			$stm->bindParam(2, $idProduto);
			$stm->bindParam(3, $data);

			//execução do statement
			$stm->execute();

			//verificando o retorno
			if($stm->rowCount() != 0){
				//mensagem de sucesso
				$status = array('status' => 'sucesso');
			}else{
				//mensagem de erro
				$status = array('status' => 'erro');
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que relaciona o cliente como pedido
		public function insertPedidoCliente($idPedido, $idCliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//função que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO clientejuridico_pedidovenda(idClienteJuridico, idPedidoVenda) VALUES(?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);
			$stm->bindParam(2, $idPedido);

			//execução do statement
			$stm->execute();

			//fechandoa conexão
			$conexao->fecharConexao();
		}

		//função que busca os produtos em avaliação do cliente jurídico
		public function selectProduto($idCliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT p.nomeProduto AS nome, p.preco, cjp.data FROM produtoAvaliacao AS p INNER JOIN clientejuridico_produtoavaliacao AS cjp
			 ON p.idProdutoAvaliacao = cjp.idProdutoAvaliacao INNER JOIN clientejuridico AS cj ON cj.idCliente = cjp.idClienteJuridico WHERE cj.idCliente = ?');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//instância da classe Avaliaçao
				$listProdutos[] = new Avaliacao();
				
				//setando os atributos
				$listProdutos[$cont]->setNome($rsProdutos->nome);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setData($rsProdutos->data);

				//incrementando o contador
				$cont++;
			}

			if($cont != 0){
				//retornando os dados
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que lista os pedidos do cliente
		public function selectCompra($idCliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT pv.idPedidoVenda as idPedido, pv.valorPedidoVenda as valor, pv.dataPedidoVenda as data FROM pedidovenda AS pv INNER JOIN clientejuridico_pedidovenda 
			AS cjp ON pv.idPedidoVenda = cjp.idPedidoVenda INNER JOIN clientejuridico AS cj ON cj.idCliente = cjp.idClienteJuridico WHERE cj.idCliente = ?');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsPedidos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo pedido
				$listPedidos[] = new Pedido();

				//setando os atributos
				$listPedidos[$cont]->setIdPedido($rsPedidos->idPedido);
				$listPedidos[$cont]->setValor($rsPedidos->valor);
				$listPedidos[$cont]->setDtPedido($rsPedidos->data);

				//incrementando o contador
				$cont++;
			}

			if($cont != 0){
				//retornando os dados
				return $listPedidos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que busca as vendas concretizadas através de uma compra pelo brechó
		public function selectVenda($idCliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT pc.idPedidoCompra AS idPedido, pc.valorPedido AS valor, pc.data FROM pedidocompra AS pc INNER JOIN clientejuridico_pedidocompra 
			AS cjp ON cjp.idPedidoCompra = pc.idPedidoCompra INNER JOIN clientejuridico AS cj ON cj.idCliente = cjp.idClienteJuridico WHERE cj.idCliente = ?');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsPedidos = $stm->fetch(PDO::FETCH_OBJ)){
				//instância da classe Pedido
				$listPedidos[] = new Pedido();

				//setando os atributos
				$listPedidos[$cont]->setIdPedido($rsPedidos->idPedido);
				$listPedidos[$cont]->setValor($rsPedidos->valor);
				$listPedidos[$cont]->setDtPedido($rsPedidos->data);
				
				//incrementando o contador
				$cont++;
			}

			if($cont != 0){
				//retornando os dados
				return $listPedidos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que verifica o campo de usuário
		public function checkUsuario($usuario){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT login FROM clientejuridico WHERE login = ?');

			//parâmetros enviados
			$stm->bindParam(1, $usuario);

			//execução do statement
			$stm->execute();

			//retornar as linhas
			if($stm->rowCount() != 0){
				//retorna falso se houver usuário igual
				echo 'false';
			}else{
				//retorna true se não houver
				echo 'true';
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que valida o campo de email
		public function checkEmail($email){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT email FROM clientejuridico WHERE email = ?');

			//parâmetros enviados
			$stm->bindParam(1, $email);

			//execução do statement
			$stm->execute();

			//verificando o retorno das linhas
			if($stm->rowCount() != 0){
				//retorna falso se houver usuário igual
				echo 'false';
			}else{
				//retorna true se não houver
				echo 'true';
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que valida o CNPJ
		public function checkCnpj($cnpj){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT cnpj FROM clientejuridico WHERE cnpj = ?');

			//parâmetros enviados
			$stm->bindParam(1, $cnpj);

			//execução do statement
			$stm->execute();

			//retornando as linhas
			if($stm->rowCount() != 0){
				//retorna falso se houver CNPJ igual
				echo 'false';
			}else{
				//retorna true se não houver
				echo 'true';
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>