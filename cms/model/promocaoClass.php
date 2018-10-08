<?php
	require_once('produtoClass.php');

	class Promocao extends Produto{
		public function __construct(){
			
		}
		
		private $id;
		private $idProduto;
		private $desconto;
		protected $nome;
		protected $preco;
		protected $imagem;
		private $dtInicial;
		private $dtFinal;
		protected $status;
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setIdProduto($idProduto){
			$this->idProduto = $idProduto;
		}
		
		public function getIdProduto($idProduto){
			return $this->idProduto;
		}
		
		public function setDesconto($desconto){
			$this->desconto = $desconto;
		}
		
		public function getDesconto(){
			return $this->desconto;
		}
		
		public function setNome($nome){
			$this->nome = $nome;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function setPreco($preco){
			$this->preco = $preco;
		}
		
		public function getPreco(){
			return $this->preco;
		}
		
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		
		public function getImagem(){
			return $this->imagem;
		}
		
		public function setDtInicial($dtInicial){
			$this->dtInicial = $dtInicial;
		}
		
		public function getDtInicial(){
			return $this->dtInicial;
		}
		
		public function setDtFinal($dtFinal){
			$this->dtFinal = $dtFinal;
		}
		
		public function getDtFinal(){
			return $this->dtFinal;
		}
		
		public function setStatus($status){
			$this->status = $status;
		}
		
		public function getStatus(){
			return $this->status;
		}
		
	}
?>