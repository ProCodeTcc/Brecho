<?php
	class FaleConosco{
		public function __construct(){
			
		}
		
		private $nome;
		private $id;
		private $email;
		private $telefone;
		private $sexo;
		private $assunto;
		private $comentario;
		
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
		
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function setTelefone($telefone){
			$this->telefone = $telefone;
		}
		
		public function getTelefone(){
			return $this->telefone;
		}
		
		public function setSexo($sexo){
			$this->sexo = $sexo;
		}
		
		public function getSexo(){
			return $this->sexo;
		}
		
		public function setAssunto($assunto){
			$this->assunto = $assunto;
		}
		
		public function getAssunto(){
			return $this->assunto;
		}
		
		public function setComentario($comentario){
			$this->comentario = $comentario;
		}
		
		public function getComentario(){
			$this->comentario = $comentario;
		}
		
	}
?>