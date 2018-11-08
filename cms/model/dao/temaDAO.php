<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 11/10/2018
        Objetivo: implementado função que insere e busca os temas

    */

/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 12/10/2018
        Objetivo: implementado função que atualiza e exclui os temas

    */

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
			
			if($stm->rowCount() != 0){
				echo('Tema inserido com sucesso!!');
			}else{
				echo('Ocorreu um erro ao inserir o tema');
			}
			
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
			
			if($cont != 0){
				return $listTemas;
			}else{
				require_once('../erro_tabela.php');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function selectByID($id){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM temaSite where idTema = ?');
			
			//parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listTema = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listTema);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function Update(Tema $tema){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE temaSite SET nomeTema = ?, corTema = ?, genero = ? WHERE idTema = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $tema->getNome());
			$stm->bindParam(2, $tema->getCor());
			$stm->bindParam(3, $tema->getGenero());
			$stm->bindParam(4, $tema->getId());
			
			//executando o statement
			if($stm->execute()){
				echo('Tema atualizado com sucesso!!');
			}else{
				echo('Ocorreu um erro ao atualizar o tema');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function Delete($id){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que exclui os dados
			$stm = $PDO_conexao->prepare('DELETE FROM temaSite WHERE idTema = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//executando o statement
			if($stm->execute()){
				echo('Tema excluído com sucesso!!');
			}else{
				echo('Ocorreu um erro ao excluir um tema');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que ativa um tema
		public function activateOne($id, $genero){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//atualizando o status a partir do id e do genero
			$stm = $PDO_conexao->prepare('UPDATE temasite SET status = 1 WHERE idTema = ? and genero = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			$stm->bindParam(2, $genero);
			
			//execução do statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que desativa todos os temas, exceto o ativo
		public function disableAll($id, $genero){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//atualizando o status a partir do id e do genero
			$stm = $PDO_conexao->prepare('UPDATE temasite SET status = 0 WHERE idTema <> ? and genero = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			$stm->bindParam(2, $genero);
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar os temas
		public function searchTema($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM temasite WHERE nomeTema LIKE ?');

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsTemas = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo Tema
				$listTema[] = new Tema();

				//setando os atributos
				$listTema[$cont]->setId($rsTemas->idTema);
				$listTema[$cont]->setNome($rsTemas->nomeTema);
				$listTema[$cont]->setCor($rsTemas->corTema);
				$listTema[$cont]->setGenero($rsTemas->genero);

				//incrementando o contador
				$cont++;
			}

			//verificando se há algum resultado
			if($cont != 0){
				//se houver, retorna os dados
				return $listTema;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
	}
?>