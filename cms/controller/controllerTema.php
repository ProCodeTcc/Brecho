<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 11/10/2018
        Objetivo: controlar as ações da página de temas

    */

	class controllerTema{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/temaClass.php');
			require_once($diretorio.'model/dao/temaDAO.php');
		}
		
		//função que insere um tema
		public function inserirTema(){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
				$genero = $_POST['txtgenero'];
			}
			
			//criando um novo tema
			$temaClass = new Tema();
			
			//setando os atributos
			$temaClass->setNome($nome);
			$temaClass->setCor($cor);
			$temaClass->setGenero($genero);
			
			//instância da classe TemaDAO
			$temaDAO = new TemaDAO();
			
			//chamada da função que insere o tema
			$temaDAO->Insert($temaClass);
		}
		
		//função que atualiza um tema
		public function atualizarTema($id){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$cor = $_POST['txtcor'];
				$genero = $_POST['txtgenero'];
			}
			
			//criando um novo tema
			$temaClass = new Tema();
			
			//setando os atributos
			$temaClass->setId($id);
			$temaClass->setNome($nome);
			$temaClass->setCor($cor);
			$temaClass->setGenero($genero);
			
			//instância da classe TemaDAO
			$temaDAO = new TemaDAO();
			
			//chamada da função que atualiza o tema
			$temaDAO->Update($temaClass);
		}
		
		//função que lista os temas
		public function listarTema(){
			//instância da classe TemaDAO
			$temaDAO = new TemaDAO();
			
			//armazenando os dados retornados numa variável
			$listTema = $temaDAO->selectTemas();
			
			//retornando os dados
			return $listTema;
		}
		
		//função que busca um tema
		public function buscarTema($id){
			//instância da classe TemaDAO
			$temaDAO = new TemaDAO();
			
			//armazenando a consulta numa variável
			$listTema = $temaDAO->selectByID($id);
			
			//retornando os dados
			return $listTema;
		}
		
		//função que exclui um tema
		public function excluirTema($id){
			//instância da classe TemaDAO
			$temaDAO = new TemaDAO();
			
			//chamada da função que exclui um tema
			$temaDAO->Delete($id);
		}
	}
?>