<?php
    /*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: CRUD da página de usuários

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
		Data: 28/09/2018
		Objetivo: Implementado sistema de logout
    */
    
    /*
		Projeto: CMS do Brechó - Atualização
		Autor: Lucas Eduardo
		Data: 06/11/2018
		Objetivo: Implementado pesquisa de usuários
	*/

    class UsuarioDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        

        //inserir um usuário no banco
        public function Insert(Usuario $usuario){
            //instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
			
			//chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
			
			//criando um statement e preparando a query que irá inserir os dados no banco
            $stm = $PDO_conexao->prepare("INSERT INTO usuariocms(imagem, nomeUsuario, login, idNivel, senha) 
            VALUES(?, ?, ?, ?, ?)");
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $usuario->getImagem());
			$stm->bindParam(2, $usuario->getNome());
			$stm->bindParam(3, $usuario->getUsuario());
			$stm->bindParam(4, $usuario->getNivel());
			$stm->bindParam(5, $usuario->getSenha());
			
			//executando o statement em caso de sucesso
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo 'Usuário inserido com sucesso';
			}else{
				echo 'Ocoreu um erro ao inserir o usuário';
			}
			
            //fechando a conexão
            $conexao->fecharConexao();
        }

        public function Update(Usuario $usuario){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamda da função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para atualizar no banco de dados
            $stm = $PDO_conexao->prepare("UPDATE usuarioCms set imagem = ?, nomeUsuario = ?, login = ?, idNivel = ?, senha = ? WHERE idUsuario = ?");
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $usuario->getImagem());
			$stm->bindParam(2, $usuario->getNome());
			$stm->bindParam(3, $usuario->getUsuario());
			$stm->bindParam(4, $usuario->getNivel());
			$stm->bindParam(5, $usuario->getSenha());
			$stm->bindParam(6, $usuario->getId());
			
			if($stm->execute()){
				echo('Dados atualizados com sucesso!!');
			}else{
				echo('Ocorreu um erro ao atualizar os dados!!');
			}

            //fechando a conexão
            $conexao->fecharConexao();
        }

        public function selectAll(){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para pegar dados do banco
            $sql = "SELECT usuariocms.*, n.nomeNivel FROM usuariocms LEFT JOIN nivelUsuario as n on usuariocms.idNivel = n.idNivel ORDER BY idUsuario";

            
			//armazenando o retorno da query em uma variável
			$resultado = $PDO_conexao->query($sql);

			//variavel de contagem
            $cont = 0;
			
			//laço while para percorrer os dados
			while($rsUsuarios = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo usuário e armazenando os dados nele
				$listUsuarios[] = new Usuario();
				$listUsuarios[$cont]->setId($rsUsuarios->idUsuario);
				$listUsuarios[$cont]->setNome($rsUsuarios->nomeUsuario);
				$listUsuarios[$cont]->setUsuario($rsUsuarios->login);
				$listUsuarios[$cont]->setNivel($rsUsuarios->idNivel);
				$listUsuarios[$cont]->setNomeNivel($rsUsuarios->nomeNivel);
				$listUsuarios[$cont]->setStatus($rsUsuarios->status);
				$cont++;
			}
				
			if($cont != 0){
				return $listUsuarios;
			}else{
				require_once('../erro_tabela.php');
			}
            
            //fechando a conexão com o banco
            $conexao->fecharConexao();
        }

        //função para pegar os dados da tabela de niveis
        public function selectNivel(){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamda da função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para pegar os dados
            $sql = "SELECT * FROM nivelUsuario";

            //armazenando o retorno da query em uma variável
            $resultado = $PDO_conexao->query($sql);

            //variável de contagem
            $cont = 0;

            //percorrendo a os dados
            while($rsNiveis = $resultado->fetch(PDO::FETCH_OBJ)){
                $listNiveis[] = new Usuario();
                $listNiveis[$cont]->setNivel($rsNiveis->idNivel);
                $listNiveis[$cont]->setNomeNivel($rsNiveis->nomeNivel);
                $cont++;
            }

            //retornando os dados encontrados
            return $listNiveis;

            //fechando a conexão com o banco
            $conexao->fecharConexao();
        }

        //função para excluir dados do banco
        public function excluir($id){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para exclusão de dados do banco
            $stm = $PDO_conexao->prepare("DELETE FROM usuarioCms WHERE idUsuario = ?");
			
			//parâmetros que serão enviados
			$stm->bindParam(1, $id);

            //enviando a solicitação para o banco
            $stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para pegar um usuário através de seu ID
        public function selectByID($id){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //query para pegar os dados do banco
            $stm = $PDO_conexao->prepare("SELECT * FROM usuarioCms WHERE idUsuario = ?");
            
			//parâmetros que serão enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
            //executando  o statement
            $stm->execute();

            //criando um novo usuario
			$listUsuarios = new Usuario();
			
			//armazenando os dados retornados no usuário
			$listUsuarios = $stm->fetch(PDO::FETCH_OBJ);

            //retornando os dados encontrados no formato JSON
            return json_encode($listUsuarios);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para realizar o login
        public function logar($usuario, $senha){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //faz uma busca no banco de acordo com os parâmetros passados
            $stm = $PDO_conexao->prepare("SELECT login, imagem, idNivel FROM usuarioCms WHERE login = ? and senha = ?");
			
			//parâmetros que serão enviados
			$stm->bindValue(1, $usuario, PDO::PARAM_STR);
			$stm->bindValue(2, $senha, PDO::PARAM_STR);
            
			//execução do statement
			$stm->execute();
			
			if($rsUsuarios = $stm->fetch(PDO::FETCH_OBJ)){
				//verificando se foram encontrados os dados, se sim, armazena em uma sessão, se não retorna 0 (falso)
					echo 1;
					session_start();
					$_SESSION['usuario_cms'] = $rsUsuarios->login;
					$_SESSION['imagem'] = $rsUsuarios->imagem;
					$_SESSION['nivel'] = $rsUsuarios->idNivel;
				}else{
					echo 0;
				}

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para atualizar o status no banco de dados
        public function updateStatus($id, $status){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
			//verifica qual o status atual
            if($status == 1){
                //se for 1, atualiza o status no banco para 0
                $stm = $PDO_conexao->prepare("UPDATE usuarioCms set status = 0 WHERE idUsuario = ?");
            }else{
                //se for 0, atualiza o status no banco para 1
                $stm = $PDO_conexao->prepare("UPDATE usuarioCms set status = 1 WHERE idUsuario = ?");
            }
			
			//parâmetro que será enviado
			$stm->bindParam(1, $id);

            //executando o statement
            $stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }		
		
		//função para verificar a quantidade de usuários ativos
		public function checkUsuarios(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT idUsuario from usuarioCms';
			
			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//guardando o número de usuários cadastrados
			$linhas = $resultado->rowCount();
			
			//retornando
			return $linhas;
			
			//fechando a conexão
			$conexao->fecharConexao();
        }
        
        //função que que pesquisa o usuário no banco
        public function searchUser($pesquisa){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare("SELECT usuariocms.*, n.nomeNivel FROM usuariocms LEFT JOIN nivelUsuario as n on usuariocms.idNivel = n.idNivel WHERE concat_ws(',', nomeUsuario, login) like ? ORDER BY idUsuario");

            //parâmetros enviados
            $stm->bindParam(1, $pesquisa);

            //execução do statement
            $stm->execute();

            //contador
            $cont = 0;

            //percorrendo os dados
            while($rsUsuarios = $stm->fetch(PDO::FETCH_OBJ)){
                //criando um novo usuário
                $listUsuarios[] = new Usuario();

                //setando os atributos
                $listUsuarios[$cont]->setId($rsUsuarios->idUsuario);
				$listUsuarios[$cont]->setNome($rsUsuarios->nomeUsuario);
				$listUsuarios[$cont]->setUsuario($rsUsuarios->login);
				$listUsuarios[$cont]->setNivel($rsUsuarios->idNivel);
				$listUsuarios[$cont]->setNomeNivel($rsUsuarios->nomeNivel);
                $listUsuarios[$cont]->setStatus($rsUsuarios->status);
                
                //incrementando o contador
                $cont++;
            }

            //verifica se há algum resultado
            if($cont != 0){
                //retorna os usuários
                return $listUsuarios;
            }else{
                //mensagem de erro
                echo('nenhum usuário encontrado');
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>