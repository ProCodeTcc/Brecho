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

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 22/10/2018
        Objetivo: Implementao a função que traduz os layouts 1 e 2

	*/ 

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 07/11/2018
        Objetivo: Implementao a função que pesquisa os layouts 1 e 2
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
				$id = $PDO_conexao->lastInsertId();

				$retorno = array('id' => $id, 'status' => 'inserido');

				return json_encode($retorno);
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere a traduçãdo do layout 1
		public function insertTranslateLayout1(Sobre $sobre, $idSobre, $idioma){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada de conexão com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO sobre_traducao(titulo, descricao, idSobre, codigo_idioma) VALUES(?,?,?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $idSobre);
			$stm->bindParam(4, $idioma);

			//execução do statement
			$stm->execute();

			//verificando retorno
			if($stm->rowCount() != 0){
				//armazenando a mensagem uma variável
				$status = array('status' => 'traduzido');
			}else{
                //atualizando o staus para erro
                $status = array('status' => 'erro');
            }
            
            //retornando em JSON
            return json_encode($status);

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

		//função que busca uma tradução
		public function selectTranslate($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM sobre_traducao WHERE idSobre = ?');

			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);

			//execução do statement
			$stm->execute();

			//armazenando os dados em uma variável
			$listLayout = $stm->fetch(PDO::FETCH_OBJ);

			//retornando os dados em JSON
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
				$status = array('status' => 'atualizado');
			}else{
                $status = array('status' => 'erro');
            }
            
            //retornando em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para traduzir um layout
		public function updateTranslateLayout1(Sobre $sobre){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE sobre_traducao SET titulo = ?, descricao = ? WHERE idSobre = ?');

			//parâmetros enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getId());

			//verificando se deu certo
			if($stm->execute()){
				//armazenando a mensagem em uma variável
				$status = array('status' => 'atualizado');
			}else{
                $status = array('status' => 'erro');
            }
            
            return json_encode($status);

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
			
			if($stm->rowCount() == 0){
				$status = array('status' => 'erro');
			}
            
            return json_encode($status);
			
            //fechando a conexão
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
				$id = $PDO_conexao->lastInsertId();

				$retorno = array('id' => $id, 'status' => 'inserido');

				return json_encode($retorno);
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que insere a tradução do layout2
		public function insertTranslateLayout2(Sobre $sobre, $idSobre, $idioma){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO sobre_traducao(titulo, descricao, descricao2, idSobre, codigo_idioma) VALUES(?,?,?,?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getDescricao2());
			$stm->bindParam(4, $idSobre);
			$stm->bindParam(5, $idioma);

			//execução do statement
			$stm->execute();

			//verificando retorno
			if($stm->rowCount() != 0){
				//armazenando a mensagem uma variável
				$status = array('status' => 'traduzido');
			}else{
                //atualizando o staus para erro
                $status = array('status' => 'erro');
            }
            
            //retornando em JSON
            return json_encode($status);

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
			
			if($stm->execute()){
				$status = array('status' => 'atualizado');
			}else{
                $status = array('status' => 'erro');
            }
			
            return json_encode($status);
            
			//fechando a conexão
			$conexao->fecharConexao();
			
		}

		//função que atualiza a tradução do layout2
		public function updateTranslateLayout2(Sobre $sobre){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE sobre_traducao SET titulo = ?, descricao = ?, descricao2 = ? WHERE idSobre = ?');

			//parâmetros que serão enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getDescricao2());
			$stm->bindParam(4, $sobre->getId());

			if($stm->execute()){
				$status = array('status' => 'atualizado');
			}else{
                $status = array('status' => 'erro');
            }

            return json_encode($status);
            
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

		//função para pesquisar os layouts 1 no banco
		public function searchLayout1($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare("SELECT * FROM sobre WHERE tipoLayout = 1 AND concat_ws(',', titulo, descricao) LIKE ?");

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsSobre = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo objeto
				$listLayout[] = new Sobre();

				//setando os atributos
				$listLayout[$cont]->setId($rsSobre->idSobre);
				$listLayout[$cont]->setImagem($rsSobre->imagem);
				$listLayout[$cont]->setTitulo($rsSobre->titulo);
				$listLayout[$cont]->setDescricao($rsSobre->descricao);
				$listLayout[$cont]->setStatus($rsSobre->status);

				//incrementando o contador
				$cont++;
			}

			//verificando se há resultados
			if($cont != 0){
				//se houver, retorna os dados
				return $listLayout;
			}else{
				//se não, mostra mensagem
				echo('nenhum layout encontrado..');
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar o layout 2
		public function searchLayout2($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare("SELECT * FROM sobre WHERE tipoLayout = 2 AND concat_ws(',', titulo, descricao, descricao2) LIKE ?");

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//incrementando o contador
			$cont = 0;

			//percorrendo os dados
			while($rsSobre = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo objeto
				$listLayout[] = new Sobre();

				//setando os atributos
				$listLayout[$cont]->setId($rsSobre->idSobre);
				$listLayout[$cont]->setImagem($rsSobre->imagem);
				$listLayout[$cont]->setTitulo($rsSobre->titulo);
				$listLayout[$cont]->setDescricao($rsSobre->descricao);
				$listLayout[$cont]->setDescricao2($rsSobre->descricao2);
				$listLayout[$cont]->setStatus($rsSobre->status);

				//incrementando o contador
				$cont++;
			}

			//verificando se há resultados
			if($cont != 0){
				//se houver, retornando os dados
				return $listLayout;
			}else{
				//se não, mostra mensagem
				echo('nenhum layout encontrado..');
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>