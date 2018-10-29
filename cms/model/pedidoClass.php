<?php
    class Pedido{
        public function __construct(){

        }

        private $idPedido;
        private $dtPedido;
        private $valor;
        private $status;

        public function setIdPedido($idPedido){
            $this->idPedido = $idPedido;
        }

        public function getIdPedido(){
            return $this->idPedido;
        }

        public function setDtPedido($dtPedido){
            $this->dtPedido = $dtPedido;
        }

        public function getDtPedido(){
            return $this->dtPedido;
        }

        public function setValor($valor){
            $this->valor = $valor;
        }

        public function getValor(){
            return $this->valor;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setIdProduto($idProduto){
            $this->idProduto = $idProduto;
        }

        public function getIdProduto(){
            return $this->idProduto;
        }
    }
?>