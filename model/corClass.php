<?php
	class Cor{
		public function __construct(){
			
		}
		
		private $id;
		private $nome;
		private $cor;
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setNome($nome){
			$this->nome = $nome;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function setCor($cor){
			$this->cor = $cor;
		}
		
		public function getCor(){
			return $this->cor;
		}
	}
?>