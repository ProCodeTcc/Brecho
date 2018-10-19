<?php
	class Retirada{
		public function __construct(){
			
		}
		
		private $idRetirada;
		private $idPedido;
		private $cliente;
		private $produto;
		private $loja;
		private $idUnidade;
		private $dtRetirada;
		
		public function setIdRetirada($idRetirada){
			$this->idRetirada = $idRetirada;
		}
		
		public function getIdRetirada(){
			return $this->idRetirada;
		}
		
		public function setIdPedido($idPedido){
			$this->idPedido = $idPedido;
		}
		
		public function getIdPedido(){
			return $this->idPedido;
		}
		
		public function setCliente($cliente){
			$this->cliente = $cliente;
		}
		
		public function getCliente(){
			return $this->cliente;
		}
		
		public function setProduto($produto){
			$this->produto = $produto;
		}
		
		public function getProduto(){
			return $this->produto;
		}
		
		public function setLoja($loja){
			$this->loja = $loja;
		}
		
		public function getLoja(){
			return $this->loja;
		}
		
		public function setIdUnidade($idUnidade){
			$this->idUnidade = $idUnidade;
		}
		
		public function getIdUnidade(){
			return $this->idUnidade;
		}
		
		public function setDtRetirada($dtRetirada){
			$this->dtRetirada = $dtRetirada;
		}
		
		public function getDtRetirada(){
			return $this->dtRetirada;
		}
	}
?>