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
            
            //parâmetros enviados
            $stm->bindParam(1, $fale->getNomePessoa());
            $stm->bindParam(2, $fale->getEmail());
            $stm->bindParam(3, $fale->getTelefone());
            $stm->bindParam(4, $fale->getSexo());
            $stm->bindParam(5, $fale->getAssunto());
            $stm->bindParam(6, $fale->getComentario());
            
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
            
            //retornando o status e JSON
            return json_encode($status);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
    }
?>