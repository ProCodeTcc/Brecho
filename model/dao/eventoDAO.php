<?php

    class EventoDAO{
        
        public function __construct(){
            require_once('bdClass.php');
        }
        
        public function Insert(Evento $evento){
            
            //Instancia da classe de conexão com o banco
            $coneao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = conexao->conectarBanco();
            
            //criando um statement e preparando a querry que irá inserir os dados no banco.
            $stm = $PDO_conexao->prepare('inser into evento(nomeEvento, descricaoEvento, imagemEvento, status) values(?,?,?,?)');
            
            $stm->bindParam(1, $evento->getNomeEvento());
            $stm->bindParam(2, $evento->getDescricaoEvento());
            $stm->bindParam(3, $evento->getImagemEvento());
            $stm->bindParam(4, $evento->getStatus());
            
            if($stm->execute()){
                header("location:index.php");
                $idEvento=$PDO_conexao->lastInsertId();
                return $idEvento;
                
            }else{
                echo('Erro ao Adicionar');
            }
        }
        
        public function
        InsertEvento($idEvento){
            //Instancia da classe de cinexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //criando um statement e preparando a querry que irá inserir os dados no banco.
            $stm = $PDO_conexao->prepare('insert into evento(idEvento)values(?)');
            
            $stm->bindParam(1, $idEvento);
            
            $stm->$execute();
        }
    }

?>