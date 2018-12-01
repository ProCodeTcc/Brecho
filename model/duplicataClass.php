<?php
    class Duplicata{
        public function __construct(){
            
        }
        
        private $idDuplicata;
        private $idPedido;
        private $dtVencimento;
        private $valor;
        private $dtPagamento;
        
        public function setIdDuplicata($idDuplicata){
            $this->idDuplicata = $idDuplicata;
        }
        
        public function getIdDuplicata(){
            return $this->idDuplicata;
        }
        
        public function setIdPedido($idPedido){
            $this->idPedido = $idPedido;
        }
        
        public function getIdPedido(){
            return $this->idPedido;
        }
        
        public function setDtVencimento($dtVencimento){
            $this->dtVencimento = $dtVencimento;
        }
        
        public function getDtVencimento(){
            return $this->dtVencimento;
        }
        
        public function setValor($valor){
            $this->valor = $valor;
        }
        
        public function getValor(){
            return $this->valor;
        }
        
        public function setDtPagamento($dtPagamento){
            $this->dtPagamento = $dtPagamento;
        }
        
        public function getDtPagamento(){
            return $this->dtPagamento;
        }
    }
?>