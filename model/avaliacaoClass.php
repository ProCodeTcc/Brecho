<?php
	require_once('produtoClass.php');
	class Avaliacao extends Produto{
		public function __construct(){
			
		}
		
		private $id;
		private $data;

		public function setData($data){
			$this->data = $data;
		}

		public function getData(){
			return $this->data;
		}
		
	}
?>