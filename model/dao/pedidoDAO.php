<?php
    /*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 25/10/2018
		Objetivo: implementada funcionalidade de gerar o pedido
	*/

    class PedidoDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        //função que insere o pedido
        public function Insert(Pedido $pedido){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO pedidovenda(dataPedidoVenda, valorPedidoVenda) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $pedido->getDtPedido());
            $stm->bindParam(2, $pedido->getValor());

            //execução do statement
            $stm->execute();
            
            //verificando retorno das linhas
            if($stm->rowCount() != 0){
                //armazenando o ID do pedido
                $idPedido = $PDO_conexao->lastInsertId();

                //retornando o ID do pedido
                return $idPedido;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que insere o ID do pedido e do produto na tabela de relacionamento
        public function insertPedidoProduto($idPedido, $idProduto){
            //insancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO pedidovenda_produto(idPedidoVenda, idProduto) VALUES(?,?)');


            //parâmetros enviados
            $stm->bindParam(1, $idPedido);
            $stm->bindParam(2, $idProduto);

            //execução do statement
            $stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que insere relaciona o cliente fisico e o pedido
        public function insertPedidoFisico($idPedido, $idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO clientefisico_pedidovenda(idClienteFisico, idPedidoVenda) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            $stm->bindParam(2, $idPedido);

            //execução do statement
            $stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>