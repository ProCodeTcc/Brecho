<?php
	class controllerProduto{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/produtoClass.php');
			require_once($diretorio.'model/dao/produtoDAO.php');
		}
		
		public function buscarTamanho($tamanho){
			$produtoDAO = new ProdutoDAO();
			
			$produtoDAO->selectTamanho($tamanho);
		}
	}
?>