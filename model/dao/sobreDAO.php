<?php
	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 09/10/2018
        Objetivo: trazer os conteúdos da página sobre do banco

    */

	class SobreDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		public function selectLayout(){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//correção de acentos
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM sobre WHERE tipoLayout = 1 and status = 1';
			
			//armazenando o resultado numa variável
			$resultado = $PDO_conexao->query($sql);
			
			//armazenando os dados da página em uma variável
			$rsSobre = $resultado->fetch(PDO::FETCH_OBJ);
			
			//criando um novo sobre
			$listSobre = new Sobre();
			
			//setando os atributos
			$listSobre->setTitulo($rsSobre->titulo);
			$listSobre->setDescricao($rsSobre->descricao);
			$listSobre->setImagem($rsSobre->imagem);
			
			//retornando os dados
			return $listSobre;
			
		}
		
		public function selectLayout2(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//correção dos acentos
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que realiza a consulta do banco
			$sql = 'SELECT * FROM sobre WHERE tipoLayout = 2 and status = 1';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//armazenando os dados da página em uma variável
			$rsSobre = $resultado->fetch(PDO::FETCH_OBJ);
			
			//criando um novo sobre
			$listSobre = new Sobre();
			
			//setando os atributos
			$listSobre->setTitulo($rsSobre->titulo);
			$listSobre->setDescricao($rsSobre->descricao);
			$listSobre->setDescricao2($rsSobre->descricao2);
			$listSobre->setImagem($rsSobre->imagem);
			
			//retornando os dados
			return $listSobre;
		}
	}
?>