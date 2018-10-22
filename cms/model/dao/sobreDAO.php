<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 04/10/2018
        Objetivo: CRUD da página sobre

    */ 

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 22/10/2018
        Objetivo: Implementao a função que limita a exclusão de um conteúdo da pág sobre se houver apenas um

    */ 

	class SobreDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que insere o layout 1 no banco de dados
		public function Insert(Sobre $sobre){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
				
			//query para inserir os dados
			$stm = $PDO_conexao->prepare('INSERT INTO sobre(titulo, descricao, imagem, tipoLayout) VALUES(?,?,?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getImagem());
			$stm->bindParam(4, $sobre->getLayout());
			
			//executando o statement
			$stm->execute();
			
			//verificando o retorno
			if($stm->rowCount() != 0){
				echo('Layout inserido com sucesso!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca no banco todos os dados na tabela de layout
		public function SelectAllLayout1(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que busca os dados no banco
			$sql = 'SELECT * FROM sobre WHERE tipoLayout = 1';
			
			//armazenando o retorno em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//variável de contagem
			$cont = 0;
			
			//percorrendo os dados
			while($rsSobre = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo layout
				$listSobre[] = new Sobre();
				
				//adicionando os dados no layout
				$listSobre[$cont]->setId($rsSobre->idSobre);
				$listSobre[$cont]->setTitulo($rsSobre->titulo);
				$listSobre[$cont]->setDescricao($rsSobre->descricao);
				$listSobre[$cont]->setImagem($rsSobre->imagem);
				$listSobre[$cont]->setStatus($rsSobre->status);
				$listSobre[$cont]->setLayout($rsSobre->tipoLayout);
				
				$cont++;
			}
			
			if($cont != 0){
				return $listSobre;
			}else{
				require_once('../erro_tabela.php');
			}
			
			$conexao->fecharConexao();
		}
		
		//query que seleciona um layout a partir do ID
		public function SelectLayoutByID($id){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que seleciona os dados do banco
			$stm = $PDO_conexao->prepare('SELECT * FROM sobre WHERE idSobre = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listLayout = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listLayout);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//query que atualiza o layout 1
		public function UpdateLayout1(Sobre $sobre){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que atualiza os dados do banco
			$stm = $PDO_conexao->prepare('UPDATE sobre SET titulo = ?, descricao = ?, imagem = ? WHERE idSobre = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getImagem());
			$stm->bindParam(4, $sobre->getId());
			
			if($stm->execute()){
				echo('Layout atualizado com sucesso!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função para excluir um registro no banco
		public function Delete($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a exclusão
			$stm = $PDO_conexao->prepare('DELETE FROM sobre WHERE idSobre = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo('Layout excluído com sucesso!!');
			}else{
				echo('erro');
			}
			
			$conexao->fecharConexao();
		}
		
		//função que ativa apenas um layout no banco
		public function activateOne($id, $layout){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza o status
			$stm = $PDO_conexao->prepare('UPDATE sobre SET status = 1 WHERE idSobre = ? and tipoLayout = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $id);
			$stm->bindParam(2, $layout);
			
			//execução do statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que desativa todos os layouts, com exceção do ativo
		public function disableAll($id, $layout){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza o status
			$stm = $PDO_conexao->prepare('UPDATE sobre SET status = 0 WHERE idSobre <> ? and tipoLayout = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $id);
			$stm->bindParam(2, $layout);
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		/*************************************** LAYOUT 2 ***************************************************/
		
		//função que insere o layout2 no banco
		public function InsertLayout2(Sobre $sobre){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que insere os dados no banco
			$stm = $PDO_conexao->prepare('INSERT INTO sobre(titulo, descricao, descricao2, imagem, tipoLayout) VALUES(?,?,?,?,?)');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getDescricao2());
			$stm->bindParam(4, $sobre->getImagem());
			$stm->bindParam(5, $sobre->getLayout());
			
			//execução do statement
			$stm->execute();
			
			//verificando o número de linhas
			if($stm->rowCount() != 0){
				echo('Layout inserido com sucesso!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca no banco todos os dados na tabela de layout
		public function SelectAllLayout2(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que busca os dados no banco
			$sql = 'SELECT * FROM sobre WHERE tipoLayout = 2';
			
			//armazenando o retorno em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//variável de contagem
			$cont = 0;
			
			//percorrendo os dados
			while($rsSobre = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo layout
				$listSobre[] = new Sobre();
				
				//adicionando os dados no layout
				$listSobre[$cont]->setId($rsSobre->idSobre);
				$listSobre[$cont]->setTitulo($rsSobre->titulo);
				$listSobre[$cont]->setDescricao($rsSobre->descricao);
				$listSobre[$cont]->setDescricao2($rsSobre->descricao2);
				$listSobre[$cont]->setImagem($rsSobre->imagem);
				$listSobre[$cont]->setStatus($rsSobre->status);
				$listSobre[$cont]->setLayout($rsSobre->tipoLayout);
				
				$cont++;
			}
			
			if($cont != 0){
				return $listSobre;
			}
			
			$conexao->fecharConexao();
		}
		
		//query que atualiza o layout2
		public function UpdateLayout2(Sobre $sobre){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que atualiza os dados no banco
			$stm = $PDO_conexao->prepare('UPDATE sobre SET titulo = ?, descricao = ?, descricao2 = ?, imagem = ? WHERE idSobre = ?');
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getDescricao2());
			$stm->bindParam(4, $sobre->getImagem());
			$stm->bindParam(5, $sobre->getId());
			
			//executando o statement
			if($stm->execute()){
				echo('Layout atualizado com sucesso!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
			
		}
		
		//função que retorna o total de conteúdos cadastrados
		public function checkLayout($layout){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT idSobre FROM sobre WHERE tipoLayout = ?');
			
			//parâmetros enviados
			$stm->bindValue(1, $layout, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//armazenando o total de linhas em uma variável
			$linhas = $stm->rowCount();
			
			//retornando as linhas
			return $linhas;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>