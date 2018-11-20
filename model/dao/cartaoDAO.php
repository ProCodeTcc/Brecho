<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 16/11/2018
		Objetivo: CRUD do cartão
	*/

    /*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 18/11/2018
		Objetivo: Implementada funções que verificam o cartão de crédito
	*/

    class CartaoDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        
        //função para adicionar um cartão
        public function Insert(Cartao $cartao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO cartaocredito(numeroCartao, nomeTitular, vencimento, codseguranca) VALUES(?,?,?,?)');
            
            //parâmetros enviados
            $stm->bindParam(1, $cartao->getNumero());
            $stm->bindParam(2, $cartao->getTitular());
            $stm->bindParam(3, $cartao->getVencimento());
            $stm->bindParam(4, $cartao->getCodigo());
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() != 0){
                //armazenando o ID do cartão em uma variável
                $id = $PDO_conexao->lastInsertId();
                
                //retornando o ID
                return $id;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para relacionar o cartão ao cliente físico
        public function insertCartaoCF($idCliente, $idCartao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO clientefisico_cartao(idClienteFisico, idCartao) VALUES(?,?)');
            
            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            $stm->bindParam(2, $idCartao);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
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
        
        //função para relacionar o cartão ao cliente juridico
        public function insertCartaoCJ($idCliente, $idCartao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO clientejuridico_cartao(idClienteJuridico, idCartao) VALUES(?,?)');
            
            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            $stm->bindParam(2, $idCartao);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
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
        
        //função para pegar os cartões de um cliente físico
        public function selectAllCF($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT * FROM cartaocredito as c INNER JOIN clientefisico_cartao AS cc ON c.idCartao = cc.idCartao WHERE cc.idClienteFisico = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($rsCartao = $stm->fetch(PDO::FETCH_OBJ)){
                //criando um novo cartão
                $listCartao[] = new Cartao();
                
                //setando os atributos
                $listCartao[$cont]->setId($rsCartao->idCartao);
                $listCartao[$cont]->setTitular($rsCartao->nomeTitular);
                $listCartao[$cont]->setNumero($rsCartao->numeroCartao);
                $listCartao[$cont]->setCodigo($rsCartao->codseguranca);
                $listCartao[$cont]->setVencimento($rsCartao->vencimento);
                $listCartao[$cont]->setStatus($rsCartao->status);
                
                //incrementando o contador
                $cont++;
            }
            
            //verificando o retorno
            if($cont != 0){
                //retornando as dados
                return $listCartao;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para pegar os cartões de um cliente físico
        public function selectAllCJ($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT * FROM cartaocredito as c INNER JOIN clientejuridico_cartao AS cc ON c.idCartao = cc.idCartao WHERE cc.idClienteJuridico = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($rsCartao = $stm->fetch(PDO::FETCH_OBJ)){
                //criando um novo cartão
                $listCartao[] = new Cartao();
                
                //setando os atributos
                $listCartao[$cont]->setId($rsCartao->idCartao);
                $listCartao[$cont]->setTitular($rsCartao->nomeTitular);
                $listCartao[$cont]->setNumero($rsCartao->numeroCartao);
                $listCartao[$cont]->setCodigo($rsCartao->codseguranca);
                $listCartao[$cont]->setVencimento($rsCartao->vencimento);
                $listCartao[$cont]->setStatus($rsCartao->status);
                
                //incrementando o contador
                $cont++;
            }
            
            //verificando o retorno
            if($cont != 0){
                //retornando as dados
                return $listCartao;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para buscar um cartão 
        public function selectByID($id){
            //instância da classe de conexão com o banco 
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT * FROM cartaocredito WHERE idCartao = ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //armazenando os dados em uma variável
            $listCartao = $stm->fetch(PDO::FETCH_OBJ);
            
            //retornando os dados em JSON
            return json_encode($listCartao);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para atualizar o cartão
        public function Update(Cartao $cartao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza os dados
            $stm = $PDO_conexao->prepare('UPDATE cartaocredito SET numeroCartao = ?, nomeTitular = ?, vencimento = ?, codseguranca = ? WHERE idCartao = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $cartao->getNumero());
            $stm->bindParam(2, $cartao->getTitular());
            $stm->bindParam(3, $cartao->getVencimento());
            $stm->bindParam(4, $cartao->getCodigo());
            $stm->bindParam(5, $cartao->getId());
            
            //verificando a execução
            if($stm->execute()){
                //atualizando o status para atualizado
                $status = array('status' => 'atualizado');
            }else{
                //atualizando o status para erro
                $status = array('status' => 'erro');
            }
            
            //retornando os dados em JSON
            return json_encode($status);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para deletar um cartão
        public function Delete($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da classe de conexão com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que excluir os dados
            $stm = $PDO_conexao->prepare('DELETE FROM cartaocredaito WHERE idCartao = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() == 0){
                //atualizando o status para erro
                $status = array('status' => 'erro');
                
                //retornando os dados em JSON
                return json_encode($status);
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para ativar apenas um cartão
        public function activateOne($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza o status
            $stm = $PDO_conexao->prepare('UPDATE cartaocredito SET status = 1 WHERE idCartao = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para desativar todos os status, exceto o que será ativo
        public function disableAll($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza status
            $stm = $PDO_conexao->prepare('UPDATE cartaocredito SET status = 0 WHERE idCartao <> ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para verificar o cartão do cliente fisico
        public function checkCartaoCF($idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT cc.idCartao from cartaocredito as cc INNER JOIN clientefisico_cartao as cf ON cf.idCartao = cc.idCartao WHERE status = 1 AND cf.idClienteFisico = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                //atualizando o status para ativo
                $status = array('status' => 'ativo');
            }else{
                //atualizando o status para desativado
                $status = array('status' => 'desativado');
            }
            
            //retornando o status em JSON
            return json_encode($status);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para selecionar o cartão ativo do cliente fisico
        public function selectAtivoCF($idCliente){
            //instância da classe de conexão com o banco de dados
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT c.* FROM cartaocredito AS c INNER JOIN clientefisico_cartao AS cf ON c.idCartao = cf.idCartao WHERE cf.idClienteFisico = ? AND status = 1');
            
            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            
            //execução do statement
            $stm->execute();
            
            //verifiando o retorno
            if($stm->rowCount() != 0){
                //armazenando os dados em uma variável
                $listCartao = $stm->fetch(PDO::FETCH_OBJ);
                
                //retornando os dados em JSON
                return json_encode($listCartao);
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para verificar o cartão do cliente fisico
        public function checkCartaoCJ($idCliente){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT cc.idCartao from cartaocredito as cc INNER JOIN clientejuridico_cartao as cf ON cf.idCartao = cc.idCartao WHERE status = 1 AND cf.idClienteJuridico = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                //atualizando o status para ativo
                $status = array('status' => 'ativo');
            }else{
                //atualizando o status para desativado
                $status = array('status' => 'desativado');
            }
            
            //retornando o status em JSON
            return json_encode($status);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para selecionar o cartão ativo do cliente juridico
        public function selectAtivoCJ($idCliente){
            //instância da classe de conexão com o banco de dados
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT c.* FROM cartaocredito AS c INNER JOIN clientejuridico_cartao AS cf ON c.idCartao = cf.idCartao WHERE cf.idClienteJuridico = ? AND status = 1');
            
            //parâmetros enviados
            $stm->bindParam(1, $idCliente);
            
            //execução do statement
            $stm->execute();
            
            //verifiando o retorno
            if($stm->rowCount() != 0){
                //armazenando os dados em uma variável
                $listCartao = $stm->fetch(PDO::FETCH_OBJ);
                
                //retornando os dados em JSON
                return json_encode($listCartao);
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>