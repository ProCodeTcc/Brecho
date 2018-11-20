<?php
    /*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 05/11/2018
        Objetivo: Implementado CRUD de categorias
    */

    class CategoriaDAO{
        public function __construct(){
            require('bdClass.php');
        }

        //função que insere uma categoria
        public function Insert(Categoria $categoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que insere a categoria
            $stm = $PDO_conexao->prepare('INSERT INTO categoria(nomeCategoria) VALUES(?)');

            //parâmetros enviados
            $stm->bindParam(1, $categoria->getNome());

            //execução do statement
            $stm->execute();

            //verificando se foi inserido
            if($stm->rowCount() != 0){
                //armazenando a mensagem de sucesso
                $retorno = array('status' => 'sucesso');
            }else{
                //mensagem de erro
                $retorno = array('status' => 'erro');
            }

            //retornando os dados em JSON
            return json_encode($retorno);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que trás as categorias do banco
        public function selectAll(){
            //instância da classe de conexão do banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que faz a consulta
            $sql = 'SELECT * FROM categoria';

            //armazenando os dados em uma variável
            $resultado = $PDO_conexao->query($sql);

            //contador
            $cont = 0;

            //percorrendo os dados
            while($rsCategoria = $resultado->fetch(PDO::FETCH_OBJ)){
                //criando uma nova categoria
                $listCategoria[] = new Categoria();

                //setando os atributos
                $listCategoria[$cont]->setId($rsCategoria->idCategoria);
                $listCategoria[$cont]->setNome($rsCategoria->nomeCategoria);
                $listCategoria[$cont]->setStatus($rsCategoria->status);

                //incrementando o contador
                $cont++;
            }

            //retornando os dados
            return $listCategoria;

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que exclui a categoria
        public function Delete($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //chamada da função que exclui os dados
            $stm = $PDO_conexao->prepare('DELETE FROM categoria WHERE idCategoria = ?');

            //parâmetros enviados
            $stm->bindParam(1, $id);

            //execução do statement
            $stm->execute();

            //verificando se foi excluído
            if($stm->rowCount() != 0){
                //mensagem de sucesso
                $status = array('status' => 'sucesso');
            }else{
                //mensagem de erro
                $status = array('status' => 'erro');
            }

            //retornando o status
            return json_encode($status);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que trás uma categoria
        public function selectById($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT * FROM categoria WHERE idCategoria = ?');

            //parâmetro enviado
            $stm->bindValue(1, $id, PDO::PARAM_INT);

            //execução do statement
            $stm->execute();

            //armazenando o retorno dos dados
            $listCategoria = $stm->fetch(PDO::FETCH_OBJ);

            //retornando os dados em JSON
            return json_encode($listCategoria);

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para atualizar uma categoria
        public function Update(Categoria $categoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que atualiza os dados
            $stm = $PDO_conexao->prepare('UPDATE categoria SET nomeCategoria = ? WHERE idCategoria = ?');

            //parâmetros enviados
            $stm->bindParam(1, $categoria->getNome());
            $stm->bindParam(2, $categoria->getId());

            //verificando se foi executado
            if($stm->execute()){
                //armazenando a mensagem de sucesso em uma variável
                $retorno = array('status' => 'atualizado');

                //retornando a msg em JSON
                return json_encode($retorno);
            }else{
                //armazenando a mensagem de erro em uma variável
                $retorno = array('status' => 'erro');

                //retornando a msg em JSON
                return json_encode($retorno);
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que atualiza o status
        public function updateStatus($status, $id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //verificando o status
            if($status == 1){
                //se for 1, muda pra 0
                $stm = $PDO_conexao->prepare('UPDATE categoria SET status = 0 WHERE idCategoria = ?');
            }else{
                //se for 0, muda pra 1
                $stm = $PDO_conexao->prepare('UPDATE categoria SET status = 1 WHERE idCategoria = ?');
            }

            //parâmetros enviados
            $stm->bindParam(1, $id);

            //execução do statement
            $stm->execute();

            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função que verifica o status
        public function checkStatus(){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT count(status) as ativos FROM categoria WHERE status = 1');

            //executando o statement
            $stm->execute();

            //verifica o retorno
            if($stm->rowCount() != 0){
                //armazena o número de ativos numa variável
                $listStatus = $stm->fetch(PDO::FETCH_OBJ);

                //retorna os status
                return $listStatus;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>