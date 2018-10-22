<?php
	class Slider{
		public function __construct(){
			
		}
		
		private $id;
		private $imagem;
		private $status;
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		
		public function getImagem(){
			return $this->imagem;
		}
		
		public function setStatus($status){
			$this->status = $status;
		}
		
		public function getStatus(){
			return $this->status;
		}
	}
?>