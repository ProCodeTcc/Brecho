<?php
	class Pagina{
		public function __construct(){
			
		}
		
		private $id;
		private $pagina;
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setPagina($pagina){
			$this->pagina = $pagina;
		}
		
		public function getPagina(){
			return $this->pagina;
		}
	}
?>