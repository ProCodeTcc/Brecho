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
				$subcategoria = $_POST['txtsubcategoria'];
				$cor = $_POST['txtcor'];
				$tamanho = $_POST['txttamanho'];
				$idioma = $_POST['idioma'];
				
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
			$produtoClass->setSubcategoria($subcategoria);
			$produtoClass->setCor($cor);
			$produtoClass->setTamanho($tamanho);
			
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//verifica qual o idioma
			if($idioma == 'pt'){
				//armazenando o ID do produto em uma variável
				$idProduto = $produtoDAO->Insert($produtoClass);
				
				//armazenando o ID da imagem em uma variável
				$idImagem = $produtoDAO->insertImagem($imagens);

				//verifica se existe a imagem
				if(empty($idImagem)){
					//armazena a mensagem de erro se não existir
					$status = array('status' => 'erro-imagem');
				}
				
				//verifica se existe o id do produto e da imagem
				if(isset($idProduto) && !empty($idImagem)){
					//inserindo o ID do produto e da imagem na tabela de relacionamento
					$status = $produtoDAO->InsertProdutoImagem($idProduto, $idImagem);
				}
			}else{
				//armazena o ID do produto em PT na variável
				$idProduto = $_POST['id'];

				//insere o produto traduzido
				$status = $produtoDAO->insertTranslate($produtoClass, $idProduto, $idioma);
			}

			//retorna o status
			return $status;
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
				$subcategoria = $_POST['txtsubcategoria'];
				$cor = $_POST['txtcor'];
				$tamanho = $_POST['txttamanho'];
				$id = $_POST['id'];
				$idioma = $_POST['idioma'];
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
			$produtoClass->setSubcategoria($subcategoria);
			$produtoClass->setCor($cor);
			$produtoClass->setTamanho($tamanho);
			
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();

			//chamando a função que atualiza um produto e armazenando o status
			$status = $produtoDAO->Update($produtoClass);


			//retornando o status
			return $status;
		}

		//função para atualizar uma tradução
		public function atualizarTraducao($id){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$descricao = $_POST['txtdescricao'];
			}

			//instância da classe Produto
			$produtoClass = new Produto();

			//setando os atributos
			$produtoClass->setId($id);
			$produtoClass->setNome($nome);
			$produtoClass->setDescricao($descricao);

			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();

			//atualizando o produto
			$status = $produtoDAO->updateTranslate($produtoClass);

			//retornando o status
			return $status;
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
			
			if($_FILES['fleimagem']['size'] == 0){
				$imagem = $_POST['imagem'];
			}else{
				if(!empty($_FILES['fleimagem'])){
					$imagemClass = new Imagem();
					$imagem = $imagemClass->uploadImagem();
				}
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
		public function buscarProduto($id, $idioma){
			//instância da classe produtoDAO
			$produtoDAO = new ProdutoDAO();
			
			if($idioma == 'pt'){
				//armazenando o retorno da consulta em uma variável
				$listProduto = $produtoDAO->selectByID($id);
			}else{
				$listProduto = $produtoDAO->selectTranslate($id);
			}
			
			//retornando a lista com o produto
			return $listProduto;
		}
		
		//função que exclui um produto
		public function excluirProduto($id){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();
			
			//armazenando o total de produtos em uma variável
			$produtosAtivos = $produtoDAO->checkProduto();
			
			//verificando o total de produtos cadastrados
			if($produtosAtivos == 1){
				//limita a exclusão
				echo 'limite';
			}else{
				//chamada da função que deleta um produto
				$produtoDAO->Delete($id);
			}
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

		//função para listar as subcategorias
		public function listarSubcategoria($idCategoria){
			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();

			//armazenando os dados em uma variável
			$listSubcategoria = $produtoDAO->selectSubcategorias($idCategoria);

			//retornando os dados
			return $listSubcategoria;
		}

		//função para pesquisar um produto
		public function pesquisarProduto($pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$produtoDAO = new ProdutoDAO();

			//armazenando os dados em uma variável
			$listProduto = $produtoDAO->searchProduto($termo);

			//retornando os dados
			return $listProduto;
		}
	}
?>