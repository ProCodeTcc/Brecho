<?php
    class ConsignacaoDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        //função para inserir uma consignação
        public function insertConsignacao(Consignacao $consignacao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que realiza a inserção
            $stm = $PDO_conexao->prepare('INSERT INTO pedidoconsignacao(valorConsignacao, dataInicial, dataFinal, idStatus) VALUES(?,?,?,1)');

            //parâmetros enviados
            $stm->bindParam(1, $consignacao->getValor());
            $stm->bindParam(2, $consignacao->getDtInicio());
            $stm->bindParam(3, $consignacao->getDtTermino());
            
            //execução do statement
            $stm->execute();

            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                //armazenando o ID inserido
                $idConsignacao = $PDO_conexao->lastInsertId();

                //retornando o ID
                return $idConsignacao;
            }else{
                //mensagem de erro
                echo('Erro CON-1: Ocorreu um erro ao realizar a consignação!!');
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para relacionar a consignação com o cliente fisico
        public function insertConsignacaoCF($idConsignacao, $idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que realiza a insersão
            $stm = $PDO_conexao->prepare('INSERT INTO pedidoconsignacao_clientefisico(idPedidoConsignacao, idClienteFisico) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idConsignacao);
            $stm->bindParam(2, $idCliente);

            //execução do statement
            $stm->execute();

            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                return true;
            }else{
                //mensagem de erro
                echo('Erro CON-2: Ocorreu um erro ao relacionar a consignação com o cliente!!');
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função pra relacionar a consignação com o cliente jurídico
        public function insertConsignacaoCJ($idConsignacao, $idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO pedidoconsignacao_clientejuridico(idPedidoConsignacao, idClienteJuridico) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idConsignacao);
            $stm->bindParam(2, $idCliente);

            //execução do statement
            $stm->execute();

            //verificando retorno das linhas
            if($stm->rowCount() != 0){
                return true;
            }else{
                //mensagem de erro
                echo('Erro CON-2: Ocorreu um erro ao relacionar a consignação com o cliente!!');
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que relaciona uma consignação com um produto
        public function insertConsignacaoProduto($idProduto, $idConsignacao, $percentualLoja, $percentualCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que realiza a insersão
            $stm = $PDO_conexao->prepare('INSERT INTO produto_consignacao(idProduto, idConsignacao, percentualLoja, percentualCliente) VALUES(?,?,?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idProduto);
            $stm->bindParam(2, $idConsignacao);
            $stm->bindParam(3, $percentualLoja);
            $stm->bindParam(4, $percentualCliente);

            //execução do statement
            $stm->execute();

            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                //mensagem de sucesso
                echo('Consignação efetuada com sucesso!!');
            }else{
                //mensagem de erro
                echo('Erro CON-3: Ocorreu um erro ao relacionar o produto com a consignação');
            }
        
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>