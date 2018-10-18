<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'model/enderecoClass.php');
	class Unidade extends Endereco{
		public function __construct(){
			
		}
		
		private $id;
		private $nome;
		private $loja;
		private $idLoja;
		private $idEndereco;
		
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
		
		public function setIdEndereco($idEndereco){
			$this->idEndereco = $idEndereco;
		}
		
		public function getIdEndereco(){
			return $this->idEndereco;
		}
	}
?>