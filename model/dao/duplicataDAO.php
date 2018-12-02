<?php
    class DuplicataDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        
        //função para inserir uma duplicata a receber
        public function insertDuplicataReceber(Duplicata $duplicata){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO duplicatareceber(dataVencimento, dataRecebimento, valorReal, vencida, statusBaixa) VALUES(?,?,?,0,1)');
            
            //parâmetros enviados
            $stm->bindParam(1, $duplicata->getDtVencimento());
            $stm->bindParam(2, $duplicata->getDtPagamento());
            $stm->bindParam(3, $duplicata->getValor());
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() != 0){
                //armazenando o ID da duplicata
                $idDuplicata = $PDO_conexao->lastInsertId();
                
                //retornando o ID da duplicata
                return $idDuplicata;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para relacionar um pedido com uma duplicata a receber
        public function PedidoDuplicataReceber($idPedido, $idDuplicata){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO pedidovenda_duplicatareceber(idPedidoVenda, idDuplicataReceber) VALUES(?,?)');
            
            //parâmetros enviados
            $stm->bindParam(1, $idPedido);
            $stm->bindParam(2, $idDuplicata);
            
            //execução do statement
            $stm->execute();
            
            //verificando as linhas afetadas
            if($stm->rowCount() != 0){
                //atualizando o status pra sucesso
                $status = array('status' => 'sucesso');
            }else{
                //atualizando o status para erro
                $status = array('status' => 'erro');
            }
            
            //retornando os dados em JSON
            return json_encode($status);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para inserir uma duplicata a pagar
        public function insertDuplicataPagar(Duplicata $duplicata){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query para inserir uma duplicata a pagar
            $stm = $PDO_conexao->prepare('INSERT INTO duplicatapagar(dtPagamento, dtVencimento, valorReal, vencida, statusBaixa) VALUES(?,?,?,0,1)');
            
            //parâmetros enviados
            $stm->bindParam(1, $duplicata->getDtPagamento());
            $stm->bindParam(2, $duplicata->getDtVencimento());
            $stm->bindParam(3, $duplicata->getValor());
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() != 0){
                //armazenando o ID da duplicata
                $idDuplicata = $PDO_conexao->lastInsertId();
                
                //retornando o ID da duplicata
                return $idDuplicata;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para relacionar um pedido com a duplicata a pagar
        public function PedidoDuplicataPagar($idPedido, $idDuplicata){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO pedidovenda_duplicatapagar(idPedidoVenda, idDuplicataPagar) VALUES(?,?)');
            
            //parâmetros enviados
            $stm->bindParam(1, $idPedido);
            $stm->bindParam(2, $idDuplicata);
            
            //execução do statement
            $stm->execute();
            
            //verificando as linhas afetadas
            if($stm->rowCount() != 0){
                //atualizando o status pra sucesso
                $status = array('status' => 'sucesso');
            }else{
                //atualizando o status pra erro
                $status = array('status' => 'erro');
            }
            
            //retornando o status em JSON
            return json_encode($status);
            
            //fechando a conexçao
            $conexao->fecharConexao();
        }
    }
?>