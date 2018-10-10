<?php
	class TemaDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que trás todos os temas
		public function selectTema(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL;
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//buscando todos os temas do banco onde o status for = 1;
			$sql = 'SELECT corTema FROM temaSite WHERE status = 1';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//armazenando os temas em uma variável
			$rsTema =  $resultado->fetch(PDO::FETCH_OBJ);
			
			//criando um novo tema
			$listTema = new Tema();
			
			//setando o atributo
			$listTema->setCor($rsTema->corTema);
			
			//retornando a lista com os temas
			return $listTema;
		}
	}
?>