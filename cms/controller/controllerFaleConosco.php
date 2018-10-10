<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 02/10/2018
        Objetivo: controlar as ações da página fale conosco

    */

	class controllerFaleConosco{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
			require_once($diretorio.'/model/faleConoscoClass.php');
        	require_once($diretorio.'/model/dao/faleConoscoDAO.php');
		}
		
		//função que lista todos os feedbacks enviados
		public function listarFeedback(){
			//instância da classe FaleConoscoDAO
			$fconoscoDAO = new FaleConoscoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listFeedback = $fconoscoDAO->selectAll();
			
			//retornando os dados
			return $listFeedback;
		}
		
		//função que busca um feedback a partir de um id
		public function buscarFeedback($id){
			//instância da classe FaleConoscoDAO
			$fconoscoDAO = new FaleConoscoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listFeedback = $fconoscoDAO->SelectByID($id);
			
			//retornando os dados
			return $listFeedback;
		}
		
		//função que exclui um feedback
		public function excluirFeedback($id){
			//instância da classe FaleConoscoDAO
			$fconoscoDAO = new FaleConoscoDAO();
			
			//chamada da função que exclui um feedback
			$fconoscoDAO->Delete($id);
		}
	}
?>