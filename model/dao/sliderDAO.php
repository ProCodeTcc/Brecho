<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 19/10/2018
		Objetivo: implementação da função que traz as imagens do slider
	*/

	class SliderDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que realiza uma consulta no banco
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT * FROM slider WHERE status = 1';
			
			//armazenando o retorno dos dados numa variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsSlider = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo slider
				$listSlider[] = new Slider();
				
				//setando atributo
				$listSlider[$cont]->setImagem($rsSlider->caminhoImagem);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listSlider;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>