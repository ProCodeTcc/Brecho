<?php
    class Categoria{
        public function __construct(){

        }

        private $id;
        private $nome;
        private $genero;
        private $idSubcategoria;
        private $status;

        
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

        public function setGenero($genero){
            $this->genero = $genero;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function setIdSubcategoria($idSubcategoria){
            $this->idSubcategoria = $idSubcategoria;
        }

        public function getIdSubcategoria(){
            return $this->idSubcategoria;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }
    }
?>