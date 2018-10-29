<?php
    /*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 25/10/2018
		Objetivo: controlar as ações dos pedidos
	*/
    class controllerPedido{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/pedidoClass.php');
            require_once($diretorio.'model/dao/pedidoDAO.php');
            require_once($diretorio.'model/dao/clienteFisicoDAO.php');
            require_once($diretorio.'model/dao/clienteJuridicoDAO.php');
        }

        public function gerarPedido(){
            //verifica se a sessão existe
            if(session_id() == ""){
                //inicia a sessão
                session_start();
                //verifica se existe a sessão do carrinho
                if(isset($_SESSION['carrinho'])){
                    //instância da classe PedidoDAO
                    $pedidoDAO = new PedidoDAO();

                    //instância da classe Pedido
                    $pedidoClass = new Pedido();
                    
                    date_default_timezone_set('America/Sao_Paulo');

                    //armazenando a data atual no formato do banco
                    $dataAtual = date('Y-m-d');
                    
                    //setando os atributos do pedido
                    $pedidoClass->setDtPedido($dataAtual);
                    $pedidoClass->setValor($_SESSION['total']);
                    
                    //recuperando o ID do pedido inserido
                    $idPedido = $pedidoDAO->Insert($pedidoClass);

                    if(isset($idPedido)){
                        //precorrendo os produtos
                        foreach($_SESSION['carrinho'] as $produtos){
                            //inserindo os produtos na tabela de relacionamento
                            $pedidoDAO->insertPedidoProduto($idPedido, $produtos['id']);
                        }
                    }else{
                        echo('erro');
                    }

                    //verificando se existe o ID do cliente
                    if($_SESSION['tipoCliente'] == 'F'){
                        //inserindo o ID do Cliente e do Pedido na tabela de relacionamento
                        $pedidoDAO->insertPedidoFisico($idPedido, $_SESSION['idCliente']);
                        
                        //zerando a sessão do carrinho
                        unset($_SESSION['carrinho']);

                        //zerando o total
                        unset($_SESSION['total']);

                        echo('sucesso');
                    }else{
                        //inserindo o ID do Cliente e do Pedido na tabela de relacionamento
                        $pedidoDAO->insertPedidoJuridico($idPedido, $_SESSION['idCliente']);

                        //zerando a sessão do carrinho
                        unset($_SESSION['carrinho']);

                        //zerando o total
                        unset($_SESSION['total']);

                        echo('sucesso');
                    }
                }
            }
        }

        //função para listar as compras do cliente
        public function filtrarCompra($tipoCliente, $idCliente){

            //verificando o tipo de cliente
            if($tipoCliente == 'F'){
                //instância da classe ClienteFisicoDAO
                $clienteFisicoDAO = new ClienteFisicoDAO();

                //armazenando os produtos do cliente
                $listProduto = $clienteFisicoDAO->selectCompra($idCliente);
            }else{
                //instância da classe ClienteJuridicoDAO
                $clienteJuridicoDAO = new ClienteJuridicoDAO();

                //armazenando os produtos em uma variável
                // $listProduto = $clienteJuridicoDAO->selectCompra($idCliente);
            }

            //contador
            $cont = 0;

            //percorrendo os dados
            while($cont < count($listProduto)){
                //formatando a data para o padrão brasileiro
                $data = date('d/m/Y', strtotime($listProduto[$cont]->getDtPedido()));

                //setando a data formatada
                $listProduto[$cont]->setDtPedido($data);

                //incrementando o contador
                $cont++;
            }

            //retornando os dados
            return $listProduto;
        }

        //função para listar as vendas concretizadas através de uma compra direta pelo brechó
        public function filtrarVenda($tipoCliente, $idCliente){
            //verificando o tipo de cliente
            if($tipoCliente == 'F'){
                //instância da classe ClienteFisicoDAO
                $clienteFisicoDAO = new ClienteFisicoDAO();

                //armazenando os dados em uma variável
                $listProduto = $clienteFisicoDAO->selectVenda($idCliente);
            }else{
                //instância da classe ClienteJuridicoDAO
                $clienteJuridicoDAO = new ClienteJuridicoDAO();

                //armazenando os dados em uma variável
                $listProduto = $clienteJuridicoDAO->selectVenda($idCliente);
            }

            //contador
            $cont = 0;

            //percorrendo os dados
            while($cont < count($listProduto)){
                //convertendo a data para o formato brasileiro
                $data = date('d/m/Y', strtotime($listProduto[$cont]->getDtPedido()));

                //setando a data formatada
                $listProduto[$cont]->setDtPedido($data);

                //armazenando o contador
                $cont++;
            }

            //retornando os dados
            return $listProduto;
        }
    }
?>