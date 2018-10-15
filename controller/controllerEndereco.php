<?php

/*
        Projeto: Brechó
        Autor:  Felipe Monteiro
        Data: 15/10/2018
        Objetivo: 

    */

    class controllerEndereco{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/enderecoClass.php');
            require_once($diretorio.'model/dao/enderecoDAO.php');
        }
        
        //chamada da função que envia um feedback
        public function inserirEndereco(){
            //Verifica sse o metodo é post
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //resgata os valores das caixas de texto
                $cep= $_POST['txtCep'];
                $tipo= $_POST['txtTipo'];
                $logradouro= $_POST['txtLogradouro'];
                $estado= $_POST['txtEstado'];
                $cidade= $_POST['txtCidade'];
                $numero= $_POST['txtNumero'];
                $complemento= $_POST['txtComplemento'];
            }
           
            //instancia da classe
            $enderecoClass = new Endereco();
            
            //setando os atributos
            $enderecoClass->setCep($cep);
            $enderecoClass->setIdTipoEndereco($tipo);
            $enderecoClass->setLogradouro($logradouro);
            $enderecoClass->setEstado($estado);
            $enderecoClass->setCidade($cidade);
            $enderecoClass->setNumero($numero);
            $enderecoClass->setComplemento($complemento);
            
            //instancia da classe DAO
            
            $enderecoDAO = new EnderecoDAO();
            
            //chamada da função para inserir dados
            $enderecoDAO::Insert($enderecoClass);
        }
    }
?>