<?php
	class Tema{
		public function __construct(){
			
		}
		
		private $id;
		private $nome;
		private $cor;
		private $genero;
		private $status;
		
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
		
		public function setGenero($genero){
			$this->genero = $genero;
		}
		
		public function getGenero(){
			return $this->genero;
		}
		
		public function setStatus($status){
			$this->status = $status;
		}
		
		public function getStatus(){
			return $this->status;
		}
	}
?>