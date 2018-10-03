<?php
	class controllerSobre{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/sobreClass.php');
			require_once($diretorio.'model/dao/sobreDAO.php');
		}
		
		public function inserirLayout1(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$imagem = $_POST['txtimagem'];
			}
			
			$layout = new Sobre();
			$layout->setTitulo($titulo);
			$layout->setDescricao($descricao);
			$layout->setImagem($imagem);
			
			$sobreDAO = new SobreDAO();
			
			$sobreDAO->Insert($layout);
		}
		
		public function atualizarLayout1(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$imagem = $_POST['txtimagem'];
				$id = $_POST['id'];
			}
			
			$layout = new Sobre();
			$layout->setId($id);
			$layout->setTitulo($titulo);
			$layout->setDescricao($descricao);
			$layout->setImagem($imagem);
			
			$sobreDAO = new SobreDAO();
			
			$sobreDAO->UpdateLayout($layout);
		}
		
		public function listarLayout1(){
			$sobreDAO = new SobreDAO();
			
			$listLayout = $sobreDAO->SelectAllLayout1();
			
			return $listLayout;
		}
		
		public function buscarLayout1($id){			
			$sobreDAO = new SobreDAO();
			
			$listLayout = $sobreDAO->SelectLayoutByID($id);
			
			return $listLayout;
		}
		
		public function inserirLayout2(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$descricao2 = $_POST['txtdesc2'];
				$imagem = $_POST['txtimagem'];
			}
			
			$sobreClass = new Sobre();
			$sobreClass->setTitulo($titulo);
			$sobreClass->setDescricao($descricao);
			$sobreClass->setDescricao2($descricao2);
			$sobreClass->setImagem($imagem);
			
			$sobreDAO = new SobreDAO();
			
			$sobreDAO->InsertLayout2($sobreClass);
		}
		
		public function listarLayout2(){
			$sobreDAO = new SobreDAO();
			
			$listLayout2 = $sobreDAO->SelectAllLayout2();
			
			return $listLayout2;
		}
	}
?>