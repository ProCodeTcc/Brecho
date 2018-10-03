<?php
	class Evento{
		public function __construct(){
			
		}
		
		private $id;
		private $imagem;
		private $titulo;
		private $descricao;
		private $dtInicio;
		private $dtTermino;
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
		
		public function setDtInicio($dtInicio){
			$this->dtInicio = $dtInicio;
		}
		
		public function getDtInicio(){
			return $this->dtInicio;
		}
		
		public function setDtTermino($dtTermino){
			$this->dtTermino = $dtTermino;
		}
		
		public function getDtTermino(){
			return $this->dtTermino;
		}
		
		public function setStatus($status){
			$this->status = $status;
		}
		
		public function getStatus(){
			return $this->status;
		}
	}
?>