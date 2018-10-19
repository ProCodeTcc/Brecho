<?php

	/*
		Projeto: Brechó
		Autor: Felipe Monteiro
		Data: 15/10/2018
		Objetivo: implementado cadastro de endereço
	*/

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 17/10/2018
		Objetivo: Implementado atualização de endereço
	*/

    class EnderecoDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        
        public function Insert(Endereco $endereco){
        
        //Instanciando a classe de conexão com o banco
            $conexao= new ConexaoMySQL();
            
            //chamando a função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //Criando um statement e preparando para inserir no banco
            $stm = $PDO_conexao->prepare('insert into endereco(logradouro,bairro,cidade,estado,numero,complemento,latitude,longitude,cep) values (?,?,?,?,?,?,?,?,?)');
            
            $stm->bindParam(1, $endereco->getLogradouro());
            $stm->bindParam(2, $endereco->getBairro());
            $stm->bindParam(3, $endereco->getCidade());
            $stm->bindParam(4, $endereco->getEstado());
            $stm->bindParam(5, $endereco->getNumero());
            $stm->bindParam(6, $endereco->getComplemento());
            $stm->bindParam(7, $endereco->getLatitude());
            $stm->bindParam(8, $endereco->getLongitude());
            $stm->bindParam(9, $endereco->getCep());
                        
            
            if($stm->execute()){
//                header("location:index.php");
                $idEndereco = $PDO_conexao->lastInsertId();
                return $idEndereco;
                
            }else{
                echo("Ocorreu um erro ao inserir os dados do endereço");   
            }
            
            $conexao->fecharConexao();
            
        }
		
		//função que atualiza os dados
		public function Update(Endereco $endereco){
			//instância da classe que conecta com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza o endereço
			$stm = $PDO_conexao->prepare('UPDATE endereco SET logradouro = ?, bairro = ?, cidade = ?, estado = ?, numero = ?, complemento = ?, cep = ?
			WHERE idEndereco = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $endereco->getLogradouro());
			$stm->bindParam(2, $endereco->getBairro());
			$stm->bindParam(3, $endereco->getCidade());
			$stm->bindParam(4, $endereco->getEstado());
			$stm->bindParam(5, $endereco->getNumero());
			$stm->bindParam(6, $endereco->getComplemento());
			$stm->bindParam(7, $endereco->getCep());
			$stm->bindParam(8, $endereco->getIdEndereco());
			
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
    
    }




?>