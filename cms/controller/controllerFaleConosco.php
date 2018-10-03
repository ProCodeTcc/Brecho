<?php
	class controllerFaleConosco{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
			require_once($diretorio.'/model/faleConoscoClass.php');
        	require_once($diretorio.'/model/dao/faleConoscoDAO.php');
		}
		
		public function listarFeedback(){
			$fconoscoDAO = new FaleConoscoDAO();
			$listFeedback = $fconoscoDAO->selectAll();
			
			return $listFeedback;
		}
		
		public function buscarFeedback($id){
			$fconoscoDAO = new FaleConoscoDAO();
			$listFeedback = $fconoscoDAO->SelectByID($id);
			
			return $listFeedback;
		}
		
		public function excluirFeedback($id){
			$fconoscoDAO = new FaleConoscoDAO();
			$listFeedback = $fconoscoDAO->Delete($id);
		}
	}
?>