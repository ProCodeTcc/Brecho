<?php
	require_once('produtoClass.php');
	
	class Promocao extends Produto{
		public function __construct(){
			
		}
		
		private $id;
		private $idProduto;
		private $desconto;
		private $totalDesconto;

		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setIdProduto($idProduto){
			$this->idProduto = $idProduto;
		}
		
		public function getIdProduto(){
			return $this->idProduto;
		}
		
		public function setDesconto($desconto){
			$this->desconto = $desconto;
		}
		
		public function getDesconto(){
			return $this->desconto;
		}
		
		public function setTotalDesconto($totalDesconto){
			$this->totalDesconto = $totalDesconto;
		}
		
		public function getTotalDesconto(){
			return $this->totalDesconto;
		}
		
	}
	
		
?>