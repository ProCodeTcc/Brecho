<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: controlar as ações da página de retiradas
	*/

	class controllerRetirada{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/retiradaClass.php');
			require_once($diretorio.'model/dao/retiradaDAO.php');
		}
		
		//função que marca uma retirada
		public function inserirRetirada(){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$dtRetirada = $_POST['dtretirada'];
				$idUnidade = $_POST['txtunidade'];
				$idPedido = $_POST['txtpedido'];
			}
			
			//criando uma nova retirada
			$retiradaClass = new Retirada();
			
			//setando os atributos
			$retiradaClass->setDtRetirada($dtRetirada);
			$retiradaClass->setIdUnidade($idUnidade);
			$retiradaClass->setIdPedido($idPedido);
			
			//instância da classe RetiradaDAO
			$retiradaDAO = new RetiradaDAO();
			
			//chamada da função que insere os dados
			$retiradaDAO->Insert($retiradaClass);
		}
		
		//função que lista as retiradas
		public function listarRetiradas(){
			//instância da classe RetiradaDAO
			$retiradaDAO = new RetiradaDAO();
			
			//armazenando os dados em uma variável
			$listRetirada = $retiradaDAO->selectAll();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($cont < count($listRetirada)){
				//conversão da data para o padrão brasileiro
				$data = date('d/m/Y', strtotime($listRetirada[$cont]->getDtRetirada()));
				
				//setando a data convertida
				$listRetirada[$cont]->setDtRetirada($data);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando a lista com os dados
			return $listRetirada;
		}
		
		//função que lista as lojas
		public function listarLojas(){
			//instância da classe retiradaDAO
			$retiradaDAO = new RetiradaDAO();
			
			//armazenando os dados em uma variável
			$listLojas = $retiradaDAO->selectLojas();
			
			//retornando os dados
			return $listLojas;
		}
		
		//função que lista os pedidos
		public function listarPedidos(){
			//instância da classe retiradaDAO
			$retiradaDAO = new RetiradaDAO();
			
			//armazenando os dados em uma variváel
			$listPedidos = $retiradaDAO->selectPedidos();
			
			//retornando os dados
			return $listPedidos;
		}
	}
?>