<?php
	class Evento{
		public function __construct(){
			
		}
		
		private $id;
		private $imagem;
		private $nome;
		private $descricao;
		private $dtInicio;
		private $dtTermino;
		private $loja;
		private $idLoja;
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

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getNome(){
			return $this->nome;
		}
		
		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setLoja($loja){
			$this->loja = $loja;
		}
		
		public function getLoja(){
			return $this->loja;
		}
		
		public function setIdLoja($idLoja){
			$this->idLoja = $idLoja;
		}
		
		public function getIdLoja(){
			return $this->idLoja;
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