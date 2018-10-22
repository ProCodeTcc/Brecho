<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 17/10/2018
		Objetivo: Implementado CRUD de unidades
	*/

	class UnidadeDAO{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/dao/bdClass.php');
		}
		
		//função que busca no banco as lojas cadastradas
		public function selectLojas(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//corrigindo acentos
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM nossaloja';
		
			//armazenando o resultado da consulta em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsLojas = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um array de lojas
				$listLojas[] = new Unidade();
				
				//setando os atributos
				$listLojas[$cont]->setLoja($rsLojas->nomeLoja);
				$listLojas[$cont]->setIdLoja($rsLojas->idLoja);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listLojas;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere uma unidade
		public function Insert(Unidade $unidade){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO nossaloja_unidade(nomeUnidade, idLoja) VALUES(?, ?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $unidade->getNome());
			$stm->bindParam(2, $unidade->getIdLoja());
			
			//execução do statement
			$stm->execute();
			
			//verificando o numero de linhas retornadas
			if($stm->rowCount() != 0){
				//se for diferente de 0, armazena o id da unidade em uma variável
				$idUnidade = $PDO_conexao->lastInsertId();
				
				//retornando o id da unidade
				return $idUnidade;
			}else{
				echo('Ocorreu um erro ao inserir os dados da unidade');
			}
			
			$conexao->fecharConexao();
		}
		
		//função que insere uma unidade e um indereço na tabela de relacionamento
		public function InsertUnidadeEndereco($idUnidade, $idEndereco){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados no banco
			$stm = $PDO_conexao->prepare('INSERT INTO unidade_endereco(idUnidade, idEndereco) VALUES(?, ?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $idUnidade);
			$stm->bindParam(2, $idEndereco);
			
			//execução do statement
			$stm->execute();
			
			//verificando numero de linhas retornadas
			if($stm->rowCount() != 0){
				//mensagem de sucesso
				echo('Unidade inserida com sucesso!!');
			}else{
				//mensagem de erro
				echo('Ocorreu um erro ao inserir a unidade');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca todas as unidades cadastradas
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT u.*, e.* FROM nossaloja_unidade as u INNER JOIN unidade_endereco as ue ON u.idUnidade = ue.idUnidade INNER JOIN endereco as e ON
			e.idEndereco = ue.idEndereco';
			
			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			if($resultado){
				//percorrendo os dados
				while($rsUnidades = $resultado->fetch(PDO::FETCH_OBJ)){
					//criando uma nova unidade
					$listUnidades[] = new Unidade();

					//setando os atributos
					$listUnidades[$cont]->setIdEndereco($rsUnidades->idEndereco);
					$listUnidades[$cont]->setId($rsUnidades->idUnidade);
					$listUnidades[$cont]->setNome($rsUnidades->nomeUnidade);
					$listUnidades[$cont]->setIdLoja($rsUnidades->idLoja);
					$listUnidades[$cont]->setCidade($rsUnidades->cidade);

					//incrementando o contador
					$cont++;
				}
				
				return $listUnidades;
			}else{
				require_once('../erro_tabela.php');
			}
			
			$conexao->fecharConexao();
			
		}
		
		//função que busca uma unidade através do ID
		public function selectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT u.*, e.* FROM nossaloja_unidade as u INNER JOIN unidade_endereco as ue ON u.idUnidade = u.idUnidade INNER JOIN endereco as e ON e.idEndereco = ue.idEndereco WHERE u.idUnidade = ?');
			
			//parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//criando uma nova unidade
			$listUnidade = new Unidade();
			
			//armazenando os dados em uma variável
			$listUnidade = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listUnidade);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function Update(Unidade $unidade){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQl();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$stm = $PDO_conexao->prepare('UPDATE nossaloja_unidade SET nomeUnidade = ?, idLoja = ? WHERE idUnidade = ?');
			
			$stm->bindParam(1, $unidade->getNome());
			$stm->bindParam(2, $unidade->getIdLoja());
			$stm->bindParam(3, $unidade->getId());
			
			if($stm->execute()){
				echo('Unidade atualizada com sucesso!');
			}else{
				echo('Ocorreu um erro ao atualizar a unidade');
			}
		}
		
		//função que deleta a unidade do banco
		public function Delete($id, $idEndereco){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que exclui os dados
			$stm = $PDO_conexao->prepare('DELETE u, e FROM nossaloja_unidade as u INNER JOIN endereco as e WHERE u.idUnidade = ? and e.idEndereco = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			$stm->bindParam(2, $idEndereco);
			
			//executando o statement
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo('Unidade excluída com sucesso!!');
			}else{
				echo('Ocorreu um erro ao excluir a unidade');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>