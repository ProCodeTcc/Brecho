<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 07/10/2018
        Objetivo: controlar as ações da página de promoções

    */

	class controllerPromocao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/promocaoClass.php');
			require_once($diretorio.'model/dao/promocaoDAO.php');
		}
		
		//função que lista os produtos em promoção
		public function listarProduto(){
			//instância da classe PromocaoDAO
			$promocaoDAO = new PromocaoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listProdutos = $promocaoDAO->selectAll();
			
			//retornando a lista com os produtos
			return $listProdutos;
		}
		
		//função que busca um produto pelo ID
		public function buscarProduto($id){
			//instância da classe PromocaoDAO
			$promocaoDAO = new PromocaoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listProduto = $promocaoDAO->selectByID($id);
			
			//retornando a lista com os produtos
			return $listProduto;
		}
		
		//função que cadastra o percentual da promoção
		public function cadastrarPromocao($id){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$desconto = $_POST['desconto'];
				$dtInicial = $_POST['dtinicial'];
				$dtFinal = $_POST['dtfinal'];
				$id = $_POST['id'];
			}
			
			//instância da classe de promoção
			$promocaoClass = new Promocao();
			
			//setando os atributos da promoção
			$promocaoClass->setDesconto($desconto);
			$promocaoClass->setDtInicial($dtInicial);
			$promocaoClass->setDtFinal($dtFinal);
			$promocaoClass->setId($id);
			
			//instância da classe PromocaoDAO
			$promocaoDAO = new PromocaoDAO();
			
			//chamada da função que "insere uma promoção"
			$promocaoDAO->insertPromocao($promocaoClass);
		}
		
		//função que exclui a promoção
		public function excluirPromocao($id){
			//instância da classe PromocaoDAO
			$promocaoDAO = new PromocaoDAO();
			
			//armazena o total de promoções cadastradas
			$promocaoAtiva = $promocaoDAO->checkPromocao();
			
			//verificando o total
			if($promocaoAtiva == 1){
				//se for igual a 1, limita a exclusão
				echo('limite');
			}else{
				//chamada da função que deleta do banco
				$promocaoDAO->Delete($id);
			}
		}
		
		//função que atualiza o status
		public function atualizarStatus($status, $id){
			//instância da classe PromocaoDAO
			$promocaoDAO = new PromocaoDAO();
			
			//chamada da função que atualiza o status
			$promocaoDAO->updateStatus($status, $id);
		}
	}
?>