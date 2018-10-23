<?php
	class ControllerNossasLojas{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'/model/enderecoClass.php');
			require_once($diretorio.'model/dao/nossasLojasDAO.php');
		}
		
		//função para listar as cidades
		public function listarCidades($estado){
			//instância da classe NossasLojasDAO
			$nossasLojasDAO = new NossasLojasDAO();
			
			//armazenando o resultado em uma variável
			$listCidade = $nossasLojasDAO->selectCidade($estado);
			
			//retornando os dados
			return $listCidade;
		}
		
		//função para listar as lojas
		public function listarLojas($cidade){
			//instância da classe NossasLojasDAO
			$nossasLojasDAO = new NossasLojasDAO();
			
			//armazenando o resultado em uma variável
			$listLoja = $nossasLojasDAO->selectLoja($cidade);
			
			//retornando os dados
			return $listLoja;
		}
	}
?>