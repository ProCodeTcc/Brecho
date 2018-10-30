<?php
    /*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 26/10/2018
        Objetivo: Implementado função que gera uma consignação
        
        Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 30/10/2018
		Objetivo: ???? 
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
                //mensagem de sucesso
                echo('Consignação efetuada com sucesso!!');
            }else{
                //mensagem de erro
                echo('Erro CON-3: Ocorreu um erro ao relacionar o produto com a consignação');
            }
        
            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para pegar os produtos do banco
        public function selectAll(){
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

        selectConsignacao($idConsignacao){
            $conexao = new ConexaoMySQL();

            $PDO_conexao = $conexao->conectarBanco();

            $stm = $PDO_conexao->prepare('SELECT c.*, pc.percentualLoja as percentual FROM pedidoconsignacao AS c INNER JOIN produto_consignacao AS pc ON pc.idConsignacao = ?');

            $stm->bindParam(1, $idConsignacao);

            $stm->execute();

            $listConsignacao = $stm->fetch(PDO::FETCH_OBJ);

            return json_encode($listConsignacao);

            $conexao->fecharConexao();
        }
    }
?>