<?php
require_once('clienteClass.php');
     /*
    Projeto: Brechó
    Autor: Felipe
    Data: 10/10/2018
    Objetivo: manipular os dados no Banco de Dados para cadastro do cliente fisico

    */

    class ClienteFisico extends Cliente{
        private $idCliente;
        private $nome;
        private $sobrenome;
        private $cpf;
        
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
        
        
        public function setCpf($cpf){
            $this->cpf= $cpf;
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
        
        public function getCpf(){
            return $this->cpf;
        }
        
        
    }
?>