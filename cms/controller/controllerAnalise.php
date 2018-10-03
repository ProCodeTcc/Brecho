<?php
	class controllerAnalise{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
            require_once($diretorio.'/model/produtoClass.php');
            require_once($diretorio.'/model/dao/analiseDAO.php');
		}
		
		public function listarProdutos(){
			$analiseDAO = new AnaliseDAO();
			
			$listProdutos = $analiseDAO->selectAll();
			
			return $listProdutos;
		}
	}
?>