<?php
	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 11/10/2018
        Objetivo: manipular as ações da página de cadastro de produtos

    */

	class controllerAvaliacao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/avaliacaoClass.php');
			require_once($diretorio.'model/dao/avaliacaoDAO.php');
			require_once($diretorio.'model/imagemClass.php');
		}
		
		//função que insere um produto
		public function inserirProduto(){
			//verifica se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				//restaganto os valores
				$nome = $_POST['txtnome'];
				$classificacao = $_POST['txtclassificacao'];
				$tamanho = $_POST['txttamanho'];
				$categoria = $_POST['txtcategoria'];
				$marca = $_POST['txtmarca'];
				$valor = $_POST['txtvalor'];
				$cor = $_POST['txtcor'];
				$estado = $_POST['txtestado'];
				
				//criando uma nova imagem
				$imagemClass = new Imagem();
				
				//armazenando o caminho da imagem
				$imagem = $imagemClass->salvarImagem();
				
				//criando um novo produto pra avaliação
				$avaliacaoClass = new Avaliacao();
				
				//setando atributos
				$avaliacaoClass->setNome($nome);
				$avaliacaoClass->setTamanho($tamanho);
				$avaliacaoClass->setCategoria($categoria);
				$avaliacaoClass->setMarca($marca);
				$avaliacaoClass->setPreco($valor);
				$avaliacaoClass->setCor($cor);
				$avaliacaoClass->setDescricao($estado);
				$avaliacaoClass->setClassificacao($classificacao);
				$avaliacaoDAO = new AvaliacaoDAO();
				
				//armazenando o ID do produto em uma variável
				$idProduto = $avaliacaoDAO->insertProduto($avaliacaoClass);
				
				//armazenando o ID da imagem em uma variável
				$idImagem = $avaliacaoDAO->insertImagem($imagem);
				
				//inserindo o ID do produto e da imagem em uma variável
				$avaliacaoDAO->insertProdutoImagem($idProduto, $idImagem);
				// checar se a imagem está vazia				
//				if(empty($_FILES['fleimage'])){
//					
//				}
//			
			}
		}
		
		//função para listar uma cor
		public function listarCor(){
			//instância da classe avaliacaoDAO
			$avaliacaoDAO = new avaliacaoDAO();
			
			//armazenando o resultado da consulta
			$listCor = $avaliacaoDAO->selectCor();
			
			//retornando os dados
			return $listCor;
		}
		
		//função para listar uma marca
		public function listarMarca(){
			//instância da classe avaliacaoDAO
			$avaliacaoDAO = new avaliacaoDAO();
			
			//armazenando os dados em uma variável
			$listMarca = $avaliacaoDAO->selectMarca();
			
			//retornando os dados
			return $listMarca;
		}
		
		//função para listar as categorias
		public function listarCategoria(){
			//instância da classe avaliacaoDAO
			$avaliacaoDAO = new avaliacaoDAO();
			
			//armazenando os dados em uma variável
			$listCategoria = $avaliacaoDAO->selectCategoria();
			
			//retornando os dados
			return $listCategoria;
		}
		
		//função para listar os tamanhos
		public function listarTamanho($tipo){
			//instância da classe avaliacaoDAO
			$avaliacaoDAO = new avaliacaoDAO();
			
			//armazenando os tamanhos em uma variável
			$listTamanho = $avaliacaoDAO->selectTamanho($tipo);
			
			//retornando os dados
			return $listTamanho;
		}
	}
?>