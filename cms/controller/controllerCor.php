<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 04/10/2018
        Objetivo: controlar as ações da página de cores

    */

	class controllerCor{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'/model/corClass.php');
			require_once($diretorio.'/model/dao/corDAO.php');
		}
		
		//função que insere uma cor
		public function inserirCor(){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
			}
			
			//instância da clase cor
			$corClass = new Cor();
			
			//setando os atributos
			$corClass->setNome($nome);
			$corClass->setCor($cor);
			
			//instância da classe CorDAO
			$corDAO = new CorDAO();
			
			//chamada da função que insere uma cor
			$corDAO->Insert($corClass);
		}
		
		//chamada da função que atualiza uma cor
		public function atualizarCor(){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
				$id = $_POST['id'];
			}
			
			//instância da classe Cor
			$corClass = new Cor();
			
			//setando os atributos
			$corClass->setId($id);
			$corClass->setNome($nome);
			$corClass->setCor($cor);
			
			//instância da classe CorDAO
			$corDAO = new CorDAO();
			
			//chamada da função que atualiza a cor
			$corDAO->Update($corClass);
		}
		
		//função que lista as cores
		public function listarCor(){
			//instância da classe CorDAO
			$corDAO = new CorDAO();
			
			//armazenando o retorno da cor em uma variável
			$listCor = $corDAO->selectAll();
			
			//retornando a lista das cores
			return $listCor;
		}
		
		//função que busca uma cor através do ID
		public function buscarCor($id){
			//instância da classe CorDAO
			$corDAO = new CorDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listCor = $corDAO->SelectByID($id);
			
			//retornando os dados
			return $listCor;
		}
		
		//função que exclui uma cor
		public function excluirCor($id){
			//instância da classe CorDAO
			$corDAO = new CorDAO();
			
			//chamada da função que exclui uma cor
			$corDAO->Delete($id);
		}
	}
?>