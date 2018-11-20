<?php
    class Cartao{
        public function __construct(){
            
        }
        
        private $id;
        private $numero;
        private $titular;
        private $vencimento;
        private $codigo;
        private $status;
        
        public function setId($id){
            $this->id = $id;
        }
        
        public function getId(){
            return $this->id;
        }
        
        public function setNumero($numero){
            $this->numero = $numero;
        }
        
        public function getNumero(){
            return $this->numero;
        }
        
        public function setTitular($titular){
            $this->titular = $titular;
        }
        
        public function getTitular(){
            return $this->titular;
        }
        
        public function setVencimento($vencimento){
            $this->vencimento = $vencimento;
        }
        
        public function getVencimento(){
            return $this->vencimento;
        }
        
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        
        public function getCodigo(){
            return $this->codigo;
        }
        
        public function setStatus($status){
            $this->status = $status;
        }
        
        public function getStatus(){
            return $this->status;
        }
    }
?>