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

        public function inserirEnquete(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
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

            $enqueteClass = new Enquete();

            $enqueteClass->setPergunta($pergunta);
            $enqueteClass->setIdTema($tema);
            $enqueteClass->setAlternativaA($alternativa_a);
            $enqueteClass->setAlternativaB($alternativa_b);
            $enqueteClass->setAlternativaC($alternativa_c);
            $enqueteClass->setAlternativaD($alternativa_d);
            $enqueteClass->setDtInicio($dtInicio);
            $enqueteClass->setDtTermino($dtTermino);

            $enqueteDAO = new EnqueteDAO();
            $enqueteDAO->Insert($enqueteClass);
        }

        public function atualizarEnquete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $pergunta = $_POST['txtpergunta'];
                $tema = $_POST['txttema'];
                $alternativa_a = $_POST['txtalta'];
                $alternativa_b = $_POST['txtaltb'];
                $alternativa_c = $_POST['txtaltc'];
                $alternativa_d = $_POST['txtaltd'];
                $dtInicio = $_POST['dtinicio'];
                $dtTermino = $_POST['dttermino'];
            }

            $enqueteClass = new Enquete();

            $enqueteClass->setId($id);
            $enqueteClass->setPergunta($pergunta);
            $enqueteClass->setIdTema($tema);
            $enqueteClass->setAlternativaA($alternativa_a);
            $enqueteClass->setAlternativaB($alternativa_b);
            $enqueteClass->setAlternativaC($alternativa_c);
            $enqueteClass->setAlternativaD($alternativa_d);
            $enqueteClass->setDtInicio($dtInicio);
            $enqueteClass->setDtTermino($dtTermino);

            $enqueteDAO = new EnqueteDAO();
            $enqueteDAO->Update($enqueteClass);
        }


        public function listarTemas(){
            $enqueteDAO = new EnqueteDAO();
            $listTemas = $enqueteDAO->selectTemas();

            return $listTemas;
        }

        public function listarEnquetes(){
            $enqueteDAO = new EnqueteDAO();
            $listEnquetes = $enqueteDAO->selectAll();
			
			$cont = 0;
			while($cont < count($listEnquetes)){
				$data = date('d/m/Y', strtotime($listEnquetes[$cont]->getDtTermino()));
				$listEnquetes[$cont]->setDtTermino($data);
				$cont++;
			}
			
            return $listEnquetes;
        }

        public function buscarEnquete($id){
            $enqueteDAO = new EnqueteDAO();
            $resultado = $enqueteDAO->selectByID($id);

            return $resultado;
        }
		
		public function buscarResultado($id){
			$enqueteDAO = new EnqueteDAO();
			$listEnquetes = $enqueteDAO->qtdRespostas($id);
			
			return $listEnquetes;
		}
		
        public function excluirEnquete($id){
            $enqueteDAO = new EnqueteDAO();
            $enqueteDAO->Delete($id);
        }

        public function atualizarStatus($id, $status){
            $enqueteDAO = new EnqueteDAO();
            $enqueteDAO->updateStatus($id, $status);
        }

    }
?>