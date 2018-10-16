<?php

    /*
    Projeto: Brechó
    Autor: Felipe
    Data: 02/10/2018
    Objetivo: manipular os dados no Banco de Dados

    */

    class FaleConosco{
    
        private $idRegistro;
        private $nomePessoa;
        private $email;
        private $telefone;
        private $sexo;
        private $assunto;
        private $comentario;
        
        public function __contruct(){
        
            require_once('dao/faleConoscoDAO.php');
            
        }
        
        
        //Sets
        
        public function setIdRegistro($idRegistro){
            $this->idRegistro=$idRegistro;
        }
        
        public function setNomePessoa($nomePessoa){
            $this->nome=$nomePessoa;
        }
        
        public function setEmail($email){
            $this->email=$email;
        }
        
        public function setTelefone($telefone){
            $this->telefone=$telefone;
        }
        
        public function setSexo($sexo){
            $this->sexo=$sexo;
        }
        
        public function setAssunto($assunto){
            $this->assunto=$assunto;
        }
        
        public function setComentario($comentario){
            $this->comentario=$comentario;
        }
        
        
        //Gets
        
        public function getIdRegistro(){
            return $this->idRegistro;
        }
        
        public function getNomePessoa(){
            return $this->nome;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function getTelefone(){
            return $this->telefone;
        }
        
        public function getSexo(){
            return $this->sexo;
        }
        
        public function getAssunto(){
            return $this->assunto;
        }
        
        public function getComentario(){
            return $this->comentario;
        }
    }
?>