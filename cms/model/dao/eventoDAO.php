<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: CRUD de eventos
	*/

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 22/10/2018
        Objetivo: Implementao a função que limita a exclusão de evento se houver apenas um

	*/
	
	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 04/11/2018
        Objetivo: Implementao a função que traduz um evento
	*/
	
	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 08/11/2018
        Objetivo: Implementao a função que pesquisa os eventos
    */

	class EventoDAO{
		public function __construct(){
			require_once("bdClass.php");
		}
		
		//função que busca as lojas do banco
		public function selectLojas(){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//corrigindo acentuação
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM nossaloja';
			
			//armazenando os resultados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsLojas = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando uma loja
				$listLojas[] = new Evento();
				
				//setando os atributos
				$listLojas[$cont]->setIdLoja($rsLojas->idLoja);
				$listLojas[$cont]->setLoja($rsLojas->nomeLoja);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listLojas;
		}
		
		//função que insere um evento
		public function Insert(Evento $evento){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere um evento
			$stm = $PDO_conexao->prepare('INSERT INTO evento(nomeEvento, descricaoEvento, imagemEvento) VALUES(?,?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $evento->getNome());
			$stm->bindParam(2, $evento->getDescricao());
			$stm->bindParam(3, $evento->getImagem());
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() != 0){
				//armazenando o id do evento inserido
				$idEvento = $PDO_conexao->lastInsertId();
				
				$status = array('id' => $idEvento, 'status' => 'inserido');

				return json_encode($status);
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que relaciona um evento a uma loja
		public function InsertEventoLoja($idEvento, Evento $evento){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO evento_nossaloja(idEvento, idLoja, dataInicio, dataFim) VALUES(?, ?, ?, ?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $idEvento);
			$stm->bindParam(2, $evento->getIdLoja());
			$stm->bindParam(3, $evento->getDtInicio());
			$stm->bindParam(4, $evento->getDtTermino());
			
			//execução do statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para traduzir um evento
		public function insertTranslate(Evento $evento, $idEvento, $idioma){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO evento_traducao(nomeEvento, descricaoEvento, idEvento, codigo_idioma) VALUES(?,?,?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $evento->getNome());
			$stm->bindParam(2, $evento->getDescricao());
			$stm->bindParam(3, $idEvento);
			$stm->bindParam(4, $idioma);

			//execução do statement
			$stm->execute();

			//verificando status
			if($stm->rowCount() != 0){
				//armazenando a mensagem em uma variável
				$status = array('status' => 'traduzido');
			}else{
                $status = array('status' => 'erro');    
            }
            
            //retornando a msg em JSON
            return json_encode($status);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca todos os eventos cadastrados
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT e.*, en.* FROM evento as e INNER JOIN evento_nossaloja as en ON en.idEvento = e.idEvento';
			
			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsEventos = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo evento
				$listEvento[] = new Evento();
				
				//setando os atributos
				$listEvento[$cont]->setId($rsEventos->idEvento);
				$listEvento[$cont]->setNome($rsEventos->nomeEvento);
				$listEvento[$cont]->setDescricao($rsEventos->descricaoEvento);
				$listEvento[$cont]->setImagem($rsEventos->imagemEvento);
				$listEvento[$cont]->setDtTermino($rsEventos->dataFim);
				$listEvento[$cont]->setStatus($rsEventos->status);
				
				//incrementando o contador
				$cont++;
			}
			
			if($cont != 0){
				return $listEvento;
			}
			
            //fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca um evento através do ID
		public function SelectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT e.*, en.* FROM evento as e INNER JOIN evento_nossaloja as en ON en.idEvento = e.idEvento WHERE e.idEvento = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//criando um novo evento
			$listEvento = new Evento();
			
			//armazenando os dados em uma variável
			$listEvento = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listEvento);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que seleciona um evento traduzido
		public function selectTranslate($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM evento_traducao WHERE idEvento = ?');

			//parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);

			//execução do statement
			$stm->execute();

			//armazenando os dados em uma variável
			$listEvento = $stm->fetch(PDO::FETCH_OBJ);

			//retornando os dados em JSON
			return json_encode($listEvento);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza um evento
		public function Update($evento){
			//instância da classe de conexão
			$conexao = new ConexaoMySQL();
			
			//chamada da função que atualiza os dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE evento SET nomeEvento = ?, imagemEvento = ?, descricaoEvento = ? WHERE idEvento = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $evento->getNome());
			$stm->bindParam(2, $evento->getImagem());
			$stm->bindParam(3, $evento->getDescricao());
			$stm->bindParam(4, $evento->getId());
			
			if($stm->execute()){
				$status = array('status' => 'atualizado');
			}else{
                $status = array('status' => 'erro');
            }
            
            //retornando a msg em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza a data
		public function UpdateData($evento){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE evento_nossaloja SET dataInicio = ?, dataFim = ? WHERE idEvento = ? and idLoja = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $evento->getDtInicio());
			$stm->bindParam(2, $evento->getDtTermino());
			$stm->bindParam(3, $evento->getId());
			$stm->bindParam(4, $evento->getIdLoja());
			
			if(!$stm->execute()){
				return 'erro';
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para atualizar a tradução
		public function updateTranslate(Evento $evento){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE evento_traducao SET nomeEvento = ?, descricaoEvento = ? WHERE idEvento = ?');

			//parâmetros enviados
			$stm->bindParam(1, $evento->getNome());
			$stm->bindParam(2, $evento->getDescricao());
			$stm->bindParam(3, $evento->getId());

			//verificando se deu certo
			if($stm->execute()){
				$status = array('status' => 'atualizado');
			}else{
                $status = array('status' => 'erro');
            }
            
            //retornando a msg em JSON
            return json_encode($status);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que deleta um evento
		public function Delete($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que exclui os dados
			$stm = $PDO_conexao->prepare('DELETE e, en FROM evento as e INNER JOIN evento_nossaloja AS en ON e.idEvento = en.idEvento WHERE e.idEvento = ?');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//verificando o status das linhas
			if($stm->rowCount() == 0){
				$status = array('status' => 'erro');
                
                //retornando a mensagem em JSON
                return json_encode($status);
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza o status
		public function updateStatus($id, $status){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//verifica o status
			if($status == 1){
				//se for 1, seta o status = 0
				$stm = $PDO_conexao->prepare('UPDATE evento SET status = 0 WHERE idEvento = ?');
			}else{
				//se for 0, seta o status = 1
				$stm = $PDO_conexao->prepare('UPDATE evento SET status = 1 WHERE idEvento = ?');
			}
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que verifica a quantidade de eventos no banco
		public function checkEvento(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT idEvento FROM evento');
			
			//execução do statement
			$stm->execute();
			
			//armazenando o número de linhas
			$linhas = $stm->rowCount();
			
			//retornando
			return $linhas;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar por um evento
		public function searchEvento($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare("SELECT * FROM evento WHERE concat_ws(',', nomeEvento, descricaoEvento) LIKE ?");

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsEventos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo Evento
				$listEvento[] = new Evento;

				//setando os atributos
				$listEvento[$cont]->setNome($rsEventos->nomeEvento);
				$listEvento[$cont]->setDescricao($rsEventos->descricaoEvento);
				$listEvento[$cont]->setStatus($rsEventos->status);

				//incrementando o contador
				$cont++;
			}

			//retornando os dados
			return $listEvento;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>