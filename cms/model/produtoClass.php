<?php
	class Produto{
		public function __construct(){
			
		}
		
		private $id;
		protected $nome;
		protected $descricao;
		protected $classificacao;
		protected $preco;
		protected $tamanho;
		protected $categoria;
		protected $marca;
		protected $cor;
		protected $imagem;
		protected $status;
		
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
		
		public function setTamanho($tamanho){
			$this->tamanho = $tamanho;
		}
		
		public function getTamanho(){
			return $this->tamanho;
		}
		
		public function setCor($cor){
			$this->cor = $cor;
		}
		
		public function getCor(){
			return $this->cor;
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