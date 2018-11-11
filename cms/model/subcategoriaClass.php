<?php
    class Subcategoria{
        public function __construct(){

        }

        private $id;
        private $idCategoria;
        private $nome;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setIdCategoria($idCategoria){
            $this->idCategoria = $idCategoria;
        }

        public function getIdCategoria(){
            return $this->idCategoria;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getNome(){
            return $this->nome;
        }
    }
?>