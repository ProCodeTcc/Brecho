<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: Implementado listagem das unidades
	*/

	class RetiradaDAO{
		public function __construct(){
			require('bdClass.php');
		}
		
		//função que insere uma retirada
		public function Insert(Retirada $retirada){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO retirada(dataRetirada, idUnidade, idPedido) VALUES(?,?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $retirada->getDtRetirada());
			$stm->bindParam(2, $retirada->getIdUnidade());
			$stm->bindParam(3, $retirada->getIdPedido());
			
			//execução do statement
			$stm->execute();
			
			//verificando o retorno das linhas
			if($stm->rowCount() != 0){
				//se for diferente de 0, mostra mensagem de sucesso
				echo('Retirada marcada com sucesso!!');
			}else{
				//se for 0, mensagem de erro
				echo('Ocorreu um erro ao marcar a retirada');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que consulta as retiradas marcadas
		public function selectAll(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consula
			$sql = 'SELECT * FROM retirada';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsRetirada = $resultado->fetch(PDO::FETCH_OBJ)){
				//criado uma nova retirada
				$listRetirada[] = new Retirada;
				
				//setando os atributos
				$listRetirada[$cont]->setIdRetirada($rsRetirada->idRetirada);
				$listRetirada[$cont]->setDtRetirada($rsRetirada->dataRetirada);
				$listRetirada[$cont]->setIdPedido($rsRetirada->idPedido);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listRetirada;
		}
		
		
		//função que exibe as lojas
		public function selectLojas(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT * FROM nossaloja_unidade';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			$listLojas = $resultado->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listLojas);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que exibe os pedidos
		public function selectPedidos(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM pedidovenda';
			
			//armazenando os dados em uma variavel
			$resultado = $PDO_conexao->query($sql);
			
			$listPedido = $resultado->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listPedido);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
	}
?>