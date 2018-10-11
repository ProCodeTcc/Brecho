<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 04/10/2018
        Objetivo: controlar as ações da página sobre do site

    */

	class controllerSobre{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/sobreClass.php');
			require_once($diretorio.'model/imagemClass.php');
			require_once($diretorio.'model/dao/sobreDAO.php');
		}
		
		//função que insere um layout no site
		public function inserirLayout(){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$layout = $_POST['layout'];
				
				if(isset($_POST['txtdesc2'])){
					$descricao2 = $_POST['txtdesc2'];
				}
				
				if(!empty($_FILES['fleimagem'])){
					$imagemClass = new Imagem();
					$imagem = $imagemClass->uploadImagem();
				}
			}
			
			//criando um objeto sobre
			$sobre = new Sobre();
			
			//setando os atributos
			$sobre->setTitulo($titulo);
			$sobre->setDescricao($descricao);
			$sobre->setImagem($imagem);
			$sobre->setLayout($layout);
			
			if(isset($descricao2)){
				$sobre->setDescricao2($descricao2);
			}
			
			//instância da classe SobreDAO
			$sobreDAO = new SobreDAO();
			
			//verifica qual o layout que é pra ser inserido
			if($layout == 1){
				$sobreDAO->Insert($sobre);
			}else{
				$sobreDAO->InsertLayout2($sobre);
			}
		}
		
		//função que atualiza um layout
		public function atualizarLayout(){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$layout = $_POST['layout'];
				$id = $_POST['id'];
				
				if(isset($_POST['txtdesc2'])){
					$descricao2 = $_POST['txtdesc2'];
				}
				
				//verificando se o input de upload está vazio
				if($_FILES['fleimagem']['size'] == 0){
					//se estiver, mantém a imagem que já estava
					$imagem = $_POST['imagem'];
				}else{
					//se não, instancia a classe de imagem
					$imagemClass = new Imagem();
					
					//e faz o upload
					$imagem = $imagemClass->uploadImagem();
				}
				
			}
			
			//instância da classe Sobre
			$sobre = new Sobre();
	
			//setando os atributos
			$sobre->setId($id);
			$sobre->setTitulo($titulo);
			$sobre->setDescricao($descricao);
			$sobre->setImagem($imagem);
			
			if(isset($descricao2)){
				$sobre->setDescricao2($descricao2);
			}
			
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//verifica qual o layout que deve ser atualizado
			if($layout == 1){
				$sobreDAO->UpdateLayout1($sobre);
			}else{
				$sobreDAO->UpdateLayout2($sobre);
			}
		}
		
		//listar o layout 1
		public function listarLayout1(){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listLayout = $sobreDAO->SelectAllLayout1();
			
			//retornando a lista com o layout
			return $listLayout;
		}
		
		//busca um layout
		public function buscarLayout($id){			
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listLayout = $sobreDAO->SelectLayoutByID($id);
			
			//retornando a lista com o layout
			return $listLayout;
		}
		
		
		//listar o layout 2
		public function listarLayout2(){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listLayout2 = $sobreDAO->SelectAllLayout2();
			
			//retornando a lista com o layout
			return $listLayout2;
		}
		
		//função que exclui um layout
		public function excluirLayout($id){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//chamada da função que deleta um layout
			$sobreDAO->Delete($id);
		}
		
		//função que atualiza o status
		public function atualizarStatus($status, $id, $layout){
			//instância da classe sobreDAO
			$sobreDAO = new SobreDAO();
			
			//verifica qual o status ativo atualmente
			if($status == 1){
				//se for 1, chama a função que ativa um layout
				$sobreDAO->activateOne($id, $layout);
				
				//e desativa todos os outros
				$sobreDAO->disableAll($id, $layout);
			}else{
				//se for 1, chama a função que desativa todos os outros
				$sobreDAO->disableAll($id, $layout);
				
				//e ativa só um
				$sobreDAO->activateOne($id, $layout);
			}
		}
	}
?>