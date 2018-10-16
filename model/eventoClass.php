<?php

/*
    Projeto: Brechó
    Autor: Felipe
    Data: 10/10/2018
    Objetivo: manipular os dados no Banco de Dados para cadastro do cliente

    */

    class Evento{
        private $idEvento;
        private $nomeEvento;
        private $descricaoEvento;
        private $imagemEvento;
        private $status;
        
        
        public function __construct(){
            require_once('dao/EventoDAO.php')
        }
        
        //Sets
        public function setIdEvento($idEvento){
            $this->idEvento= $idEvento
        }
        
        public function setNomeEvento($nomeEvento){
            $this->nomeEvento= $nomeEvento
        }
        
        public function setDescricaoEvento($descricaoEvento){
            $this->descricaoEvento= $descricaoEvento
        }
        
        public function setImagemEvento($imagemEvento){
            $this->imagemEvento= $imagemEvento
        }
        
        public function setStatus($status){
            $this->status= $status
        }
        
        
        //Gets
        public function getIdEvento(){
           return $this->idEvento;
        }
        
        public function getNomeEvento(){
           return $this->nomeEvento; 
        }
        
        public function getDescricaoEvento(){
           return $this->descricaoEvento; 
        }
        
        public function getImagemEvento(){
           return $this->imagemEvento; 
        }
        
        public function getStatus(){
           return $this->status;
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }

?>