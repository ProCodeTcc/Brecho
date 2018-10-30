<?php
    /*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 26/10/2018
        Objetivo: controlar as ações da página de consignação
    */
    class controllerConsignacao{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
            require_once($diretorio.'/model/consignacaoClass.php');
            require_once($diretorio.'/model/dao/consignacaoDAO.php');
        }

        //função para listar os produtos
        public function listarProdutos(){
            //instância da classe ConsignacaoDAO
            $consignacaoDAO = new ConsignacaoDAO();

            //armazenando os dados em uma variável
            $listProdutos = $consignacaoDAO->selectAll();

            //retornando os dados
            return $listProdutos;
        }
    }
?>