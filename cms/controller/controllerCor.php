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
	}
?>