<?php
	class Produto{
		public function __construct(){
			
		}
		
		private $idProduto;
		private $nome;
		private $descricao;
		private $classificacao;
		private $preco;
		
		public function setIdProduto($id){
			$this->id = $id;
		}
		
		public function getIdProduto(){
			return $this->id;
		}
		
		public function setNome($nome){
			$this->nome = $nome;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function setDescricao(){
			$this->descricao = $descricao;
		}
		
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setClassificacao($classificacao){
			$this->classificacao = $classificacao;
		}
		
		public function getClassificacao(){
			return $this->classificacao;
		}
		
		
		public function setPreco($preco){
			$this->preco = $preco;
		}
		
		public function getPreco(){
			return $this->preco;
		}
	}
?>