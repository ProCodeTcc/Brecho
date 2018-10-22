<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 21/10/2018
		Objetivo: cadastro e atualização do cliente
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
				
				//redireciona para página inicial
				header('location: index.php');
				
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
			
			//execução do statement
			if($stm->execute()){
				//retorna true se der certo
				echo true;
			}else{
				//false se der errado
				echo false;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>