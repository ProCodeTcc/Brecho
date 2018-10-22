<?php
	class Slider{
		public function __construct(){
			
		}
		
		private $imagem;
		
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		
		public function getImagem(){
			return $this->imagem;
		}
	}
?>