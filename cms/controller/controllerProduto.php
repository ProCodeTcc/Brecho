<?php
	/*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 05/10/2018
        Objetivo: controlar as ações dos produtos

    */

	class controllerProduto{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/produtoClass.php');
			require_once($diretorio.'model/dao/produtoDAO.php');
			require_once($diretorio.'model/imagemClass.php');
		}
		
		//função que insere um produto
		public function inserirProduto(){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$descricao = $_POST['txtdescricao'];
				$preco = $_POST['txtpreco'];
				$classificacao = $_POST['txtclassificacao'];
				$marca = $_POST['txtmarca'];
				$categoria = $_POST['txtcategoria'];
				$cor = $_POST['txtcor'];
				$tamanho = $_POST['txttamanho'];
				
				if(!empty($_FILES['fleimagem'])){
					$imagemClass = new Imagem();
					$imagens = $imagemClass->uploadMultiplo();
				}
			}
			
			//instânciando um novo produto
			$produtoClass = new Produto();
			
			//setando os atributos do produto
			$produtoClass->setNome($nome);
			$produtoClass->setDescricao($descricao);
			$produtoClass->setPreco($preco);
			$produtoClass->setClassificacao($classificacao);
			$produtoClass->setMarca($marca);
			$produtoClass->setCategoria($categoria);
			$produtoClass->setCor($cor);
			$produtoClass->setTamanho($tamanho);
			
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o ID do produto em uma variável
			$idProduto = $produtoDAO->Insert($produtoClass);
			
			//armazenando o ID da imagem em uma variável
			$idImagem = $produtoDAO->insertImagem($imagens);
			
			//inserindo o ID do produto e da imagem na tabela de relacionamento
			$produtoDAO->InsertProdutoImagem($idProduto, $idImagem);
		}
		
		//função que atualiza um produto
		public function atualizarProduto($id){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$descricao = $_POST['txtdescricao'];
				$preco = $_POST['txtpreco'];
				$classificacao = $_POST['txtclassificacao'];
				$marca = $_POST['txtmarca'];
				$categoria = $_POST['txtcategoria'];
				$cor = $_POST['txtcor'];
				$tamanho = $_POST['txttamanho'];
				$id = $_POST['id'];
			}
			
			//instância da classe produto
			$produtoClass = new Produto();
			
			//setando os atributos do produto
			$produtoClass->setId($id);
			$produtoClass->setNome($nome);
			$produtoClass->setDescricao($descricao);
			$produtoClass->setPreco($preco);
			$produtoClass->setClassificacao($classificacao);
			$produtoClass->setMarca($marca);
			$produtoClass->setCategoria($categoria);
			$produtoClass->setCor($cor);
			$produtoClass->setTamanho($tamanho);
			
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//chamando a função que atualiza um produto
			$produtoDAO->Update($produtoClass);
		}
		
		//função que atualiza o status do produto
		public function atualizarStatus($status, $id){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//chamando a função que atualiza um status
			$produtoDAO->updateStatus($status, $id);
		}
		
		
		//função que atualiza uma imagem
		public function atualizarImagem($id){
			
			if(!empty($_FILES['fleimagem'])){
				$imagemClass = new Imagem();
				$imagem = $imagemClass->uploadImagem();
			}
			
			//instância da clase ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//chamando a função que atualiza a imagem
			$produtoDAO->updateImagem($imagem, $id);
		}
		
		//função que lista as imagens
		public function listarImagens($id){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listImagens = $produtoDAO->selectImages($id);
			
			//retornando a lista com as imagens
			return $listImagens;
		}
		
		//função que deleta uma imagem
		public function excluirImagem($id){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//chamada da função que deleta a imagem
			$produtoDAO->deleteImagem($id);
		}
		
		//função que busca um produto a partir do ID
		public function buscarProduto($id){
			//instância da classe produtoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listProduto = $produtoDAO->selectByID($id);
			
			//retornando a lista com o produto
			return $listProduto;
		}
		
		//função que exclui um produto
		public function excluirProduto($id){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//chamada da função que deleta um produto
			$produtoDAO->Delete($id);
		}
		
		//função que insere uma promoção
		public function inserirPromocao($id){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//chamada da função que insere uma promoção
			$produtoDAO->insertPromocao($id);
		}
		
		//função que busca os tamanhos
		public function buscarTamanho($tamanho){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listTamanho = $produtoDAO->selectTamanho($tamanho);
			
			//retornando a lista com os tamanhos
			return $listTamanho;
		}
		
		//função que busca um produto
		public function listarProduto(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listProduto = $produtoDAO->selectAll();
			
			//retornando a lista com o produto
			return $listProduto;
		}
		
		//função que lista as cores
		public function listarCor(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listCores = $produtoDAO->selectCores();
			
			//retornando a lista com as cores
			return $listCores;
		}
		
		//função que lista as marcas
		public function listarMarca(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listMarca = $produtoDAO->selectMarcas();
			
			//retornando a lista com as marcas
			return $listMarca;
		}
		
		//função que lista as categorias
		public function listarCategoria(){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listCategoria = $produtoDAO->selectCategorias();
			
			//retornando a lista com as categorias
			return $listCategoria;
		}
	}
?>