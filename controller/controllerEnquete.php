<?php
    /*
        Projeto: Brechó
        Autor:  Felipe Monteiro
        Data: 01/10/2018
        Objetivo: controlar as ações da página de enquetes

    */

    class controllerEnquete{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'/model/enqueteClass.php');
            require_once($diretorio.'/model/dao/enqueteDAO.php');
        }


        public function selecionarEnquete(){
            $enqueteDAO = new EnqueteDAO();
            $enquete = $enqueteDAO->Select();

            return $enquete;
        }
		
		public function atualizarQtdA(){
			$enqueteDAO = new EnqueteDAO();
			$enqueteDAO->UpdateQtdA();
		}
		
		public function atualizarQtdB(){
			$enqueteDAO = new EnqueteDAO();
			$enqueteDAO->UpdateQtdB();
		}
		
		public function atualizarQtdC(){
			$enqueteDAO = new EnqueteDAO();
			$enqueteDAO->UpdateQtdC();
		}
		
		public function atualizarQtdD(){
			$enqueteDAO = new EnqueteDAO();
			$enqueteDAO->UpdateQtdD();
		}
		
		
    }
?>