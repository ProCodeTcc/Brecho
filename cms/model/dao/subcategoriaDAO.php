<?php
/*
    Projeto: CMS do Brechó
    Autor: Lucas Eduardo
    Data: 10/11/2018
    Objetivo: CRUD de subcategoria
*/
    class SubcategoriaDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        //função para inserir uma subcategoria
        public function Insert(Subcategoria $subcategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO subcategoria(nome, idCategoria) VALUES(?,?)');

            //parâmetros enviados
            $stm->bindParam(1, $subcategoria->getNome());
            $stm->bindParam(2, $subcategoria->getIdCategoria());

            //execução do statement
            $stm->execute();

            //verificando o retorno das linhas
            if($stm->rowCount() != 0){
                //armazenando mensagem de sucesso
                $status = array('status' => 'inserido');
            }else{
                //armazenando mensagem de erro
                $status = array('status' => 'erro');
            }

            //retornando o status em JSON
            return json_encode($status);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para listar as subcategorias de uma categoria
        public function selectAll($idCategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT * FROM subcategoria WHERE idCategoria = ?');

            //parâmetro enviado
            $stm->bindParam(1, $idCategoria);

            //execução do statement
            $stm->execute();

            //contador
            $cont = 0;

            //percorrendo os dados
            while($rsSubcategoria = $stm->fetch(PDO::FETCH_OBJ)){
                //instância da classe Subcategoria
                $listSubcategoria[] = new Subcategoria();
                
                //setando os atributos
                $listSubcategoria[$cont]->setId($rsSubcategoria->idSubcategoria);
                $listSubcategoria[$cont]->setNome($rsSubcategoria->nome);

                //incrementando o contador
                $cont++;
            }

            //verifica os resultados
            if($cont != 0){
                //retorna os dados
                return $listSubcategoria;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para buscar uma subcategoria
        public function selectByID($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT * FROM subcategoria WHERE idSubcategoria = ?');

            //parâmetros enviados
            $stm->bindParam(1, $id);

            //execução do statement
            $stm->execute();

            //armazenando os dados em uma variável
            $listSubcategoria = $stm->fetch(PDO::FETCH_OBJ);

            //retornando os dados em JSON
            return json_encode($listSubcategoria);

            //fechando ao conexão
            $conexao->fecharConexao();
        }

        //função para atualizar a subcategoria
        public function Update(Subcategoria $subcategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que atualiza os dados
            $stm = $PDO_conexao->prepare('UPDATE subcategoria SET nome = ? WHERE idSubcategoria = ?');

            //parâmetros enviados
            $stm->bindParam(1, $subcategoria->getNome());
            $stm->bindParam(2, $subcategoria->getId());

            //verificando a execução do statement
            if($stm->execute()){
                //armazenando o status de sucesso
                $status = array('status' => 'atualizado');
            }else{
                //armazenando o status de fracasso
                $status = array('status' => 'erro');
            }

            //retornando os dados em JSON
            return json_encode($status);

            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>