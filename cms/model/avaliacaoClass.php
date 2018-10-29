<?php
	require_once('produtoClass.php');

	class Avaliacao extends Produto{
		public function __construct(){
			
		}
		
		private $id;
		private $idCliente;

		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}

		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}

		public function getIdCliente(){
			return $this->idCliente;
		}
		
	}
?>