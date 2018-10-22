<?php
    /*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: CRUD da página de enquetes

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
        Objetivo: Implementao a função que trás a quantidade de respostas de cada enquete

    */ 

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 22/10/2018
        Objetivo: Implementao a função que limita a exclusão da enquete se houver apenas uma

    */ 

    class EnqueteDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        //função para inserir dados no banco
        public function Insert(Enquete $enquete){
			//instancia da classe de conexão com o banco de dados
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que insere os dados no banco	
			$stm = $PDO_conexao->prepare("INSERT INTO enquete(pergunta, alternativaA, alternativaB, alternativaC, alternativaD, dataInicial, dataFinal, idTema) VALUES(?,?,?,?,?,?,?,?)");
			
			//parâmetros que serão inseridos no banco
			$stm->bindParam(1, $enquete->getPergunta());
			$stm->bindParam(2, $enquete->getAlternativaA());
			$stm->bindParam(3, $enquete->getAlternativaB());
			$stm->bindParam(4, $enquete->getAlternativaC());
			$stm->bindParam(5, $enquete->getAlternativaD());
			$stm->bindParam(6, $enquete->getDtInicio());
			$stm->bindParam(7, $enquete->getDtTermino());
			$stm->bindParam(8, $enquete->getIdTema());
            
            //executando o statement
			$stm->execute();

            //fechando a conexãp
            $conexao->fecharConexao();
        }

        //função para atualizar os dados no banco
        public function Update(Enquete $enquete){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que atualiza os dados
			$stm = $PDO_conexao->prepare("UPDATE enquete set pergunta = ?, alternativaA = ?, alternativaB = ?, alternativaC = ?, alternativaD = ?, 
			dataInicial = ?, dataFinal = ?, idTema = ? WHERE idEnquete = ?");
			
			$stm->bindParam(1, $enquete->getPergunta());
			$stm->bindParam(2, $enquete->getAlternativaA());
			$stm->bindParam(3, $enquete->getAlternativaB());
			$stm->bindParam(4, $enquete->getAlternativaC());
			$stm->bindParam(5, $enquete->getAlternativaD());
			$stm->bindParam(6, $enquete->getDtInicio());
			$stm->bindParam(7, $enquete->getDtTermino());
			$stm->bindParam(8, $enquete->getIdTema());
			$stm->bindParam(9, $enquete->getId());

            //executando  o statement
			$stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para pegar os dados no banco
        public function selectAll(){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET LATIN1');
			
            //query que realiza a consulta
            $sql = "SELECT enquete.*, t.tema FROM enquete LEFT JOIN temaenquete AS t ON enquete.idTema = t.idTema";

            //armazenando o retorno dos dados em uma variável
            $resultado = $PDO_conexao->query($sql);

            //variável de contagem
            $cont = 0;

            //percorrendo os dados
            while($rsEnquetes = $resultado->fetch(PDO::FETCH_OBJ)){
                $listEnquetes[] = new Enquete();
                $listEnquetes[$cont]->setId($rsEnquetes->idEnquete);
                $listEnquetes[$cont]->setPergunta($rsEnquetes->pergunta);
                $listEnquetes[$cont]->setAlternativaA($rsEnquetes->alternativaA);
                $listEnquetes[$cont]->setAlternativaB($rsEnquetes->alternativaB);
                $listEnquetes[$cont]->setAlternativaC($rsEnquetes->alternativaC);
                $listEnquetes[$cont]->setAlternativaD($rsEnquetes->alternativaD);
                $listEnquetes[$cont]->setTema($rsEnquetes->tema);
                $listEnquetes[$cont]->setDtInicio($rsEnquetes->dataInicial);
                $listEnquetes[$cont]->setDtTermino($rsEnquetes->dataFinal);
                $listEnquetes[$cont]->setStatus($rsEnquetes->status);
                $cont++;
            }

            if($cont != 0){
                return $listEnquetes;
            }else{
                require_once('../erro_tabela.php');
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }
		
		//função que consulta o banco de dados em busca da quantidade de respostas de cada enquete
		public function qtdRespostas($id){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT qtdAlternativaA, qtdAlternativaB, qtdAlternativaC, qtdAlternativaD FROM enquete WHERE idEnquete = ?');
			
			//parâmetro que será enviado
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			//armazenando o retorno dos dados em uma variável
			$resultado = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($resultado);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

        //função para pegar os temas do banco
        public function selectTemas(){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que realiza a consulta
            $sql = 'SELECT * FROM temaenquete';

            //armazenando o retorno dos dados em uma variável
            $resultado = $PDO_conexao->query($sql);
            
            //variável de contagem
            $cont = 0;

            //percorrendo os dados
            while($rsTemas = $resultado->fetch(PDO::FETCH_OBJ)){
                $listTemas[] = new Enquete();
                $listTemas[$cont]->setIdTema($rsTemas->idTema);
                $listTemas[$cont]->setTema($rsTemas->tema);
                $cont++;
            }

            //retorno dos dados
            return $listTemas;

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para pegar os dados do banco através do ID
        public function selectByID($id){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que realiza a consulta através do ID
            $stm = $PDO_conexao->prepare('SELECT * FROM enquete WHERE idEnquete = ?');
			
			//parâmetro que será enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//executando o statement
			$stm->execute();

			//criando uma nova enquete
			$listEnquetes = new Enquete();
			
			//armazenando os dados da enquete
			$listEnquetes = $stm->fetch(PDO::FETCH_OBJ);

            //retornando os dados em JSON
            return json_encode($listEnquetes);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para deletar dados do banco
        public function Delete($id){
			//instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
            //query que exclui os dados do banco
            $stm = $PDO_conexao->prepare('DELETE FROM enquete WHERE idEnquete = ?');
			
			//parâmetro que será enviado
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que atualiza o status da enquete no banco de dados
        public function activateOne($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
			
			//query que atualiza o status
			$stm = $PDO_conexao->prepare("UPDATE enquete SET status = 1 WHERE idEnquete = ?");
			
			//parâmetro que será enviado
			$stm->bindParam(1, $id);

            //executando o statement
			$stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }
		
		//função que atualiza o status da enquete no banco de dados
        public function disableAll($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco de dados
            $PDO_conexao = $conexao->conectarBanco();
			
			
			//query que atualiza o status
			$stm = $PDO_conexao->prepare("UPDATE enquete SET status = 0 WHERE idEnquete <> ?");
			
			//parâmetro que será enviado
			$stm->bindParam(1, $id);

            //executando o statement
			$stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }
		
		//função que verifica o total de enquetes
		public function checkEnquete(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT idEnquete from enquete');
			
			//execução do statement
			$stm->execute();
			
			//armazenando o número de itens
			$linhas = $stm->rowCount();
			
			//retornando
			return $linhas;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
    }
?>