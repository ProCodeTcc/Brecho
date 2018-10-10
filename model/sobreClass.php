<?php
	class Sobre{
		public function __construct(){
			
		}
		
		private $id;
		private $titulo;
		private $descricao;
		private $descricao2;
		private $imagem;
		private $layout;
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}
		
		public function getTitulo(){
			return $this->titulo;
		}
		
		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setDescricao2($descricao2){
			$this->descricao2 = $descricao2;
		}
		
		public function getDescricao2(){
			return $this->descricao2;
		}
		
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		
		public function getImagem(){
			return $this->imagem;
		}
	}
?>