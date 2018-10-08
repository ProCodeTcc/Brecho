<?php
	class Produto{
		public function __construct(){
			
		}
		
		private $id;
		private $nome;
		private $descricao;
		private $preco;
		private $classificacao;
		private $marca;
		private $categoria;
		private $cor;
		private $tamanho;
		private $imagem;
		
		
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
		
		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setPreco($preco){
			$this->preco = $preco;
		}
		
		public function getPreco(){
			return $this->preco;
		}
		
		public function setClassificacao($classificacao){
			$this->classificacao = $classificacao;
		}
		
		public function getClassificacao(){
			return $this->classificacao;
		}
		
		public function setMarca($marca){
			$this->marca = $marca;
		}
		
		public function getMarca(){
			return $this->marca;
		}
		
		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}
		
		public function getCategoria(){
			return $this->categoria;
		}
		
		public function setCor($cor){
			$this->cor = $cor;
		}
		
		public function getCor(){
			return $this->cor;
		}
		
		public function setTamanho($tamanho){
			$this->tamanho = $tamanho;
		}
		
		public function getTamanho(){
			return $this->tamanho;
		}
		
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		
		public function getImagem(){
			return $this->imagem;
		}
	}
?>