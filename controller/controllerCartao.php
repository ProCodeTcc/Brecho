<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 16/11/2018
		Objetivo: controlar as ações da página de cartões
	*/

    class controllerCartao{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/cartaoClass.php');
            require_once($diretorio.'model/dao/cartaoDAO.php');
        }
        
        //função para inserir um cartão de crédido
        public function inserirCartao($tipoCliente, $idCliente){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $titular = $_POST['txttitular'];
                $numero = $_POST['txtnumero'];
                $codigo = $_POST['txtcodigo'];
                $vencimento = $_POST['txtvencimento'];
            }
            
            //criando um novo cartão
            $cartaoClass = new Cartao();
            
            //setando os atributos
            $cartaoClass->setTitular($titular);
            $cartaoClass->setNumero($numero);
            $cartaoClass->setCodigo($codigo);
            $cartaoClass->setVencimento($vencimento);
            
            //instância da classe CartaoDAO
            $cartaoDAO = new CartaoDAO();
            
            //verificando o tipo de cliente
            if($tipoCliente == 'F'){
                //inserindo o cartão e retornando o ID
                $idCartao = $cartaoDAO->Insert($cartaoClass);
                
                //verificando se existe o ID do cliente
                if(isset($idCliente)){
                    //relacionando o cartão com o cliente
                    $status = $cartaoDAO->insertCartaoCF($idCliente, $idCartao);
                    
                    //retornando o status
                    return $status;
                }
            }else{
                //inserindo o cartão e retornando o ID
                $idCartao = $cartaoDAO->Insert($cartaoClass);
                
                //verificando se existe o ID do cliente
                if(isset($idCliente)){
                    //relacionando o cartão com o cliente
                    $status = $cartaoDAO->insertCartaoCJ($idCliente, $idCartao);
                    
                    //retornando o status
                    return $status;
                }
            }
        }
        
        //função para atualizar o cartão
        public function atualizarCartao(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores da caixas de texto
                $titular = $_POST['txttitular'];
                $numero = $_POST['txtnumero'];
                $codigo = $_POST['txtcodigo'];
                $vencimento = $_POST['txtvencimento'];
                $id = $_POST['id'];
            }
            
            //criando um novo cartão
            $cartaoClass = new Cartao();
            
            //setando os atributos
            $cartaoClass->setTitular($titular);
            $cartaoClass->setNumero($numero);
            $cartaoClass->setCodigo($codigo);
            $cartaoClass->setVencimento($vencimento);
            $cartaoClass->setId($id);
            
            //instância da classe CartãoDAO
            $cartaoDAO = new CartaoDAO();
            
            //chamada da função que atualiza os dados
            $status = $cartaoDAO->Update($cartaoClass);

            //retornando o status
            return $status;
        }
        
        //função para listar os cartões do cliente
        public function listarCartao($id, $tipoCliente){
            //instância da classe CartaoDAO
            $cartaoDAO = new CartaoDAO();
            
            //verificando o tipo do cliente
            if($tipoCliente == 'F'){
                //armazenando os dados em uma variável
                $listCartao = $cartaoDAO->selectAllCF($id);
            }else{
                //armazenando os dados em uma variável
                $listCartao = $cartaoDAO->selectAllCJ($id);
            }
            
            //retornando os dados
            return $listCartao;
        }
        
        //função para buscar um cartão
        public function buscarCartao($id){
            //instância da classe CartaoDAO
            $cartaoDAO = new CartaoDAO();
            
            //armazenando os dados do cartão em uma variável
            $listCartao = $cartaoDAO->selectByID($id);
            
            //retornando os dados
            return $listCartao;
        }
        
        //função para excluir um cartão
        public function excluirCartao($id){
            //instância da classe CartaoDAO
            $cartaoDAO = new CartaoDAO();
            
            //chamada da função que exclui o cartão
            $status = $cartaoDAO->Delete($id);
            
            //retornando o status
            return $status;
        }
    }
?>