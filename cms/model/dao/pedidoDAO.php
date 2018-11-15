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

        //função para gerar um pedido de compra
        public function insertPedidoCompra(Pedido $pedido){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO pedidocompra(valorPedido, data) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $pedido->getValor());
            $stm->bindParam(2, $pedido->getDtPedido());

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

        //função que relaciona um pedido de compra ao cliente físico
        public function insertPedidoCompraCF($idPedido, $idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO clientefisico_pedidocompra(idPedidoCompra, idClienteFisico) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idPedido);
            $stm->bindParam(2, $idCliente);

            //execução do statement
            $stm->execute();

            //verificando retorno das linhas
            if($stm->rowCount() != 0){
                return true;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que relaciona um peido de compra com o cliente jurídico
        public function insertPedidoCompraCJ($idPedido, $idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO clientejuridico_pedidocompra(idPedidoCompra, idClienteJuridico) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idPedido);
            $stm->bindParam(2, $idCliente);

            //execução do statement
            $stm->execute();

            //verificando retorno das linha
            if($stm->rowCount() != 0){
                return true;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que relaciona um produto com um pedido
        public function insertCompraProduto($idProduto, $idPedido){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamda da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO produto_pedidocompra(idProduto, idPedidoCompra) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idProduto);
            $stm->bindParam(2, $idPedido);

            //execução do statement
            $stm->execute();

            //verifiando retorno das linhas
            if($stm->rowCount() != 0){
                //mensagem de sucesso
                $status = array('status' => 'sucesso');
            }else{
                //mensagem de erro
                $status = array('status' => 'erro');
            }
            
            return json_encode($status);

            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>