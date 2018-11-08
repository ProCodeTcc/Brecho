<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 05/10/2018
		Objetivo: controlar as ações dos produtos em avaliação
	*/

	class controllerAvaliacao{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
            require_once($diretorio.'model/avaliacaoClass.php');
			require_once($diretorio.'model/dao/avaliacaoDAO.php');
			require_once($diretorio.'model/dao/consignacaoDAO.php');
			require_once($diretorio.'model/consignacaoClass.php');
			require_once($diretorio.'model/pedidoClass.php');
			require_once($diretorio.'model/dao/pedidoDAO.php');
		}
		
		//função para gerar uma consignação
		public function inserirConsignacao($tipoCliente, $idCliente, $idProdutoAvaliacao){
			//verifica qual o método de requisição
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os dados das caixas de texto
				$valor = $_POST['txtvalor'];
				$dtinicio = $_POST['dtinicio'];
				$dttermino = $_POST['dttermino'];
				$percentualLoja = $_POST['txtpercentualloja'];
			}

			//instância da classe ConsignacaoDAO
			$consignacaoDAO = new ConsignacaoDAO();

			//instância da classe Consignação
			$consignacaoClass = new Consignacao();

			//setando os atributos
			$consignacaoClass->setValor($valor);
			$consignacaoClass->setDtInicio($dtinicio);
			$consignacaoClass->setDtTermino(($dttermino));

			//armazenando o id da consignação inserida
			$idConsignacao = $consignacaoDAO->insertConsignacao($consignacaoClass);

			if($tipoCliente == 'F'){
				//verifica se a relação entre a consignação e o cliente foi feita
				if($consignacaoDAO->insertConsignacaoCF($idConsignacao, $idCliente) == true){
					//instância da classe avaliacaoDAO
					$avaliacaoDAO = new AvaliacaoDAO();
					
					//inserindo o produto e guardando o ID inserido em uma variável
					$idProduto = $avaliacaoDAO->Insert($idProdutoAvaliacao);
					
					//pegando as imagens de um produto em avaliação e guardando em uma variável
					$imagens = $avaliacaoDAO->selectImages($idProdutoAvaliacao);
					
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
						$avaliacaoDAO->Delete($idProdutoAvaliacao);

						//relacionando a consignação com o produto
						$consignacaoDAO->insertConsignacaoProduto($idProduto, $idConsignacao, $percentualLoja);
					}
				}
			}else{
				//verifica se a relação entre a consignação e o cliente foi feita
				if($consignacaoDAO->insertConsignacaoCJ($idConsignacao, $idCliente) == true){
					//instância da classe avaliacaoDAO
					$avaliacaoDAO = new AvaliacaoDAO();
					
					//inserindo o produto e guardando o ID inserido em uma variável
					$idProduto = $avaliacaoDAO->Insert($idProdutoAvaliacao);
					
					//pegando as imagens de um produto em avaliação e guardando em uma variável
					$imagens = $avaliacaoDAO->selectImages($idProdutoAvaliacao);
					
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
						$avaliacaoDAO->Delete($idProdutoAvaliacao);

						//relacionando a consignação com o produto
						$consignacaoDAO->insertConsignacaoProduto($idProduto, $idConsignacao, $percentualLoja);
					}
				}
			}
		}

		//função que insere um pedido de compra
		public function inserirCompra($tipoCliente, $idCliente, $idProdutoAvaliacao){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando o valor da caixa de texto
				$valor = $_POST['txtvalor'];
			}

			//instância da classe Pedido
			$pedidoClass = new Pedido();

			date_default_timezone_set('America/Sao_Paulo');

			$data = date('Y-m-d');

			//setando os atributos
			$pedidoClass->setValor($valor);
			$pedidoClass->setDtPedido($data);
			
			//instância da classe pedido DAO
			$pedidoDAO = new PedidoDAO();

			//inserindo o pedido e armazenando o ID
			$idPedido = $pedidoDAO->insertPedidoCompra($pedidoClass);
			//verificando qual o tipo de cliente
			if($tipoCliente == 'F'){
				//relacionando um pedido de compra com o cliente físico
				if($pedidoDAO->insertPedidoCompraCF($idPedido, $idCliente) == true){
					//instância da classe avaliacaoDAO
					$avaliacaoDAO = new AvaliacaoDAO();
						
					//inserindo o produto e guardando o ID inserido em uma variável
					$idProduto = $avaliacaoDAO->Insert($idProdutoAvaliacao);
					
					//pegando as imagens de um produto em avaliação e guardando em uma variável
					$imagens = $avaliacaoDAO->selectImages($idProdutoAvaliacao);
					
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
						$avaliacaoDAO->Delete($idProdutoAvaliacao);

						//relacionando a consignação com o produto
						$pedidoDAO->insertCompraProduto($idProduto, $idPedido);
					}
				}
			}else{
				//inserindo um pedido de compra com um cliente jurídico
				if($pedidoDAO->insertPedidoCompraCJ($idPedido, $idCliente) == true){
					//instância da classe avaliacaoDAO
					$avaliacaoDAO = new AvaliacaoDAO();
						
					//inserindo o produto e guardando o ID inserido em uma variável
					$idProduto = $avaliacaoDAO->Insert($idProdutoAvaliacao);
					
					//pegando as imagens de um produto em avaliação e guardando em uma variável
					$imagens = $avaliacaoDAO->selectImages($idProdutoAvaliacao);
					
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
						$avaliacaoDAO->Delete($idProdutoAvaliacao);

						//relacionando o pedido com o produto
						$pedidoDAO->insertCompraProduto($idProduto, $idPedido);
					}
				}
			}
		}
		
		//função que lista os produtos
		public function listarProdutosCF(){
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//armazenando o resultado da consulta em uma variável
			$listProdutos = $avaliacaoDAO->selectAllCF();
			
			//retornando os dados
			return $listProdutos;
		}

		//função que lista os produtos
		public function listarProdutosCJ(){
			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();
			
			//armazenando o resultado da consulta em uma variável
			$listProdutos = $avaliacaoDAO->selectAllCJ();
			
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

		//função para pesquisar os produtos dos clientes físico
		public function pesquisarProdutoCF($pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();

			//armazenando os dados em uma variável
			$listProduto = $avaliacaoDAO->searchProdutoCF($termo);

			//retornando os dados
			return $listProduto;
		}

		//função para pesquisar os produtos do cliente jurídico
		public function pesquisarProdutoCJ($pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe AvaliacaoDAO
			$avaliacaoDAO = new AvaliacaoDAO();

			//armazenando os dados em uma variável
			$listProduto = $avaliacaoDAO->searchProdutoCJ($termo);

			//retornando os dados
			return $listProduto;
		}
	}
?>