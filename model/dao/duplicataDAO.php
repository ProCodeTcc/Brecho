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
            $stm = $PDO_conexao->prepare('INSERT INTO duplicatareceber(idPedidoVenda, dataVencimento, dataRecebimento, valorReal, vencida, statusBaixa) VALUES(?,?,?,?,0,1)');
            
            //parâmetros enviados
            $stm->bindParam(1, $duplicata->getIdPedido());
            $stm->bindParam(2, $duplicata->getDtVencimento());
            $stm->bindParam(3, $duplicata->getDtPagamento());
            $stm->bindParam(4, $duplicata->getValor());
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() != 0){
                //armazenando o status de sucesso
                $status = array('status' => 'sucesso');
            }else{
                //armazenando o status de erro
                $status = array('status' => 'erro');
            }
            
            //retornando o status em JSON
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
            $stm = $PDO_conexao->prepare('INSERT INTO duplicatapagar(dtPagamento, valorReal, vencida, statusBaixa) VALUES(?,?,0,1)');
            
            //parâmetros enviados
            $stm->bindParam(1, $duplicata->getDtPagamento());
//            $stm->bindParam(2, $duplicata->getDtVencimento());
            $stm->bindParam(2, $duplicata->getValor());
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                //atualizando o status para sucesso
                $status = array('status' => 'sucesso');
            }else{
                //atualizando o status para erro
                $status = array('status' => 'erro');
            }
            
            //retornando o status em JSON
            return json_encode($status);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>