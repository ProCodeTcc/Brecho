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

		//função para adicionar os itens no carrinho
		public function adicionarCarrinho($id){
			//inicia a sessão
			session_start();

			//verifica se a sessão já existe
			if(!isset($_SESSION['carrinho'])){
				//se não, cria a sessão
				$_SESSION['carrinho'] = array();
			}

			//verifica se o item já existe no carrinho
			if(array_key_exists($id, $_SESSION['carrinho'])){
				//se existe, retorna a mensagem
				echo('existe');
			}else{
				//se não, adiciona o item ao carrinho
				$_SESSION['carrinho'][$id] = 1;
	
				//armazenando o total de itens no carrinho
				$total = count($_SESSION['carrinho']);

				//retornando o total
				return $total;
			}
		}

		//função para listar os produtos do carrinho
		public function listarProdutosCarrinho(){
			//instância da classe ProdutoDAO();
			$produtoDAO = new ProdutoDAO();

			//verifica se existe a sessão
			if(isset($_SESSION['carrinho'])){
				//cria uma array
				$ids = array();

				//precorrendo o ID dos produtos
				foreach($_SESSION['carrinho'] as $id => $valor){
					//armazenando os valores num array de IDs
					$id = array_push($ids, $id);
				}

				//armazenando os produtos em uma variável
				$listProduto = $produtoDAO->selectCartItens($ids);

				//retornando os produtos
				return $listProduto;
			}
		}

		//função para remover itens do carrinho
		public function removerItemCarrinho($id){
			//verifica se a sessão já existe
			if(session_id() == ''){
				//se não existir, inicia ela
				session_start();

				//verifica se o ID do produto está no carrinho
				if(isset($_SESSION['carrinho'][$id])){
					//se estiver, armazena em uma variável o total de itens
					$item = count($_SESSION['carrinho'][$id]);
					
					//se for diferente de 0
					if($item != 0){
						//remove o item
						unset($_SESSION['carrinho'][$id]);
					}
				}
			}
		}
	}
?>