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

        //função que atualiza a consignação
        public function atualizarConsignacao(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os dados das caixas de texto
                $percentual = $_POST['txtpercentualloja'];
                $dtInicio = $_POST['dtinicio'];
                $dtTermino = $_POST['dttermino'];
                $id = $_POST['id'];
            }

            //instância da classe Consignacao
            $consignacaoClass = new Consignacao();

            //setando os atributos
            $consignacaoClass->setId($id);
            $consignacaoClass->setPercentual($percentual);
            $consignacaoClass->setDtInicio($dtInicio);
            $consignacaoClass->setDtTermino($dtTermino);

            //instância da classe ConsignacaoDAO
            $consignacaoDAO = new ConsignacaoDAO();

            //chamada da função que atualiza a consignação
            $status = $consignacaoDAO->Update($consignacaoClass);
            
            return $status;
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

        //função que busca uma consignação
        public function buscarConsignacao($id){
            //instância da classe ConsignacaoDAO
            $consignacaoDAO = new ConsignacaoDAO();

            //armazenando os dados em uma variável
            $listConsignacao = $consignacaoDAO->selectConsignacao($id);

            //retornando os dados
            return $listConsignacao;
        }

        //função para pesquisar os produtos em consignação
        public function pesquisarProduto($pesquisa){
            //formatando a pesquisa
            $termo = '%'.$pesquisa.'%';

            //instância da classe ConsignacaoDAO
            $consignacaoDAO = new ConsignacaoDAO();

            //armazenando os dados em uma variável
            $listProdutos = $consignacaoDAO->searchConsignacao($termo);

            //retornando os dados
            return $listProdutos;
        }
    }
?>