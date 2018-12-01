<?php
    require_once('produtoClass.php');
    class Pedido extends Produto{
        public function __construct(){

        }

        private $idPedido;
        private $dtPedido;
        private $valor;
        private $status;
        private $qtdParcela;

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
        
        public function setQtdParcela($qtdParcela){
            $this->qtdParcela = $qtdParcela;
        }
        
        public function getQtdParcela(){
            return $this->qtdParcela;
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