<?php
	class controllerAvaliacao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/avaliacaoClass.php');
			require_once($diretorio.'model/dao/avaliacaoDAO.php');
		}
		
		public function listarCor(){
			$avaliacaoDAO = new avaliacaoDAO();
			$listCor = $avaliacaoDAO->selectCor();
			
			return $listCor;
		}
		
		public function listarMarca(){
			$avaliacaoDAO = new avaliacaoDAO();
			
			$listMarca = $avaliacaoDAO->selectMarca();
			
			return $listMarca;
		}
	}
?>