<?php
	class controllerTema{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/temaClass.php');
			require_once($diretorio.'model/dao/temaDAO.php');
		}
		
		public function listarTemas($genero){
			$temaDAO = new TemaDAO();
			$listTemas = $temaDAO->selectTema($genero);
			
			return $listTemas;
		}
	}
?>