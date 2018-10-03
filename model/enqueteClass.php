<?php

    /*
    Projeto: Brechó
    Autor: Felipe
    Data: 01/10/2018
    Objetivo: manipular os dados no Banco de Dados

    */


    class Enquete{
        
        //Atributos
        private $idEnqute;
        private $pergunta;
        private $dataInicial;
        private $dataFinal;
        private $alternternativaA;
        private $alternternativaB;
        private $alternternativaC;
        private $alternternativaD;
        private $qtdAlternativaA;
        private $qtdAlternativaB;  
        private $qtdAlternativaC;
        private $qtdAlternativaD;
        private $status;
        private $idTema;
        
        public function __construct(){
        
            require_once('dao/enqueteDAO.php');
        
        }

        //SETS
        
        public function setIdEqute($idEnqute){
            $this-> idEqute =  $idEnqute;
        }
        
        public function setPergunta($pergunta){
            $this-> pergunta =  $pergunta;
        }
        
        public function setDataInicial($dataInicial){
            $this-> dataInicial =  $dataInicial;
        }
        
        public function setDataFinal($dataFinal){
            $this-> dataFinal =  $dataFinal;
        }
        
        public function setAlternativaA($alternternativaA){
            $this-> alternativaA =  $alternternativaA;
        }
        
        public function setAlternativaB($alternternativaB){
            $this-> alternativaB =  $alternternativaB;
        }
        
        public function setAlternativaC($alternternativaC){
            $this-> alternativaC =  $alternternativaC;
        }
        
        public function setAlternativaD($alternternativaD){
            $this-> alternativaD =  $alternternativaD;
        }
        
        public function setQtdAlternativaA($qtdAlternativaA){
            $this-> qtdAlternativaA =  $qtdAlternativaA;
        }
        
        public function setQtdAlternativaB($qtdAlternativaB){
            $this-> qtdAlternativaB =  $qtdAlternativaB;
        }
        
        public function setQtdAlternativaC($qtdAlternativaC){
            $this-> qtdAlternativaC =  $qtdAlternativaC;
        }
        
        public function setQtdAlternativaD($qtdAlternativaD){
            $this-> qtdAlternativaD =  $qtdAlternativaD;
        }
        
        public function setStatus($status){
            $this-> status =  $status;
        }
        
        public function setIdTema($idTema){
            $this-> idTema =  $idTema;
        }
        
         //GETS
        
        public function getIdEqute(){
            return $this-> idEqute;
        }
        
        public function getPergunta(){
            return $this-> pergunta;
        }
        
        public function getDataInicial(){
            return $this-> dataInicial;
        }
        
        public function getDataFinal(){
            return $this-> dataFinal;
        }
        
        public function getAlternativaA(){
            return $this-> alternativaA;
        }
        
        public function getAlternativaB(){
            return $this-> alternativaB;
        }
        
        public function getAlternativaC(){
            return $this-> alternativaC;
        }
        
        public function getAlternativaD(){
            return $this-> alternativaD;
        }
        
        public function getQtdAlternativaA(){
            return $this-> qtdAlternativaA;
        }
        
        public function getQtdAlternativaB(){
            return $this-> qtdAlternativaB;
        }
        
        public function getQtdAlternativaC(){
            return $this-> qtdAlternativaC;
        }
        
        public function getQtdAlternativaD(){
            return $this-> qtdAlternativaD;
        }
        
        public function getStatus(){
            return $this-> status;
        }
        
        public function getIdTema(){
            return $this-> idTema;
        }
        
    }



?>