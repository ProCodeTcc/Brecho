<?php

    class FaleConoscoDAO{
    
        public function __construct(){
            require_once('bdClass.php');
        }
        
        public function Insert(FaleConosco $fale){
        
            //instancia da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //Criando um statement e preparando  a querry que irá inserir os dados no banco.
            $stm = $PDO_conexao->prepare("insert into faleconosco (nomePessoa,email,telefone,sexo,assunto,comentario) values (?, ?, ?, ?, ?, ?)");
            
            $stm->bindParam(1, $fale->getNomePessoa());
            $stm->bindParam(2, $fale->getEmail());
            $stm->bindParam(3, $fale->getTelefone());
            $stm->bindParam(4, $fale->getSexo());
            $stm->bindParam(5, $fale->getAssunto());
            $stm->bindParam(6, $fale->getComentario());
            
            if($stm->execute()){
                header("location:index.php");
            }else{
                echo("Erro ao enviar");   
            }
        }
    }
?>