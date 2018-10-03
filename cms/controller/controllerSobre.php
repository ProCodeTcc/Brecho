<?php
	class controllerSobre{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/sobreClass.php');
			require_once($diretorio.'model/dao/sobreDAO.php');
		}
		
		public function inserirLayout(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$imagem = $_POST['txtimagem'];
			}
			
			$sobreClass = new Sobre();
			$sobreClass->setTitulo($titulo);
			$sobreClass->setDescricao($descricao);
			$sobreClass->setImagem($imagem);
			
			$sobreDAO = new SobreDAO();
			
			$sobreDAO->Insert($sobreClass);
		}
		
		public function listarLayout1(){
			$sobreDAO = new SobreDAO();
			
			$listLayout = $sobreDAO->selectAllLayout1();
			
			return $listLayout;
		}
	}
?>