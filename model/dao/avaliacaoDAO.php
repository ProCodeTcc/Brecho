<?php
	class AvaliacaoDAO{
		public function __construct(){
			
		}
		
		public function selectCor(){
			//intância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM corroupa');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listCor = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listCor);
		}
		
		public function selectMarca(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM marca');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listMarca = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listMarca);
		}
	}
?>