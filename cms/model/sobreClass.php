<?php
	class Sobre{
		public function __construct(){
			
		}
		
		private $idLayout;
		private $titulo;
		private $descricao;
		private $imagem;
		
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
		
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		
		public function getImagem(){
			return $this->imagem;
		}
	}
?>