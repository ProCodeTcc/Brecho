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
		public function listarLayout($idioma){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
            //verificando o idioma
			if($idioma == 'ptbr'){
                //armazenando o retorno dos dados em uma variável
                $listLayout = $sobreDAO->selectLayout();
            }else{
                //armazenando o retorno dos dados em uma variável
                $listLayout = $sobreDAO->selectTranslate();
            }
			
			//retornando o layout
			return $listLayout;
		}
		
		//função que lista o layout 2
		public function listarLayout2($idioma){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
            //verificando o idioma
            if($idioma == 'ptbr'){
                //armazenando o retorno dos dados em uma variável
                $listSobre = $sobreDAO->selectLayout2();
            }else{
                $listSobre = $sobreDAO->selectTranslateLayout2();
            }
			//retornando o layout
			return $listSobre;
		}
	}
?>