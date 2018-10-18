<?php

	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 8/10/2018
        Objetivo: manipular as ações dos produtos

    */
	class controllerProduto{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/produtoClass.php');
			require_once($diretorio.'model/dao/produtoDAO.php');
		}
		
		//função que lista um produto
		public function listarProdutos(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados em uma variável
			$listProduto = $produtoDAO->selectAll();	
			
			//retornando a lista dos produtos
			return $listProduto;
		}
		
		//função que busca um produto pelo ID
		public function buscarProduto($id){
			//instância da classe produtoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados retornados em uma variável
			$listProduto = $produtoDAO->selectByID($id);
			
			//retornando o produto
			return $listProduto;
		}
		
		//função que lista as imagens
		public function listarImagens($id){
			//instância da classe produtoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno em uma variável
			$listImagens = $produtoDAO->selectImages($id);
			
			//retornando a lista com as imagens
			return $listImagens;
		}
        
        public function listarCategoria(){
            
            $categoriaDAO = new ProdutoDAO();
            
            $listCategoria = $categoriaDAO ->selectCategorias();
            
            return $listCategoria;
            
            
        }
        
        public function listarProdutoCategoria($id){
        
            //instância da classe produtoDAO
            $produtoCategoriaDAO = new ProdutoDAO();
            
            //armazenando os dados retornados.
            $listProdutoCategoria= $produtoCategoriaDAO->selectProdutoCategoria($id);
            
            //Retornando o produto da categoria.
            return $listProdutoCategoria;
        
        }
	}
?>