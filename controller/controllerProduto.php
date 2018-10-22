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
		
		//função que listas os produtos por classificação
		public function listarProdutoClassificacao($classificacao){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados em uma variável
			$listProdutos = $produtoDAO->SelectByClassificacao($classificacao);
			
			//retornando os dados
			return $listProdutos;
		}
		
		//função para listar as medidas
		public function listarMedidas(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados em uma variável
			$listMedida = $produtoDAO->selectMedida();
			
			//retornando os dados
			return $listMedida;
		}
		
		//função para listar os números
		public function listarNumeros(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados em uma variável
			$listNumero = $produtoDAO->selectNumero();
			
			//retornando os dados
			return $listNumero;
		}
		
		//função que lista os produtos pelo tamanho
		public function listarProdutoTamanho($tamanho){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados em uma variável
			$listProduto = $produtoDAO->SelectByTamanho($tamanho);
			
			//retornando os dados
			return $listProduto;
		}
		
		//função que lista os produtos aleatóriamente
		public function listarAleatorio(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando os dados em uma variável
			$listProduto = $produtoDAO->selectRandom();
			
			//retornando os dados
			return $listProduto;
		}
	}
?>