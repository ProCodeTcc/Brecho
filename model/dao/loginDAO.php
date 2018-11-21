<?php

    class LoginDAO{
        public function __construct(){
            require_once('bdClass.php');
        }   
        
        public function Select($usuario, $senha){
            
            //insert da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //Criando um statement e preparando a query para resgatar do banco.
            $stm = $PDO_conexao->prepare('select * from clientefisico where login = ? and senha = ?');
             
            //parâmetro enviado
			$stm->bindParam(1, $usuario);
			$stm->bindParam(2, $senha);
			
			//executando o statement
			$stm->execute();
			
			$listCliente = $stm->fetch(PDO::FETCH_OBJ);
			
			if($stm->rowCount() != 0){
				session_start();
				$_SESSION['login'] = true;
				$_SESSION['sexo'] = $listCliente->sexo;
				$_SESSION['idCliente'] = $listCliente->idCliente;
				$_SESSION['usuario'] = $listCliente->login;
				$_SESSION['tipoCliente'] = 'F';
                $_SESSION['atividade'] = time();
				$status = array('status' => 'sucesso');
			}else{
				$status = array('status' => 'incorreto');
			}

			//retornando o status
			return json_encode($status);
            
            $conexao->fecharConexao();
			
        }
		
		public function logarClienteJuridico($usuario, $senha){
            
            //insert da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //Criando um statement e preparando a query para resgatar do banco.
            $stm = $PDO_conexao->prepare('select * from clientejuridico where login = ? and senha = ?');
             
            //parâmetro enviado
			$stm->bindParam(1, $usuario);
			$stm->bindParam(2, $senha);
			
			//executando o statement
			$stm->execute();
			
			$listCliente = $stm->fetch(PDO::FETCH_OBJ);
			
			if($stm->rowCount() != 0){
				session_start();
				$_SESSION['login'] = true;
				$_SESSION['idCliente'] = $listCliente->idCliente;
				$_SESSION['usuario'] = $listCliente->login;
				$_SESSION['tipoCliente'] = 'J';
                $_SESSION['atividade'] = time();
				$status = array('status' => 'sucesso');
			}else{
				$status = array('status' => 'incorreto');
			}

			//retornando o status
			return json_encode($status);
            
            $conexao->fecharConexao();
			
        }
    }

?>