<?php
    class ConsignacaoDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        
        //função para verificar se o produto está em consignação
        public function checkConsignacao($idProduto){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que trás os dados
            $stm = $PDO_conexao->prepare('SELECT idConsignacao FROM produto_consignacao WHERE idProduto = ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $idProduto);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() != 0){
                $rsConsignacao = $stm->fetch(PDO::FETCH_OBJ);
                $idConsignacao = $rsConsignacao->idConsignacao;
                
                //retornando os dados
                return $idConsignacao;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para pegar o valor da consignação
        public function getValor($idConsignacao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que trás o valor da consignação
            $stm = $PDO_conexao->prepare('SELECT valorConsignacao FROM pedidoconsignacao WHERE idConsignacao = ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $idConsignacao);
            
            //execução do statement
            $stm->execute();
            
            //verificando se há resultados
            if($stm->rowCount() != 0){
                $rsConsignacao = $stm->fetch(PDO::FETCH_OBJ);
                $valor = $rsConsignacao->valorConsignacao;
                
                //retornando os dados
                return $valor;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para atualizar o status da consignação
        public function updateStatus($idConsignacao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza o status
            $stm = $PDO_conexao->prepare('UPDATE pedidoconsignacao SET idStatus = 3 WHERE idConsignacao = ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $idConsignacao);
            
            //execução do statement
            $stm->execute();
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>