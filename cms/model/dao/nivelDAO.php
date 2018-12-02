<?php
    /*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: CRUD da página de níveis

    */ 

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 27/09/2018
        Objetivo: Atualizando o CRUD, mudando a forma como são inseridos e resgatados os parâmetros

    */

	/*
		Projeto: CMS do Brechó - Atualização
		Autor: Lucas Eduardo
		Data: 01/10/2018
		Objetivo: Implementado sistema de permissões
	*/

	/*
		Projeto: CMS do Brechó - Atualização
		Autor: Lucas Eduardo
		Data: 06/11/2018
		Objetivo: Implementado pesquisa de níveis
	*/
    
    Class NivelDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        //função para fazer inserção no banco de dados
        public function Insert(Nivel $nivel){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função de conectar com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que insere os dados no banco
           	$stm = $PDO_conexao->prepare("INSERT INTO nivelusuario(nomeNivel) VALUES(?)");
			
			//parâmetros que serão inseridos
			$stm->bindParam(1, $nivel->getNome());
		
			//execução do statement
			$stm->execute();

			//verificando o retorno
			if($stm->rowCount() != 0){
				//atualizando o status para sucesso
				$status = array('status' => 'sucesso');
			}else{
				//atualizando status para erro
				$status = array('status' => 'erro');
			}
			
			//retornando os dados em JSON
			return json_encode($status);
			
            //fechando a conexão
            $conexao->fecharConexao();
        }
		
        //função para trazer os dados do banco
        public function selectAll(){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função para conectar com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que realiza a consulta
            $sql = "SELECT * FROM nivelusuario";

            //armazenando o retorno dos dados em uma variável
            $resultado = $PDO_conexao->query($sql);

            //variável de contagem
            $cont = 0;

            //percorrendo os dados
            while($rsNiveis = $resultado->fetch(PDO::FETCH_OBJ)){
                //criando um novo nivel e armazenando seus atributos
                $listNiveis[] = new Nivel();
                $listNiveis[$cont]->setId($rsNiveis->idNivel);
                $listNiveis[$cont]->setNome($rsNiveis->nomeNivel);
                $listNiveis[$cont]->setStatus($rsNiveis->status);
                $cont++;
            }
            
            if($cont != 0){
				//retornando os dados
                return $listNiveis;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
		
		public function selectPaginas(){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			$sql = 'SELECT * FROM tela';
			
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			while($rsPaginas = $resultado->fetch(PDO::FETCH_OBJ)){
				$listPaginas[] = new Pagina();
				$listPaginas[$cont]->setId($rsPaginas->idTela);
				$listPaginas[$cont]->setPagina($rsPaginas->nomeTela);
				$cont++;
			}
			
			return $listPaginas;
			
			$conexao->fecharConexao();
		}
        
        //função para deletar dados do banco
        public function Delete($id){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para deletar o nível do banco
            $stm = $PDO_conexao->prepare("DELETE FROM nivelusuario WHERE idNivel = ?");
			
			$stm->bindParam(1, $id);
			
            //verificando o retorno da requisição, se for positiva retorna 1, caso contrário, retorna 0
            if($stm->execute()){
                echo 1;
            }else{
                echo 0;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para pegar dados do banco através do ID
        public function SelectByID($id){
			//instancia da classe de conexao com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para fazer consulta no banco através do ID
            $stm = $PDO_conexao->prepare("SELECT * FROM nivelusuario WHERE idNivel = ?");
			
			//parâmetro que será enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//executando o statement
            $stm->execute();
			
			//criando um novo nível
            $listNiveis = new Nivel();
			
			//armazenando os dados retornados na variável
			$listNiveis = $stm->fetch(PDO::FETCH_OBJ);

            //retornando os dados em JSON
            return json_encode($listNiveis);

            //fechando conexão com o banco
            $conexao->fecharConexao();
        }
		

        //função para atualizar os dados do banco
        public function Update(Nivel $nivel){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para atualizar os dados do banco
            $stm = $PDO_conexao->prepare("UPDATE nivelusuario set nomeNivel = ? WHERE idNivel = ?");
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $nivel->getNome());
			$stm->bindParam(2, $nivel->getId());
			
			//verificando o retorno
			if($stm->execute()){
				//atualizando o status para sucesso
				$status = array('status' => 'atualizado');
			}else{
				//atualizando status para erro
				$status = array('status' => 'erro');
			}
			
			//retornando os dados em JSON
			return json_encode($status);
			
			//fechando a conexão
            $conexao->fecharConexao();
        }

        //função para atualizar o status no banco de dados
        public function updateStatus($id, $status){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
			//verificando qual é o status atual
            if($status == 1){
                //se for 1, atualiza o status para 0
                $stm = $PDO_conexao->prepare("UPDATE nivelusuario SET status = 0 WHERE idNivel = ?");
            }else{
                //se for 0, atualiza o status para 1
                $stm = $PDO_conexao->prepare("UPDATE nivelusuario SET status = 1 WHERE idNivel = ?");
            }
			
			//parâmetro que será enviado para o banco
			$stm->bindParam(1, $id);
			
			//executando o statement
            $stm->execute();

            //fechando conexão com o banco
            $conexao->fecharConexao();
        }
		
		public function permitirPagina($idNivel, $idPagina){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query para inserir, onde só irá inserir se não existir nenhum registro igual
			$stm = $PDO_conexao->prepare('INSERT INTO nivel_tela(idNivel, idTela) SELECT ?, ? from dual WHERE NOT EXISTS(SELECT * FROM nivel_tela WHERE idNivel = ? and idTela = ?);');
			
			//parâmetros enviados
			$stm->bindParam(1, $idNivel);
			$stm->bindParam(2, $idPagina);
			$stm->bindParam(3, $idNivel);
			$stm->bindParam(4, $idPagina);
			
			//executando o statement
			$stm->execute();
			
			//verificando o retorno
			if($stm->rowCount() == 1){
				//atualizando o status para sucesso
				$status = array('status' => 'sucesso');
			}else if($stm->rowCount() == 0){
				//atualizando status para erro
				$status = array('status' => 'permitido');
			}else{
				//atualizando status para erro
				$status = array('status' => 'erro');
			}
			
			//retornando os dados em JSON
			return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function retirarPermissao($idNivel, $idPagina){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query para deletar os dados do banco
			$stm = $PDO_conexao->prepare('DELETE FROM nivel_tela WHERE idNivel = ? and idTela = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $idNivel);
			$stm->bindParam(2, $idPagina);
			
			//executando o statement
			$stm->execute();
			
			//verificando o retorno
			if($stm->rowCount() != 0){
				//atualizando o status para sucesso
				$status = array('status' => 'sucesso');
			}else{
				//atualizando os status para erro
				$status = array('status' => 'erro');
			}

			//retornando os dados em JSON
			return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function checarPermissao($idNivel, $idPagina){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que traz o id do Nivel e o id da Tela, baseado nos parâmetros informados na clausula WHERE
			$stm = $PDO_conexao->prepare('SELECT n.idNivel, nt.idTela from nivelusuario as n LEFT JOIN nivel_tela as nt ON n.idNivel = nt.idNivel WHERE n.idNivel = ? and idTela = ?');
			
			//parâmetros enviados
			$stm->bindValue(1, $idNivel, PDO::PARAM_INT);
			$stm->bindValue(2, $idPagina, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//se o número de linhas encontrados for menor do que 1, significa que nenhum registro foi encontrado, então redireciona o usuário para a index
			if($stm->rowCount() != 1){
				header('location: ../../index.php');
			}
			
			$conexao->fecharConexao();
		}

		//função para pesquisar um nível
		public function searchNivel($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da classe de conexão com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os níveis
			$stm = $PDO_conexao->prepare('SELECT * from nivelusuario WHERE nomeNivel like ?');

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsNiveis = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo nível
				$listNiveis[] = new Nivel();

				//setando os atributos
				$listNiveis[$cont]->setId($rsNiveis->idNivel);
				$listNiveis[$cont]->setNome($rsNiveis->nomeNivel);
				$listNiveis[$cont]->setStatus($rsNiveis->status);

				//incrementando o contador
				$cont++;
			}

			//verificando se há algum resultado
			if($cont != 0){
				//retornando os dados
				return $listNiveis;
			}else{
				//mensagem se não encontrar nenhum
				echo('nenhum nível encontrado');
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
    }

?>