<?php
    /*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 26/10/2018
        Objetivo: Implementada função que gera uma consignação
        
        Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 30/10/2018
		Objetivo: Implementada função que atualiza a consignação
        
        Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 19/11/2018
		Objetivo: Implementada função que verifica a data da consignação
    */
    
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
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que relaciona uma consignação com um produto
        public function insertConsignacaoProduto($idProduto, $idConsignacao, $percentualLoja){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que realiza a insersão
            $stm = $PDO_conexao->prepare('INSERT INTO produto_consignacao(idProduto, idConsignacao, percentualLoja) VALUES(?,?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $idProduto);
            $stm->bindParam(2, $idConsignacao);
            $stm->bindParam(3, $percentualLoja);

            //execução do statement
            $stm->execute();

            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                $status = array('status' => 'sucesso');
            }else{
                //mensagem de erro
                $status = array('status' => 'erro');
            }
            
            return json_encode($status);
        
            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para pegar os produtos do banco
        public function selectProdutos(){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que faz a consulta
            $sql = 'SELECT p.*, pc.idConsignacao, f.caminhoImagem AS imagem FROM produto AS p INNER JOIN produto_fotoproduto AS pf ON pf.idProduto = p.idProduto
            INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN produto_consignacao AS pc ON pc.idProduto = p.idProduto 
            INNER JOIN pedidoconsignacao AS c ON c.idConsignacao = pc.idConsignacao GROUP BY p.idProduto';

            //armazenando os dados em uma variável
            $resultado = $PDO_conexao->query($sql);

            //contador
            $cont = 0;

            //percorrendo os dados
            while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
                //criando um novo produto
                $listProdutos[] = new Consignacao();

                //setando os atributos
                $listProdutos[$cont]->setId($rsProdutos->idConsignacao);
                $listProdutos[$cont]->setIdProduto($rsProdutos->idProduto);
                $listProdutos[$cont]->setImagem($rsProdutos->imagem);
                $listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
                $listProdutos[$cont]->setDescricao($rsProdutos->descricao);
                $listProdutos[$cont]->setPreco($rsProdutos->preco);
                $listProdutos[$cont]->setClassificacao($rsProdutos->classificacao);
                $listProdutos[$cont]->setMarca($rsProdutos->idMarca);
                $listProdutos[$cont]->setCategoria($rsProdutos->idCategoria);
                $listProdutos[$cont]->setCor($rsProdutos->idCor);
                $listProdutos[$cont]->setTamanho($rsProdutos->idTamanho);

                //incrementando o contador
                $cont++;
            }

            //retornando os produtos
            return $listProdutos;

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que seleciona os dados de uma consignação através do ID
        public function selectConsignacao($idConsignacao){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que realiza a consulta
            $stm = $PDO_conexao->prepare('SELECT c.*, pc.percentualLoja as percentual FROM pedidoconsignacao AS c INNER JOIN produto_consignacao AS pc 
            ON pc.idConsignacao = c.idConsignacao WHERE pc.idConsignacao = ?');

            //parâmetros enviados
            $stm->bindParam(1, $idConsignacao);

            //execução do statement
            $stm->execute();

            //armazenando os dados em uma variável
            $listConsignacao = $stm->fetch(PDO::FETCH_OBJ);

            //retornando os dados em JSON
            return json_encode($listConsignacao);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para atualizar uma consignação
        public function Update(Consignacao $consignacaoClass){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que atualiza os dados
            $stm = $PDO_conexao->prepare('UPDATE pedidoconsignacao AS p INNER JOIN produto_consignacao AS pc ON p.idConsignacao = pc.idConsignacao SET pc.percentualLoja = ?, 
            p.dataInicial = ?, p.dataFinal = ? WHERE pc.idConsignacao = ?');

            // $stm->bindParam(1, $consignacaoClass->getValor());
            $stm->bindParam(1, $consignacaoClass->getPercentual());
            $stm->bindParam(2, $consignacaoClass->getDtInicio());
            $stm->bindParam(3, $consignacaoClass->getDtTermino());
            $stm->bindParam(4, $consignacaoClass->getId());

            //verificando se deu certo
            if($stm->execute()){
                //retorna true se der certo
                $status = array('status' => 'atualizado');
            }else{
                //false se der erro
                $status = array('status' => 'erro');
            }
            
            return json_encode($status);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para pesquisar os produtos em consignação
        public function searchConsignacao($pesquisa){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT p.*, pc.idConsignacao, f.caminhoImagem AS imagem FROM produto AS p INNER JOIN produto_fotoproduto AS pf ON pf.idProduto = p.idProduto
            INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN produto_consignacao AS pc ON pc.idProduto = p.idProduto 
            INNER JOIN pedidoconsignacao AS c ON c.idConsignacao = pc.idConsignacao WHERE p.nomeProduto LIKE ? GROUP BY p.idProduto');

            //parâmetro enviado
            $stm->bindParam(1, $pesquisa);

            //execução do statement
            $stm->execute();

            //contador
            $cont = 0;

            //percorrendo os dados
            while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
                //instância da classe Consignacao
                $listProdutos[] = new Consignacao();

                //setando os atributos
                $listProdutos[$cont]->setId($rsProdutos->idConsignacao);
                $listProdutos[$cont]->setIdProduto($rsProdutos->idProduto);
                $listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
                $listProdutos[$cont]->setPreco($rsProdutos->preco);
                $listProdutos[$cont]->setImagem($rsProdutos->imagem);
                $listProdutos[$cont]->setStatus($rsProdutos->status);

                //incrementando o contador
                $cont++;
            }

            //verificando se há dados
            if($cont != 0){
                //se houver, retorna os dados
                return $listProdutos;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para pegar a data de termino da consignação
        public function selectDtConsignacao(){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT dataFinal, idConsignacao FROM pedidoconsignacao');
            
            //execução do statement
            $stm->execute();
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($rsConsignacao = $stm->fetch(PDO::FETCH_OBJ)){
                //criando uma nova consignação
                $listConsignacao[] = new Consignacao();
                
                //setando os atributos
                $listConsignacao[$cont]->setId($rsConsignacao->idConsignacao);
                $listConsignacao[$cont]->setDtTermino($rsConsignacao->dataFinal);
                
                //incrementando o contador
                $cont ++;
            }
            
            //verificando os dados
            if($cont != 0){
                //retornando a consignação
                return $listConsignacao;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para ativar a consignação
        public function enableConsignacao($dataAtual, $id){
            //instância da classe de conexão com o banco de dados
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza o status
            $stm = $PDO_conexao->prepare('UPDATE pedidoconsignacao SET idStatus = 1 WHERE dataFinal <> ? AND idConsignacao = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $dataAtual);
            $stm->bindParam(2, $id);
            
            //execução do statement
            $stm->execute();
            
            //fechando a consignação
            $conexao->fecharConexao();
        }
        
        //função para desabilitar a consignação
        public function disableConsignacao($dataAtual, $id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza o status
            $stm = $PDO_conexao->prepare('UPDATE pedidoconsignacao SET idStatus = 0 WHERE dataFinal = ? AND idConsignacao = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $dataAtual);
            $stm->bindParam(2, $id);
            
            //execução do statement
            $stm->execute();
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>