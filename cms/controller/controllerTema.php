<?php
	class controllerTema{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/temaClass.php');
			require_once($diretorio.'model/dao/temaDAO.php');
		}
		
		public function inserirTema(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
				$genero = $_POST['txtgenero'];
			}
			
			$temaClass = new Tema();
			
			$temaClass->setNome($nome);
			$temaClass->setCor($cor);
			$temaClass->setGenero($genero);
			
			$temaDAO = new TemaDAO();
			$temaDAO->Insert($temaClass);
		}
	}
?>