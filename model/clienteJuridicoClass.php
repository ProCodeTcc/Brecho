<?php
	require_once('clienteClass.php');
     /*
    Projeto: Brechó
    Autor: Lucas Eduardo
    Data: 21/10/2018
    Objetivo: manipular os dados no Banco de Dados para cadastro do juridico

    */

    class ClienteJuridico extends Cliente{
        private $idCliente;
        private $razaoSocial;
        private $cnpj;
        
        public function __construct(){

        }
        
        //Sets
        
        public function setIdCliente($idCliente){
            $this->idCliente= $idCliente;
        }
        
        public function setRazaoSocial ($razaoSocial){
            $this->razaoSocial= $razaoSocial;
        }
        
        public function setCnpj($cnpj){
            $this->cnpj= $cnpj;
        }
        
        //Gets
        
        public function getIdCliente(){
            return $this->idCliente;
        }
        
        public function getRazaoSocial(){
            return $this->razaoSocial;
        }
        
        public function getCnpj(){
            return $this->cnpj;
        }
        
        
    }
?>