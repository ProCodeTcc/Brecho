<?php
    /*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 25/11/2018
        Objetivo: Implementado CRUD de marcas
    */

    class MarcaDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        
        //função para inserir a marca
        public function Insert(Marca $marca){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que insere os dados
            $stm = $PDO_conexao->prepare('INSERT INTO marca (nomeMarca) VALUES(?)');
            
            //parâmetro enviado
            $stm->bindParam(1, $marca->getNome());
            
            //execução do statement
            $stm->execute();
            
            //verificando as linhas
            if($stm->rowCount() != 0){
                //atualizando o status para sucesso
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
        
        //função para atualizar a marca
        public function Update(Marca $marca){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que atualiza os dados
            $stm = $PDO_conexao->prepare('UPDATE marca SET nomeMarca = ? WHERE idMarca = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $marca->getNome());
            $stm->bindParam(2, $marca->getId());
            
            //verificando a execução
            if($stm->execute()){
                //atualizando o status para sucesso
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
        
        //função para pegar uma marca pelo ID
        public function selectByID($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT * FROM marca WHERE idMarca = ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //criando uma nova marca
            $listMarca = new Marca();
            
            //armazenando os dados em uma variável
            $listMarca = $stm->fetch(PDO::FETCH_OBJ);
            
            //retornando os dados
            return json_encode($listMarca);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função para buscar as marcas
        public function selectAll(){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query para buscar os dados
            $sql = 'SELECT * FROM marca';
            
            //armazenando os dados em uma variável
            $resultado = $PDO_conexao->query($sql);
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($rsMarca = $resultado->fetch(PDO::FETCH_OBJ)){
                //criando uma nova Marca
                $listMarca[] = new Marca();

                //setando os atributos
                $listMarca[$cont]->setId($rsMarca->idMarca);
                $listMarca[$cont]->setNome($rsMarca->nomeMarca);
                
                //incrementando o contador
                $cont++;
            }
            
            //verificando os resultados
            if($cont != 0){
                //retornando os dados
                return $listMarca;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para deletar os dados do banco
        public function Delete($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que deleta os dados
            $stm = $PDO_conexao->prepare('DELETE FROM marca WHERE idMarca = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //verificando as linhas afetadas
            if($stm->rowCount() == 0){
                //atualizando o status para erro
                $status = array('status' => 'erro');
                
                //retornando o status em JSON
                return json_encode($status);
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para pesquisar a marca
        public function searchMarca($pesquisa){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT * FROM marca WHERE nomeMarca LIKE ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $pesquisa);
            
            //execução do statement
            $stm->execute();
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($rsMarca = $stm->fetch(PDO::FETCH_OBJ)){
                //criando uma nova marca
                $listMarca[] = new Marca();
                
                //setando os atributos
                $listMarca[$cont]->setId($rsMarca->idMarca);
                $listMarca[$cont]->setNome($rsMarca->nomeMarca);
                
                //incrementando o contador
                $cont++;
            }
            
            if($cont != 0){
                //retornando os dados
                return $listMarca;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>