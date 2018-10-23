<?php
	class NossasLojasDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que trás as cidades que existem no banco
		public function selectCidade($estado){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT cidade FROM endereco WHERE estado = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $estado);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listEstado = $stm->fetch(PDO::FETCH_OBJ);
			
			//verifica o número de linhas
			if($stm->rowCount() != 0){
				//se for diferente de 0, retorna os dados em JSON
				return json_encode($listEstado);
			}else{
				//retorna falso
				echo('false');
			}
		
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que trás as lojas
		public function selectLoja($cidade){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT e.* FROM endereco AS e INNER JOIN unidade_endereco AS ue on e.idEndereco = ue.idEndereco WHERE e.cidade = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $cidade);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listCidade = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados
			return json_encode($listCidade);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>