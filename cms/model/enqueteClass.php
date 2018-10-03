<?php
/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: manipular os dado das enquetes no banco

    */
    
    class Enquete{

        public function __construct(){
            
        }

        private $id;
        private $pergunta;
        private $tema;
        private $alternativaA;
        private $alternativaB;
        private $alternativaC;
        private $alternativaD;
        private $dtInicio;
        private $dtTermino;
        private $idTema;
        private $status;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setPergunta($pergunta){
            $this->pergunta = $pergunta;
        }

        public function getPergunta(){
            return $this->pergunta;
        }

        public function setTema($tema){
            $this->tema = $tema;
        }

        public function getTema(){
            return $this->tema;
        }

        
        public function setAlternativaA($alternativaA){
            $this->alternativaA = $alternativaA;
        }

        public function getAlternativaA(){
            return $this->alternativaA;
        }

        public function setAlternativaB($alternativaB){
            $this->alternativaB = $alternativaB;
        }

        public function getAlternativaB(){
            return $this->alternativaB;
        }

        public function setAlternativaC($alternativaC){
            $this->alternativaC = $alternativaC;
        }

        public function getAlternativaC(){
            return $this->alternativaC;
        }

        public function setAlternativaD($alternativaD){
            $this->alternativaD = $alternativaD;
        }

        public function getAlternativaD(){
            return $this->alternativaD;
        }

        public function setDtInicio($dtInicio){
            $this->dtInicio = $dtInicio;
        }

        public function getDtInicio(){
            return $this->dtInicio;
        }

        public function setDtTermino($dtTermino){
            $this->dtTermino = $dtTermino;
        }

        public function getDtTermino(){
            return $this->dtTermino;
        }

        public function setIdTema($idTema){
            $this->idTema = $idTema;
        }

        public function getIdTema(){
            return $this->idTema;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }
    }
?>