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
			require_once($diretorio.'model/dao/clienteFisicoDAO.php');
			require_once($diretorio.'model/dao/clienteJuridicoDAO.php');
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
				$subcategoria = $_POST['txtsubcategoria'];
				
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
				$avaliacaoClass->setSubcategoria($subcategoria);
				$avaliacaoClass->setMarca($marca);
				$avaliacaoClass->setPreco($valor);
				$avaliacaoClass->setCor($cor);
				$avaliacaoClass->setDescricao($estado);
				$avaliacaoClass->setClassificacao($classificacao);

				//instância da classe AvaliacaoDAO
				$avaliacaoDAO = new AvaliacaoDAO();
				
				//armazenando o ID do produto em uma variável
				$idProduto = $avaliacaoDAO->insertProduto($avaliacaoClass);
				
				//armazenando o ID da imagem em uma variável
				$idImagem = $avaliacaoDAO->insertImagem($imagem);
				
				//inserindo o ID do produto e da imagem em uma variável
				$avaliacaoDAO->insertProdutoImagem($idProduto, $idImagem);

				//verificando se a sessão ainda não foi iniciada
				if(session_id() == ''){
					//inicia a sessão
					session_start();
					
					//setando o horário padrão para São Paulo
					date_default_timezone_set('America/Sao_Paulo');

					//armazenando a data atual
					$dataAtual = date('Y-m-d');

					//verifica qual o tipo do cliente
					if($_SESSION['tipoCliente'] == 'F'){
						//instância da classe ClienteFisicoDAO
						$clienteFisicoDAO = new ClienteFisicoDAO();

						//relacionando o produto com o cliente
						$clienteFisicoDAO->insertClienteProduto($_SESSION['idCliente'], $idProduto, $dataAtual);
					}else{
						//instância da classe ClienteJuridicoDAO
						$clienteJuridicoDAO = new ClienteJuridicoDAO();

						//relacionando o cliente com o produto
						$clienteJuridicoDAO->insertClienteProduto($_SESSION['idCliente'], $idProduto, $dataAtual);
					}
				}
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

		//função para listar as subcategorias
		public function listarSubcategoria($idCategoria){
			//instância da classe avaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();

			//armazenando os dados em uma variável
			$listSubcategoria = $avaliacaoDAO->selectSubcategoria($idCategoria);

			//retornando os dados
			return $listSubcategoria;
		}

		//função para filtrar o pedido de um cliente
		public function filtrarPedido($tipoCliente, $idCliente){
			//verifica qual o tipo do cliente
			if($tipoCliente == 'F'){
				//instância da classe ClienteFisicoDAO
				$clienteFisicoDAO = new ClienteFisicoDAO();

				//armazenando o produto em uma variável
				$listProduto = $clienteFisicoDAO->selectProduto($idCliente);
			}else{
				//instância da classe CLienteJuridicoDAO
				$clienteJuridicoDAO = new ClienteJuridicoDAO();

				//armazenando o produto em uma variável
				$listProduto = $clienteJuridicoDAO->selectProduto($idCliente);
			}

			//contador
			$cont = 0;

			//percorrendo os dados
			while($cont < count($listProduto)){
				//convertendo a data para o padrão brasileiro
				$data = date('d/m/Y', strtotime($listProduto[$cont]->getData()));
				
				//setando a data convertida
				$listProduto[$cont]->setData($data);
				
				//incrementando o contador
				$cont++;
			}

			//retornando os produtos
			return $listProduto;
		}
	}
?>