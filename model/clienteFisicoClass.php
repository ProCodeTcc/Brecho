<?php

     /*
    Projeto: Brechó
    Autor: Felipe
    Data: 10/10/2018
    Objetivo: manipular os dados no Banco de Dados para cadastro do cliente

    */

    class ClienteFisico{
        private $idCliente;
        private $nome;
        private $sobrenome;
        private $telefone;
        private $celular;
        private $email;
        private $cpf;
        private $dataNascimento;
        private $login;
        private $senha;
        private $sexo;
        private $app;
        
        public function __construct(){
            require_once('dao/ClienteFisicoDAO.php');
        }
        
        //Sets
        
        public function setIdCliente($idCliente){
            $this->idCliente= $idCliente;
        }
        
        public function setNome ($nome){
            $this->nome= $nome;
        }
        
        public function setSobrenome($sobrenome){
            $this->sobrenome= $sobrenome;
        }
        
        public function setTelefone($telefone){
            $this->telefone= $telefone;
        }
        
        public function setCelular($celular){
            $this->celular= $celular;
        }
        
        public function setEmail($email){
            $this->email= $email;
        }
        
        public function setCpf($cpf){
            $this->cpf= $cpf;
        }
        
        public function setDataNascimento($dataNascimento){
            $this->dataNascimento= $dataNascimento;
        }
        
        public function setLogin($login){
            $this->login= $login;
        }
        
        public function setSenha($senha){
            $this->senha= $senha;
        }
        
        public function setSexo($sexo){
            $this->sexo= $sexo;
        }
        
        public function setApp($app){
            $this->app= $app;
        }
        
        //Gets
        
        public function getIdCliente(){
            return $this->idCliente;
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function getSobrenome(){
            return $this->sobrenome;
        }
        
        public function getTelefone(){
            return $this->telefone;
        }
        
        public function getCelular(){
            return $this->celular;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function getCpf(){
            return $this->cpf;
        }
        
        public function getDataNascimento(){
            return $this->dataNascimento;
        }
        
        public function getLogin(){
            return $this->login;
        }
        
        public function getSenha(){
            return $this->senha;
        }
        
        public function getSexo(){
            return $this->sexo;
        }
        
        public function getApp(){
            return $this->app;
        }
        
        
    }
?>