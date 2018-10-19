<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: controlar as ações da página de eventos
	*/

	class controllerEvento{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/eventoClass.php');
			require_once($diretorio.'model/dao/eventoDAO.php');
		}
		
		//função que lista os eventos
		public function listarEvento(){
			//instância da classe eventoDAO
			$eventoDAO = new EventoDAO();
			
			//armazenando os dados em uma variável
			$listEvento = $eventoDAO->selectAll();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($cont < count($listEvento)){
				//conversão da data para o padrão brasileiro
				$dataInicio = date('d/m/Y', strtotime($listEvento[$cont]->getDataInicio()));
				
				//conversão da data para o padrão brasileiro
				$dataTermino = date('d/m/Y', strtotime($listEvento[$cont]->getDataTermino()));
				
				//setando as datas
				$listEvento[$cont]->setDataInicio($dataInicio);
				$listEvento[$cont]->setDataTermino($dataTermino);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listEvento;
		}
	}
?>