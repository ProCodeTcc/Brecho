<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 05/10/2018
		Objetivo: controlar as ações dos produtos em avaliação
	*/

	class controllerAvaliacao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
            require_once($diretorio.'/model/avaliacaoClass.php');
            require_once($diretorio.'/model/dao/avaliacaoDAO.php');
		}
		
		//função que aprova um produto
		public function aprovarProduto($id){
			//instância da classe avaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//inserindo o produto e guardando o ID inserido em uma variável
			$idProduto = $avaliacaoDAO->Insert($id);
			
			//pegando as imagens de um produto em avaliação e guardando em uma variável
			$imagens = $avaliacaoDAO->selectImages($id);
			
			//contador
			$cont = 0;
			
			//percorrendo as imagens
			while($cont < count($imagens)){
				//inserindo as imagens e armazenando os IDs retornados em uma variável
				$idImagem[] = $avaliacaoDAO->insertImages($imagens[$cont]->getImagem());
				
				//incrementando o contador
				$cont++;
			}
			
			//verificando se a inserção do produto e da imagem na tabela de relacionamento foi
			//feita com sucesso
			if($avaliacaoDAO->insertProdutoImage($idProduto, $idImagem)){
				//se foi, deleta o produto da tabela de avaliação
				$avaliacaoDAO->Delete($id);
				
				//mensagem de sucesso
				echo('Produto aprovado com sucesso!!');
			}else{
				echo('Ocorreu um erro ao aprovar o produto!!');
			}
		}
		
		//função que lista os produtos
		public function listarProdutos(){
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//armazenando o resultado da consulta em uma variável
			$listProdutos = $avaliacaoDAO->selectAll();
			
			//retornando os dados
			return $listProdutos;
		}
		
		//função que lista as imagens de um produto
		public function listarImagens($id){
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//armazenando as imagens em uma variável
			$listImagem = $avaliacaoDAO->selectImages($id);
			
			//retornando a lista com as imagens
			return $listImagem;
		}
		
		//função que busca um produto
		public function buscarProduto($id){
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//armazenando os dados retornados em uma variável
			$listProduto = $avaliacaoDAO->selectByID($id);
			
			//retornando a lista com os produtos
			return $listProduto;
		}
		
		//função que exclui um produto
		public function excluirProduto($id){	
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//chamada da função que exclui um produto
			$avaliacaoDAO->Delete($id);
		}
		
		//função que exclui as imagens do produto do diretório
		public function excluirImagemDiretorio($id){
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//armazenando o caminho das imagens da consulta em uma variável
			$listImagens = $avaliacaoDAO->selectImages($id);
			$cont = 0;
			
			//percorrendo as imagens
			while($cont < count($listImagens)){
				//excluindo a imagem do diretório
				unlink('view/arquivos/'.$listImagens[$cont]->getImagem());
				$cont++;
			}
		}
	}
?>