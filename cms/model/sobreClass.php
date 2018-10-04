<?php
	class Sobre{
		public function __construct(){
			
		}
		
		private $idLayout;
		private $titulo;
		private $descricao;
		private $descricao2;
		private $imagem;
		private $layout;
		private $status;
		
		public function setId($idLayout){
			$this->idLayout = $idLayout;
		}
		
		public function getId(){
			return $this->idLayout;
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
		
		public function setLayout($layout){
			$this->layout = $layout;
		}
		
		public function getLayout(){
			return $this->layout;
		}
		
		public function setStatus($status){
			$this->status = $status;
		}
		
		public function getStatus(){
			return $this->status;
		}
	}
?>