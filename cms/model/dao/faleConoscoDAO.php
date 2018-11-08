<?php
	/*
 	    Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 02/10/2018
        Objetivo: ações da página do fale conosco
	*/
	
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 08/11/2018
        Objetivo: implementada função para pesquisar os feedbacks
    */
	class FaleConoscoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		public function selectAll(){
			//instância da classe que conecta com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET LATIN1');
			
			//query que faz a consulta
			$sql = 'SELECT * FROM faleconosco';
			
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//laço para percorrer os dados
			while($rsFaleConosco = $resultado->fetch(PDO::FETCH_OBJ)){
				$listFeedback[] = new FaleConosco();
				
				$listFeedback[$cont]->setId($rsFaleConosco->idRegistro);
				$listFeedback[$cont]->setNome($rsFaleConosco->nomePessoa);
				$listFeedback[$cont]->setEmail($rsFaleConosco->email);
				$listFeedback[$cont]->setTelefone($rsFaleConosco->telefone);
				$listFeedback[$cont]->setSexo($rsFaleConosco->sexo);
				$listFeedback[$cont]->setAssunto($rsFaleConosco->assunto);
				$listFeedback[$cont]->setComentario($rsFaleConosco->comentario);
				
				$cont++;
			}
			
			if($cont != 0){
				//reorno dos dados
				return $listFeedback;
			}else{
				require_once('../erro_tabela.php');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function SelectByID($id){
			//instância da classe que conecta com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que
			$stm = $PDO_conexao->prepare('SELECT * FROM faleconosco WHERE idRegistro = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados retornados em uma variável
			$listFeedback = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listFeedback);
			
			//fechando a conexão
			$conexao-fecharConexao();
		}
		
		public function Delete($id){
			//instância da classe que conecta com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que deleta os dados do banco
			$stm = $PDO_conexao->prepare('DELETE FROM faleconosco WHERE idRegistro = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar os feedbacks
		public function searchFeedback($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare("SELECT * FROM faleconosco WHERE concat_ws(',', nomePessoa, assunto, email, comentario) LIKE ?");

			//parâmetro enviado
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsFaleConosco = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo feedback
				$listFeedback[] = new FaleConosco();

				//setando os atributos
				$listFeedback[$cont]->setId($rsFaleConosco->idRegistro);
				$listFeedback[$cont]->setNome($rsFaleConosco->nomePessoa);
				$listFeedback[$cont]->setEmail($rsFaleConosco->email);
				$listFeedback[$cont]->setTelefone($rsFaleConosco->telefone);
				$listFeedback[$cont]->setSexo($rsFaleConosco->sexo);
				$listFeedback[$cont]->setAssunto($rsFaleConosco->assunto);
				$listFeedback[$cont]->setComentario($rsFaleConosco->comentario);
				
				//contador
				$cont++;
			}

			//verificando se há resultados
			if($cont != 0){
				//se houver, retorna os dados
				return $listFeedback;
			}else{
				//se não, mostra mensagem
				echo('Nenhum registro encontrado..');
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>