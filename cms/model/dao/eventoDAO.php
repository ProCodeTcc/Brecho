<?php
	class EventoDAO{
		public class __construct(){
			require_once("bdClass.php")
		}
		
		public function Insert(Evento $evento){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$stm = $PDO_conexao->prepare('INSERT INTO evento(nomeEvento, descricaoEvento, imagemEvento)');
		}
	}
?>