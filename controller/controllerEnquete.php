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

		//função que realiza uma consulta no banco
        public function selecionarEnquete($idioma){
			//instância da classe enqueteDAO
            $enqueteDAO = new EnqueteDAO();
			
            //verificando o idioma
			if($idioma == 'ptbr'){
                //armazenando o resultado da consulta na variável
                $enquete = $enqueteDAO->Select();
            }else{
                //armazenando o resultado da consulta na variável
                $enquete = $enqueteDAO->selectTranslate();
            }

			//retornando os dados
            return $enquete;
        }
		
		
		//função que atualiza a quantidade de respostas
		//da alternativa A
		public function atualizarQtdA(){
			//instância da classe enqueteDAO
			$enqueteDAO = new EnqueteDAO();
			
			//chamada da função que atualiza uma enquete
			$status = $enqueteDAO->UpdateQtdA();
            
            return $status;
		}
		
		//função que atualiza a quantidade de respostas
		//da alternativa B
		public function atualizarQtdB(){
			//instância da classe enqueteDAO
			$enqueteDAO = new EnqueteDAO();
			
			//chamada da função que atualiza uma enquete
			$status = $enqueteDAO->UpdateQtdB();
            
            return $status;
		}
		
		//função que atualiza a quantidade de respostas
		//da alternativa C
		public function atualizarQtdC(){
			//instância da classe enqueteDAO
			$enqueteDAO = new EnqueteDAO();
			
			//chamada da função que atualiza uma enquete
			$status = $enqueteDAO->UpdateQtdC();
            
            return $status;
		}
		
		//função que atualiza a quantidade de respostas
		//da alternativa D
		public function atualizarQtdD(){
			//instância da classe enqueteDAO
			$enqueteDAO = new EnqueteDAO();
			
			//chamada da função que atualiza uma enquete
			$status = $enqueteDAO->UpdateQtdD();
            
            return $status;
		}
		
		
    }
?>