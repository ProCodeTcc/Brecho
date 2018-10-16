<?php

    class LoginDAO{
        public function __construct(){
            require_once('bdClass.php');
        }   
        
        public function Select($login){
            
            //insert da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //Criando um statement e preparando a query para resgatar do banco.
            $stm = $PDO_conexao->prepare('select * from clientefisico where login = ? and senha = ?');
             
            //parâmetro enviado
			$stm->bindValue(1, $login, PDO::PARAM_STR);
			$stm->bindValue(2, $login, PDO::PARAM_STR);
            
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$rsConta= $stm->fetch(PDO::FETCH_OBJ);
			            
			$listLogin = new Login();
            
//			//setando os atributos
			$listLogin->setIdCliente($rsConta->idCliente);
			$listLogin->setNome($rsConta->nome);
			$listLogin->setLogin($rsConta->login);
			$listLogin->setSenha($rsConta->senha);
			
			//retornando a lista
			return $listLogin;
            
            $conexao->fecharConexao();
			
        }
    }

?>