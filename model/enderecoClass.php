<?php

/*
    Projeto: Brechó
    Autor: Felipe
    Data: 15/10/2018
    Objetivo: manipular os dados de endereço no Banco de Dados

    */



    class Endereco{
        private $idEndereco;
        private $logradouro;
        private $bairro;
        private $cidade;
        private $estado;
        private $numero;
        private $complemento;
        private $latitude;
        private $longitude;
        private $cep;
        private $idTipoEndereco;
        
        public function __construct(){
            require_once('dao/enderecoDAO.php');
        }
        
        // Sets 
        
        public function setIdEndereco($idEndereco){
            $this->idEndereco=$idEndereco;
        }
        
        public function setLogradouro($logradouro){
            $this->logradouro=$logradouro;
        }
        
        public function setBairro($bairro){
            $this->bairro=$bairro;
        }
        
        public function setCidade($cidade){
            $this->cidade=$cidade;
        }
        
        public function setEstado($estado){
            $this->estado=$estado;
        }
        
        public function setNumero($numero){
            $this->numero=$numero;
        }
        
        public function setComplemento($complemento){
            $this->complemento=$complemento;
        }
        
        public function setLatitude($latitude){
            $this->latitude=$latitude;
        }
        
        public function setLongitude($longitude){
            $this->longitude=$longitude;
        }
        
        public function setCep($cep){
            $this->cep=$cep;
        }
        
        public function setIdTipoEndereco($idTipoEndereco){
            $this->idTipoEndereco=$idTipoEndereco;
        }
       
        //GETS
        
        public function getIdEndereco(){
            return $this->idEndereco;
        }
        
        public function getLogradouro(){
            return $this->logradouro;
        }
        
        public function getBairro(){
            return $this->bairro;
        }
        
        public function getCidade(){
            return $this->cidade;
        }
        
        public function getEstado(){
            return $this->estado;
        }
        
        public function getNumero(){
            return $this->numero;
        }
        
        public function getComplemento(){
            return $this->complemento;
        }
        
        public function getLatitude(){
            return $this->longitude;
        }
        
        public function getLongitude(){
            return $this->latitude;
        }
        
        public function getCep(){
            return $this->cep;
        }
        
        public function getIdTipoEndereco(){
            return $this->idTipoEndereco;
        }
        
    }

?>