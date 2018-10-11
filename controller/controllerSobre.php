<?php
	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 09/10/2018
        Objetivo: controlar as ações da página sobre

    */

	class controllerSobre{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/sobreClass.php');
			require_once($diretorio.'/model/dao/sobreDAO.php');
		}
		
		//função que lista o layout 1
		public function listarLayout(){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listLayout = $sobreDAO->selectLayout();
			
			//retornando o layout
			return $listLayout;
		}
		
		//função que lista o layout 2
		public function listarLayout2(){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listSobre = $sobreDAO->selectLayout2();
			
			//retornando o layout
			return $listSobre;
		}
	}
?>