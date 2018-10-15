<?php
	require_once('produtoClass.php');

	class Avaliacao extends Produto{
		public function __construct(){
			
		}
		
		private $id;
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
	}
?>