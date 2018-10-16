<?php
    

    /*
    Projeto: Brechó
    Autor: Felipe
    Data: 16/10/2018
    Objetivo: manipular os dados no Banco de Dados

    */

    class Login{
        
        private $idCliente;
        private $nome;
        private $login;
        private $senha;
        
        public function __construct(){
        
            require_once('dao/loginDAO.php');
            
        }
        
    
        //Sets
        
        public function setIdCliente($idCliente){
            $this->idCliente=$idCliente;
        }
        
        public function setNome($nome){
            $this->nome=$nome;
        }
        
        public function setLogin($login){
            $this->login=$login;
        }
        
        public function setSenha($senha){
            $this->senha=$senha;
        }
        
        //Gets
        
        public function getIdCliente(){
            return $this->idCliente;
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function getLogin(){
            return $this->login;
        }
        
        public function getSenha(){
            return $this->senha;
        }
    }
?>