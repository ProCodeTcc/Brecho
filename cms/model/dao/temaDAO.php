<?php
	class TemaDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		public function Insert(Tema $tema){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados no banco
			$stm = $PDO_conexao->prepare('INSERT INTO temaSite(nomeTema, corTema, genero) VALUES(?, ?, ?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $tema->getNome());
			$stm->bindParam(2, $tema->getCor());
			$stm->bindParam(3, $tema->getGenero());
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function selectTemas(){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM temaSite';
			
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			
			while($rsTemas = $resultado->fetch(PDO::FETCH_OBJ)){
				$listTemas[] = new Tema();
				
				$listTemas[$cont]->setId($rsTemas->idTema);
				$listTemas[$cont]->setNome($rsTemas->nomeTema);
				$listTemas[$cont]->setCor($rsTemas->corTema);
				$listTemas[$cont]->setGenero($rsTemas->genero);
				$listTemas[$cont]->setStatus($rsTemas->status);
				
				$cont++;
			}
			
			return $listTemas;
			
		}
	}
?>