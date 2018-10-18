<?php
	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 15/10/2018
        Objetivo: controlar as ações da página de promoção

    */

	class controllerPromocao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/promocaoClass.php');
			require_once($diretorio.'model/dao/promocaoDAO.php');
		}
		
		//função que lista os produtos em promoção
		public function listarPromocao(){
			//instância da classe promocaoDAO
			$promocaoDAO = new PromocaoDAO();
			
			//armazenando o resultado da consulta em uma variável
			$listProduto = $promocaoDAO->selectAll();
			
			//retornando a lista com os produtos
			return $listProduto;
		}
		
		public function buscarProduto($id){
			$promocaoDAO = new PromocaoDAO();
			
			$listPromocao = $promocaoDAO->SelectByID($id);
			
			return $listPromocao;
		}
	}
?>