<?php
    /*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: controlar as ações da página de enquetes

    */

    class controllerEnquete{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
            require_once($diretorio.'/model/enqueteClass.php');
            require_once($diretorio.'/model/dao/enqueteDAO.php');
        }
		
		//função que insere uma enquete
        public function inserirEnquete(){
			//verifica se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
                $pergunta = $_POST['txtpergunta'];
                $tema = $_POST['txttema'];
                $alternativa_a = $_POST['txtalta'];
                $alternativa_b = $_POST['txtaltb'];
                $alternativa_c = $_POST['txtaltc'];
                $alternativa_d = $_POST['txtaltd'];
                $dtInicio = $_POST['dtinicio'];
                $dtTermino = $_POST['dttermino'];

                if($dtInicio > $dtTermino){
                    $dtInicio = null;
                }
            }
			
			//instância da classe enquete
            $enqueteClass = new Enquete();
			
			//setando os atributos
            $enqueteClass->setPergunta($pergunta);
            $enqueteClass->setIdTema($tema);
            $enqueteClass->setAlternativaA($alternativa_a);
            $enqueteClass->setAlternativaB($alternativa_b);
            $enqueteClass->setAlternativaC($alternativa_c);
            $enqueteClass->setAlternativaD($alternativa_d);
            $enqueteClass->setDtInicio($dtInicio);
            $enqueteClass->setDtTermino($dtTermino);
			
			//instância da classe enqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
			//chamada da função que insere uma nova enquete
            $enqueteDAO->Insert($enqueteClass);
        }
		
		//função que atualiza uma enquete
        public function atualizarEnquete($id){
			//verifica se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores da caixas de texto
                $pergunta = $_POST['txtpergunta'];
                $tema = $_POST['txttema'];
                $alternativa_a = $_POST['txtalta'];
                $alternativa_b = $_POST['txtaltb'];
                $alternativa_c = $_POST['txtaltc'];
                $alternativa_d = $_POST['txtaltd'];
                $dtInicio = $_POST['dtinicio'];
                $dtTermino = $_POST['dttermino'];
            }
			
			//instância da classe enquete
            $enqueteClass = new Enquete();

			//setando os atributos
            $enqueteClass->setId($id);
            $enqueteClass->setPergunta($pergunta);
            $enqueteClass->setIdTema($tema);
            $enqueteClass->setAlternativaA($alternativa_a);
            $enqueteClass->setAlternativaB($alternativa_b);
            $enqueteClass->setAlternativaC($alternativa_c);
            $enqueteClass->setAlternativaD($alternativa_d);
            $enqueteClass->setDtInicio($dtInicio);
            $enqueteClass->setDtTermino($dtTermino);
			
			//instância da classe EnqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
			//chamada da função que atualiza a enquete
            $enqueteDAO->Update($enqueteClass);
        }

		//função que lista os temas
        public function listarTemas(){
			//instância da classe enqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listTemas = $enqueteDAO->selectTemas();
			
			//retornando os dados
            return $listTemas;
        }
		
		//função que lista as enquete
        public function listarEnquetes(){
			//instância da classe enqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
			//armazenando o retorno dos dados em uma variável
            $listEnquetes = $enqueteDAO->selectAll();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($cont < count($listEnquetes)){
				//convertendo a data para o padrão brasileiro
				$data = date('d/m/Y', strtotime($listEnquetes[$cont]->getDtTermino()));
				
				//setando a data
				$listEnquetes[$cont]->setDtTermino($data);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
            return $listEnquetes;
        }

		//função que busca uma enquete através do ID
        public function buscarEnquete($id){
			//instância da classe enqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
			//armazenando o retorno dos dados em uma variável
            $resultado = $enqueteDAO->selectByID($id);
			
			//retornando os dados
            return $resultado;
        }
		
		//função que busca os resultados de uma enquete
		public function buscarResultado($id){
			//instância da classe enqueteDAO
			$enqueteDAO = new EnqueteDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listEnquetes = $enqueteDAO->qtdRespostas($id);
			
			//retornando os dados
			return $listEnquetes;
		}
		
		//função que exclui uma enquete
        public function excluirEnquete($id){
			//instância da classe enqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
			//chamada da função que deleta uma enquete
            $enqueteDAO->Delete($id);
        }

        public function atualizarStatus($id, $status){
            $enqueteDAO = new EnqueteDAO();
            $enqueteDAO->updateStatus($id, $status);
        }

    }
?>