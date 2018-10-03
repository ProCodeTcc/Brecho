<?php
    class Usuario{
        public function __construct(){

        }
        
        private $id;
        private $usuario;
        private $nome;
        private $senha;
        private $imagem;
        private $nivel;
        private $idNivel;
        private $nomeNivel;
        private $status;

        public function setId($id){
                $this->id = $id;
        }

        public function getId(){
                return $this->id;
        }
        
        public function getUsuario(){
                return $this->usuario;
        }

        public function setUsuario($usuario){
                $this->usuario = $usuario;

        }
        
        public function getNome(){
                return $this->nome;
        }

        public function setNome($nome){
                $this->nome = $nome;

        }

        public function getSenha(){
                return $this->senha;
        }

        public function setSenha($senha){
                $this->senha = $senha;

        }

        
        public function getNivel(){
                return $this->nivel;
        }

        public function setNivel($nivel){
                $this->nivel = $nivel;

        }

        
        public function getImagem(){
                return $this->imagem;
        }


        public function setImagem($imagem){
                $this->imagem = $imagem;
        }

        public function getIdNivel(){
                return $this->idNivel;
        }

        public function setIdNivel($idNivel){
                $this->idNivel = $idNivel;
        }

        public function getNomeNivel()
        {
                return $this->nomeNivel;
        }
 
        public function setNomeNivel($nomeNivel)
        {
                $this->nomeNivel = $nomeNivel;

        }

        public function getStatus()
        {
                return $this->status;
        }
 
        public function setStatus($status)
        {
                $this->status = $status;

        }
    }
?>