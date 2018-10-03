<?php
	/*
        Projeto: Brechó
        Autor: Felipe Monteiro
        Data: 01/10/2018
        Objetivo: implementada função que resgata as alternativas do banco

    */

	/*
        Projeto: Brechó
        Autor:  Lucas Eduardo
        Data: 02/10/2018
        Objetivo: implementada função que atualiza a quantidade de repostas

    */

    class EnqueteDAO{
        
        public function __construct(){
        
            require_once('bdClass.php');
        
        }
        
         public function Select(){
            //instância da classe de conexão com o banco                  
            $conexao = new ConexaoMySQL();
			 
			//chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
			 
			//query que seleciona os dados do banco
            $stm = $PDO_conexao->prepare("select * from enquete where status = 1");
			 
			//executando o statement
            $stm->execute();
			
			//criando uma nova enquete
            $enquete = new Enquete();
			
			//colocando os dados na enquete
            $enquete = $stm->fetch(PDO::FETCH_OBJ);
			 
			//retornando a enquete com os dados
            return($enquete);
			
			//fechando a conexão
            $conexao->fecharConexao();
             
        }
		
		public function UpdateQtdA(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query para atualizar a quantidade de respostas
			$stm = $PDO_conexao->prepare('UPDATE enquete SET qtdAlternativaA = qtdAlternativaA + 1 WHERE status = 1');
			
			//execução do statement
			$stm->execute();
			
			
			if($stm->rowCount() == 1){
				echo('Obrigado pelo feedback! Sua opinião foi enviada para nossos administradores.');
			}else{
				echo('Ocorreu um erro ao enviar sua resposta');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function UpdateQtdB(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query para atualizar a quantidade de respostas
			$stm = $PDO_conexao->prepare('UPDATE enquete SET qtdAlternativaB = qtdAlternativaB + 1 WHERE status = 1');
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() == 1){
				echo('Obrigado pelo feedback! Sua opinião foi enviada para nossos administradores.');
			}else{
				echo('Ocorreu um erro ao enviar sua resposta');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function UpdateQtdC(){
			//instância da classe de coneção com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query para atualizar a quantidade de respostas
			$stm = $PDO_conexao->prepare('UPDATE enquete SET qtdAlternativaC = qtdAlternativaC + 1 WHERE status = 1');
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() == 1){
				echo('Obrigado pelo feedback! Sua opinião foi enviada para nossos administradores.');
			}else{
				echo('Ocorreu um erro ao enviar sua resposta');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
        public function UpdateQtdD(){
			//instância da classe de coneção com o banco
			$conexao = new conexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query para atualizar a quantidade de respostas
			$stm = $PDO_conexao->prepare('UPDATE enquete set qtdAlternativaD = qtdAlternativaD + 1 WHERE status = 1');
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() == 1){
				echo('Obrigado pelo feedback! Sua opinião foi enviada para nossos administradores.');
			}else{
				echo('Ocorreu um erro ao enviar sua resposta');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
    }

?>