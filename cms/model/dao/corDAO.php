<?php
	class corDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função para inserir uma cor
		public function Insert(Cor $cor){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere no banco
			$stm = $PDO_conexao->prepare('INSERT INTO corroupa(nome, cor) SELECT ?, ? from dual WHERE NOT EXISTS(SELECT * FROM corroupa WHERE nome = ? and cor = ?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $cor->getNome());
			$stm->bindParam(2, $cor->getCor());
			$stm->bindParam(3, $cor->getNome());
			$stm->bindParam(4, $cor->getCor());
			
			//execução do statement
			$stm->execute();
			
			//verificando o número de linhas retornadas
			if($stm->rowCount() != 0){
				//caso seja diferente de 0, emite uma mensagem de sucesso
				echo('Cor inserida com sucesso!!');
			}else{
				//caso seja 0, emite uma mensagem de erro
				echo('Essa cor já existe no sistema!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>