<?php
	class controllerCor{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'/model/corClass.php');
			require_once($diretorio.'/model/dao/corDAO.php');
		}
		
		public function inserirCor(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
			}
			
			$corClass = new Cor();
			$corClass->setNome($nome);
			$corClass->setCor($cor);
			
			$corDAO = new CorDAO();
			$corDAO->Insert($corClass);
		}
		
		public function atualizarCor(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
				$id = $_POST['id'];
			}
			
			$corClass = new Cor();
			$corClass->setId($id);
			$corClass->setNome($nome);
			$corClass->setCor($cor);
			
			$corDAO = new CorDAO();
			$corDAO->Update($corClass);
		}
		
		public function listarCor(){
			$corDAO = new CorDAO();
			$listCor = $corDAO->selectAll();
			
			return $listCor;
		}
		
		public function buscarCor($id){
			$corDAO = new CorDAO();
			
			$listCor = $corDAO->SelectByID($id);
			
			return $listCor;
		}
		
		public function excluirCor($id){
			$corDAO = new CorDAO();
			
			$corDAO->Delete($id);
		}
	}
?>