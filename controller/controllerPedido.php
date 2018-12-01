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
            require_once($diretorio.'model/duplicataClass.php');
            require_once($diretorio.'model/dao/duplicataDAO.php');
            require_once($diretorio.'model/dao/consignacaoDAO.php');
            require_once($diretorio.'model/dao/produtoDAO.php');
        }

        public function gerarPedido($qtdParcela){
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
                    $total = $_SESSION['total'];
                    
                    //setando os atributos do pedido
                    $pedidoClass->setDtPedido($dataAtual);
                    $pedidoClass->setValor($total);
                    $pedidoClass->setQtdParcela($qtdParcela);
                    
                    //recuperando o ID do pedido inserido
                    $idPedido = $pedidoDAO->Insert($pedidoClass);

                    if(isset($idPedido)){
                        //precorrendo os produtos
                        foreach($_SESSION['carrinho'] as $produtos){
                            //inserindo os produtos na tabela de relacionamento
                            $status = $pedidoDAO->insertPedidoProduto($idPedido, $produtos['id']);
                        }
                        
                        if($status == 'sucesso'){
                            //verificando se existe o ID do cliente
                            if($_SESSION['tipoCliente'] == 'F'){
                                $clienteFisicoDAO = new ClienteFisicoDAO();

                                //inserindo o ID do Cliente e do Pedido na tabela de relacionamento
                                $clienteFisicoDAO->insertPedidoCliente($idPedido, $_SESSION['idCliente']);
                                
                                $status = array('dados' => array('status' => 'sucesso', 'pedido' => $idPedido, 'parcelas' => $qtdParcela, 'dtPagamento' =>  $dataAtual, 'valor' => $total));
                                
                                return json_encode($status);
                            }else{
                                $clienteJuridicoDAO = new ClienteJuridicoDAO();

                                //inserindo o ID do Cliente e do Pedido na tabela de relacionamento
                                $clienteJuridicoDAO->insertPedidoCliente($idPedido, $_SESSION['idCliente']);
                                
                                $status = array('dados' => array('status' => 'sucesso', 'pedido' => $idPedido, 'parcelas' => $qtdParcela, 'dtPagamento' =>  $dataAtual, 'valor' => $total));
                                
                                return json_encode($status);
                            }
                        }
                    }else{
                        echo('erro');
                    }
                }
            }
        }
        
        //função para gerar uma duplicata
        public function gerarDuplicata(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores
                $pedido = $_POST['pedido'];
                $parcela = $_POST['parcela'];
                $dtPagamento = $_POST['pagamento'];
                $valor = $_POST['valor'];
            }
            
            //instância da classe de duplicatas
            $duplicataClass = new Duplicata();
        
            //setando a data de vencimento pra 30 dias a partir da data de pagamento
            $dtVencimento = date('Y-m-d', strtotime("$dtPagamento +30 days"));
            
            //dividindo o valor pela qtd de parcelas
            $valorReal = $valor/$parcela;
            
            //setando os atributos
            $duplicataClass->setIdPedido($pedido);
            $duplicataClass->setDtPagamento($dtPagamento);
            $duplicataClass->setDtVencimento($dtVencimento);
            $duplicataClass->setValor($valorReal);
            
            //verificando se uma sessão está aberta
            if(session_id() == ""){
                //se não, inicia
                session_start();
            }
            
            //instância da classe DuplicataDAO
            $duplicataDAO = new DuplicataDAO();
            
            //verificando se existe mais de uma parcela
            if($parcela > 1){
                //percorrendo a qtd de parcelas
                for($i = 0; $i < $parcela; $i++){
                    //atualizando a data de vencimento
                    $dtVencimento = date('Y-m-d', strtotime("$dtVencimento +30 days"));
                    
                    //setando a data de vencimento atualizada
                    $duplicataClass->setDtVencimento($dtVencimento);
                    
                    //inserindo uma duplicata a receber
                    $status = $duplicataDAO->insertDuplicataReceber($duplicataClass);
                }
            }else{
                $status = $duplicataDAO->insertDuplicataReceber($duplicataClass);
            }
            
            //instância da classe consignacaoDAO
            $consignacaoDAO = new ConsignacaoDAO();
            
            //instância da classe ProdutoDAO
            $produtoDAO = new ProdutoDAO();
            
            //percorrendo o carrinho
            foreach($_SESSION['carrinho'] as $produto){
                //verificando se o produto está em consignação e armazenando o ID da consignação
                $idConsignacao = $consignacaoDAO->checkConsignacao($produto['id']);
                
                //atualizando o status do produto
                $produtoDAO->updateStatus($produto['id']);
                
                //verificando se o produto está em consignação
                if(isset($idConsignacao)){
                    //armazenando o valor da consignação
                    $valor = $consignacaoDAO->getValor($idConsignacao);
                    
                    //setando o valor da duplicata
                    $duplicataClass->setValor($valor);
                    
                    //inserindo a duplicata
                    $status = $duplicataDAO->insertDuplicataPagar($duplicataClass);
                    
                    //atualizando o status da consignação
                    $consignacaoDAO->updateStatus($idConsignacao);
                }
            }
            
            //retornando o status
            return $status;
        }

        //função para listar as compras do cliente
        public function filtrarCompra($tipoCliente, $idCliente){

            //verificando o tipo de cliente
            if($tipoCliente == 'F'){
                //instância da classe ClienteFisicoDAO
                $clienteFisicoDAO = new ClienteFisicoDAO();

                //armazenando os produtos do cliente
                $listPedido = $clienteFisicoDAO->selectCompra($idCliente);
            }else{
                //instância da classe ClienteJuridicoDAO
                $clienteJuridicoDAO = new ClienteJuridicoDAO();

                //armazenando os produtos em uma variável
                $listPedido = $clienteJuridicoDAO->selectCompra($idCliente);
            }

            //contador
            $cont = 0;

            //percorrendo os dados
            while($cont < count($listPedido)){
                //formatando a data para o padrão brasileiro
                $data = date('d/m/Y', strtotime($listPedido[$cont]->getDtPedido()));

                //setando a data formatada
                $listPedido[$cont]->setDtPedido($data);

                if($listPedido[$cont]->getStatus() == 0){
                    $status = 'aguardando pagamento';
                }else if($listPedido[$cont]->getStatus() == 1){
                    $status = 'concluído';
                }

                $listPedido[$cont]->setStatus($status);

                //incrementando o contador
                $cont++;
            }

            //retornando os dados
            return $listPedido;
        }

        //função para listar as vendas concretizadas através de uma compra direta pelo brechó
        public function filtrarVenda($tipoCliente, $idCliente){
            //verificando o tipo de cliente
            if($tipoCliente == 'F'){
                //instância da classe ClienteFisicoDAO
                $clienteFisicoDAO = new ClienteFisicoDAO();

                //armazenando os dados em uma variável
                $listPedido = $clienteFisicoDAO->selectVenda($idCliente);
            }else{
                //instância da classe ClienteJuridicoDAO
                $clienteJuridicoDAO = new ClienteJuridicoDAO();

                //armazenando os dados em uma variável
                $listPedido = $clienteJuridicoDAO->selectVenda($idCliente);
            }

            //contador
            $cont = 0;

            //percorrendo os dados
            while($cont < count($listPedido)){
                //convertendo a data para o formato brasileiro
                $data = date('d/m/Y', strtotime($listPedido[$cont]->getDtPedido()));

                //setando a data formatada
                $listPedido[$cont]->setDtPedido($data);
                
                 if($listPedido[$cont]->getStatus() == 0){
                    $status = 'aguardando pagamento';
                }else if($listPedido[$cont]->getStatus() == 1){
                    $status = 'concluído';
                }

                $listPedido[$cont]->setStatus($status);

                //armazenando o contador
                $cont++;
            }

            //retornando os dados
            return $listPedido;
        }
    }
?>