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
				$layout = $_POST['layout'];
				
				if(isset($_POST['txtdesc2'])){
					$descricao2 = $_POST['txtdesc2'];
				}
			}
			
			$sobre = new Sobre();
			$sobre->setTitulo($titulo);
			$sobre->setDescricao($descricao);
			$sobre->setImagem($imagem);
			$sobre->setLayout($layout);
			
			if(isset($descricao2)){
				$sobre->setDescricao2($descricao2);
			}
			
			$sobreDAO = new SobreDAO();
			
			if($layout == 1){
				$sobreDAO->Insert($sobre);
			}else{
				$sobreDAO->InsertLayout2($sobre);
			}
		}
		
		public function atualizarLayout(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$titulo = $_POST['txttitulo'];
				$descricao = $_POST['txtdesc'];
				$imagem = $_POST['txtimagem'];
				$layout = $_POST['layout'];
				$id = $_POST['id'];
				
				if(isset($_POST['txtdesc2'])){
					$descricao2 = $_POST['txtdesc2'];
				}
			}
			
			$sobre = new Sobre();
			$sobre->setId($id);
			$sobre->setTitulo($titulo);
			$sobre->setDescricao($descricao);
			$sobre->setImagem($imagem);
			
			if(isset($descricao2)){
				$sobre->setDescricao2($descricao2);
			}
			
			$sobreDAO = new SobreDAO();
			
			if($layout == 1){
				$sobreDAO->UpdateLayout1($sobre);
			}else{
				$sobreDAO->UpdateLayout2($sobre);
			}
		}
		
		public function listarLayout1(){
			$sobreDAO = new SobreDAO();
			
			$listLayout = $sobreDAO->SelectAllLayout1();
			
			return $listLayout;
		}
		
		public function buscarLayout($id){			
			$sobreDAO = new SobreDAO();
			
			$listLayout = $sobreDAO->SelectLayoutByID($id);
			
			return $listLayout;
		}
		
		
		public function listarLayout2(){
			$sobreDAO = new SobreDAO();
			
			$listLayout2 = $sobreDAO->SelectAllLayout2();
			
			return $listLayout2;
		}
		
		public function excluirLayout($id){
			$sobreDAO = new SobreDAO();
			
			$sobreDAO->Delete($id);
		}
		
		public function atualizarStatus($status, $id, $layout){
			$sobreDAO = new SobreDAO();
			
			if($status == 1){
				$sobreDAO->activateOne($id, $layout);
				$sobreDAO->disableAll($id, $layout);
			}else{
				$sobreDAO->disableAll($id, $layout);
				$sobreDAO->activateOne($id, $layout);
			}
		}
	}
?>