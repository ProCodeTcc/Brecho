<?php
	class controllerPromocao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/promocaoClass.php');
			require_once($diretorio.'model/dao/promocaoDAO.php');
		}
		
		public function listarProduto(){
			$promocaoDAO = new PromocaoDAO();
			$listProdutos = $promocaoDAO->selectAll();
			
			return $listProdutos;
		}
		
		public function buscarProduto($id){
			$promocaoDAO = new PromocaoDAO();
			
			$listProduto = $promocaoDAO->selectByID($id);
			
			return $listProduto;
		}
		
		public function cadastrarPromocao($id){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$desconto = $_POST['desconto'];
				$dtInicial = $_POST['dtinicial'];
				$dtFinal = $_POST['dtfinal'];
				$id = $_POST['id'];
			}
			
			$promocaoClass = new Promocao();
			
			$promocaoClass->setDesconto($desconto);
			$promocaoClass->setDtInicial($dtInicial);
			$promocaoClass->setDtFinal($dtFinal);
			$promocaoClass->setId($id);
			
			$promocaoDAO = new PromocaoDAO();
			
			$promocaoDAO->insertPromocao($promocaoClass);
		}
		
		public function excluirPromocao($id){
			$promocaoDAO = new PromocaoDAO();
			$promocaoDAO->Delete($id);
		}
		
		public function atualizarStatus($status, $id){
			$promocaoDAO = new PromocaoDAO();
			$promocaoDAO->updateStatus($status, $id);
		}
	}
?>