<?php
	/*
		Projeto: Brechó
		Autor: Felipe Monteiro
		Data: 08/10/2018
		Objetivo: Implementado cadastro do cliente
	*/

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: Implementado atualização do cadastro
	*/

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: Implementado validação dos campos de usuário, email e CPF
	*/

    class ClienteFisicoDAO{
    
        public function __construct(){
            require_once('bdClass.php');
        }
        
        public function Insert(Cliente $cliente){
        
            //Instancia da classe de cinexão com o banco 
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //criando um statement e preparando a querry que irá inserir os dados no banco.
            
            $stm = $PDO_conexao->prepare('insert into clientefisico (nome, sobrenome,telefone,celular,email,cpf,dataNascimento, login, senha, sexo) values (?,?,?,?,?,?,?,?,?,?)');
            
            $stm->bindParam(1, $cliente->getNome());
            $stm->bindParam(2, $cliente->getSobrenome());
            $stm->bindParam(3, $cliente->getTelefone());
            $stm->bindParam(4, $cliente->getCelular());
            $stm->bindParam(5, $cliente->getEmail());
            $stm->bindParam(6, $cliente->getCpf());
            $stm->bindParam(7, $cliente->getDataNascimento());
            $stm->bindParam(8, $cliente->getLogin());
            $stm->bindParam(9, $cliente->getSenha());
            $stm->bindParam(10, $cliente->getSexo());
//            $stm->bindParam(11, $cliente->getApp());
            
//            var_dump($cliente);
            
            if($stm->execute()){
                header("location:index.php");
                $idCliente=$PDO_conexao->lastInsertId();
                return $idCliente;
            }else{
                echo('Ocorreu um erro ao inserir os dados do cliente');
            }
            
			$conexao->fecharConexao();
			
        }
        
        
        
        public function InserirClienteEndereco($idCliente,$idEndereco){
            //Instancia da classe de cinexão com o banco 
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //criando um statement e preparando a querry que irá inserir os dados no banco.
            $stm = $PDO_conexao->prepare('insert into clientefisico_endereco(idClienteFisico,idEndereco) values(?,?)');
            
            $stm->bindParam(1, $idCliente);
            $stm->bindParam(2, $idEndereco);
            
            $stm->execute();
			
			$conexao->fecharConexao();
            
        }
		
		//função que busca um cliente através do ID
		public function SelectByID($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT c.*, e.* FROM clientefisico as c INNER JOIN clientefisico_endereco as ce ON c.idCliente = ce.idClienteFisico INNER JOIN endereco as e ON e.idEndereco = ce.idEndereco WHERE c.idCliente = ?');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//criando um novo cliente
			$listCliente = new ClienteFisico();
			
			//armazenando os dados do cliente
			$listCliente = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listCliente);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza um cliente
		public function Update(ClienteFisico $cliente){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE clientefisico SET nome = ?, sobrenome = ?, telefone = ?, celular = ?, email = ?, dataNascimento = ?, 
			senha = ?, sexo = ? WHERE idCliente = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $cliente->getNome());
			$stm->bindParam(2, $cliente->getSobrenome());
			$stm->bindParam(3, $cliente->getTelefone());
			$stm->bindParam(4, $cliente->getCelular());
			$stm->bindParam(5, $cliente->getEmail());
			$stm->bindParam(6, $cliente->getdataNascimento());
			$stm->bindParam(7, $cliente->getSenha());
			$stm->bindParam(8, $cliente->getSexo());
			$stm->bindParam(9, $cliente->getIdCliente());
			
			//verificando retorno
			if($stm->execute()){
				//mensagem de sucesso
				echo('Dados atualizados com sucesso!!');
			}else{
				//mensagem de erro
				echo('Ocorreu um erro ao atualizar os dados');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que valida o usuário
		public function checkUsuario($usuario){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT login FROM clientefisico WHERE login = ?');

			//parâmetro enviado
			$stm->bindParam(1, $usuario);
			
			//execução do statement
			$stm->execute();

			//verificandoo retorno das linhas
			if($stm->rowCount() != 0){
				//retorna falso se houver um usuário igual
				echo 'false';
			}else{
				//true, se não houver
				echo 'true';
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que relaciona um cliente com um produto
		public function insertClienteProduto($idCliente, $idProduto, $data){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO clientefisico_produtoavaliacao(idClienteFisico, idProdutoAvaliacao, data) VALUES(?,?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);
			$stm->bindParam(2, $idProduto);
			$stm->bindParam(3, $data);

			//execução do statement
			$stm->execute();

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que insere relaciona o cliente fisico e o pedido
        public function insertPedidoCliente($idPedido, $idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO clientefisico_pedidovenda(idClienteFisico, idPedidoVenda) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            $stm->bindParam(2, $idPedido);

            //execução do statement
            $stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }

		//função que trás os produtos em avaliação de um cliente
		public function selectProduto($idCliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT p.nomeProduto as nome, p.preco, cp.data FROM produtoavaliacao as p INNER JOIN clientefisico_produtoavaliacao as cp ON cp.idProdutoAvaliacao = p.idProdutoAvaliacao
			INNER JOIN clientefisico as c ON c.idCliente = cp.idClienteFisico WHERE c.idCliente = ?');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProdutos[] = new Avaliacao();

				//setando os atributos
				$listProdutos[$cont]->setNome($rsProdutos->nome);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setData($rsProdutos->data);
				
				//incrementando o contador
				$cont++;
			}

			if($cont != 0){
				//retornando os produtos
				return $listProdutos;
			}

			//fechando a conexão
			$conexao->fecharConexao();

		}

		//função que lista os pedidos do cliente físico
		public function selectCompra($idCliente){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT pv.idPedidoVenda as idPedido, pv.valorPedidoVenda as valor, pv.dataPedidoVenda as data, pv.status FROM pedidovenda AS pv 
			INNER JOIN clientefisico_pedidovenda AS cfp ON pv.idPedidoVenda = cfp.idPedidoVenda INNER JOIN clientefisico AS cf ON cf.idCliente = cfp.idClienteFisico
			WHERE cf.idCliente = ?');

			//parâmetros enviados
			$stm->bindParam(1, $idCliente);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsPedidos = $stm->fetch(PDO::FETCH_OBJ)){
				//instância da classe pedido
				$listPedidos[] = new Pedido();

				//setando os atributos
				$listPedidos[$cont]->setIdPedido($rsPedidos->idPedido);
				$listPedidos[$cont]->setValor($rsPedidos->valor);
				$listPedidos[$cont]->setDtPedido($rsPedidos->data);
				$listPedidos[$cont]->setStatus($rsPedidos->status);

				//contador
				$cont++;
			}

			if($cont != 0){
				//retornando os produtos
				return $listPedidos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

        //função que lista as vendas feitas através de uma compra pelo brechó
        public function selectVenda($idCliente){
			//instância da classe que conecta com o banco
            $conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT pc.idPedidoCompra AS idPedido, pc.valorPedido AS valor, pc.data FROM pedidocompra AS pc INNER JOIN clientefisico_pedidocompra 
			AS cfp ON cfp.idPedidoCompra = pc.idPedidoCompra INNER JOIN clientefisico AS cf ON cf.idCliente = cfp.idClienteFisico WHERE cf.idCliente = ?');

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
				//retornando os produtos
				return $listPedidos;
			}

			//fechando a conexão
            $conexao->fecharConexao();
        }

		//função que valida o email
		public function checkEmail($email){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT email FROM clientefisico WHERE email = ?');

			//parâmetros enviados
			$stm->bindParam(1, $email);

			//execução do statement
			$stm->execute();

			//verificando retorno das linhas
			if($stm->rowCount() != 0){
				//retorna false se houver um usuário igual
				echo 'false';
			}else{
				//true, se não houver
				echo 'true';
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que valida o CPF
		public function checkCpf($cpf){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT cpf FROM clientefisico WHERE cpf = ?');

			//parâmetros enviados
			$stm->bindParam(1, $cpf);

			//execução do statement
			$stm->execute();

			//verificnado retorno das linhas
			if($stm->rowCount() != 0){
				//retorna false se houver usuário igual
				echo 'false';
			}else{
				//true se não houver
				echo 'true';
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
    }


?>