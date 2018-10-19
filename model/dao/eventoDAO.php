<?php

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: listagem dos eventos
	*/

    class EventoDAO{
        
        public function __construct(){
            require_once('bdClass.php');
        }
        
		//função que busca os eventos do banco
        public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT e.*, en.* FROM evento as e INNER JOIN evento_nossaloja as en ON en.idEvento = e.idEvento WHERE status = 1';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsEvento = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo evento
				$listEvento[] = new Evento();
				
				//setando os atributos
				$listEvento[$cont]->setNomeEvento($rsEvento->nomeEvento);
				$listEvento[$cont]->setDescricaoEvento($rsEvento->descricaoEvento);
				$listEvento[$cont]->setImagemEvento($rsEvento->imagemEvento);
				$listEvento[$cont]->setDataInicio($rsEvento->dataInicio);
				$listEvento[$cont]->setDataTermino($rsEvento->dataFim);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listEvento;
		
		}
    }

?>