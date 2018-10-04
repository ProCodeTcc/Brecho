<?php
	class produtoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		public function selectTamanho($tamanho){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que consulta os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM tamanho WHERE idTipoTamanho = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $tamanho);
			
			$stm->execute();
			
			//contador
			$cont = 0;
			
			while($rsTamanho = $stm->fetchAll(PDO::FETCH_OBJ)){
				$listTamanho[] = new Produto();
				$listTamanho[$cont]->setTamanho($rsTamanho->tamanho);
				$cont++;
			}
			
			return json_encode($listTamanho);
			
			$conexao->fecharConexao();
		}
	}
?>