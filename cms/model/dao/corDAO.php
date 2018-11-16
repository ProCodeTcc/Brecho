<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 04/10/2018
        Objetivo: CRUD das cores

	*/ 
	
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 08/11/2018
        Objetivo: implementada a função para pesquisar as cores
    */ 

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
			if($stm->execute() != true){
                //mensagem de erro
                $status = array('status' => 'erro');
            }
			
			//verificando o número de linhas retornadas
			if($stm->rowCount() != 0){
				//atualizando o status para sucesso
				$status = array('status' => 'sucesso');
			}else{
				//atualizando o status
				$status = array('status' => 'existe');
			}
            
            //retornando o status em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function Update(Cor $cor){
			//instância da classse de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE corroupa SET nome = ?, cor = ? WHERE idCor = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $cor->getNome());
			$stm->bindParam(2, $cor->getCor());
			$stm->bindParam(3, $cor->getId());
			
			//execução do statement
			if($stm->execute()){
                //atualizando o status para atualizado
				$status = array('status' => 'atualizado');
			}else{
                //atualizando o status para erro
				$status = array('status' => 'erro');
			}
            
            //retornando o status em JSON
            return json_encode($status);
			
			$conexao->fecharConexao();
		}
		
		//função que realiza uma consulta no banco de dados pra pegar as cores
		public function selectAll(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM corroupa';
			
			//armazenando o retorno da consulta numa variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsCor = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando uma nova cor
				$listCor[] = new Cor();
				
				//armazenando os dados da cor
				$listCor[$cont]->setId($rsCor->idCor);
				$listCor[$cont]->setNome($rsCor->nome);
				$listCor[$cont]->setCor($rsCor->cor);
				
				$cont++;
			}
			
			if($cont != 0){
				//retornando as cores
				return $listCor;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function SelectByID($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM corroupa WHERE idCor = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//executando o statement
			$stm->execute();
			
			$listCor = $stm->fetch(PDO::FETCH_OBJ);
			
			return json_encode($listCor);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que exclui um registro do banco
		public function Delete($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que deleta os dados do banco
			$stm = $PDO_conexao->prepare('DELETE FROM corroupa WHERE idCor = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//verificando o número de linhas retornadas
			if($stm->rowCount() == 0){
                //atualizando o status para erro
                $status = array('status' => 'erro');
            }
            
            //retornando o status em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar a cores
		public function searchCor($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM corroupa WHERE nome LIKE ?');

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsCor = $stm->fetch(PDO::FETCH_OBJ)){
				//criando uma nova Cor
				$listCor[] = new Cor();

				//setando os atributos
				$listCor[$cont]->setId($rsCor->idCor);
				$listCor[$cont]->setNome($rsCor->nome);
				$listCor[$cont]->setCor($rsCor->cor);

				//incrementando o contador
				$cont++;
			}

			//verificando se há algum resultado
			if($cont != 0){
				//retorna a cor
				return $listCor;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>