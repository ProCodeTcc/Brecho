<?php
	class controllerProduto{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/produtoClass.php');
			require_once($diretorio.'model/dao/produtoDAO.php');
		}
		
		public function listarProdutos(){
			$produtoDAO = new ProdutoDAO();
			$listProduto = $produtoDAO->selectAll();
			
			//contador
			$cont = 0;
			
			//percorrendo a lista de produtos
			while($cont < count($listProduto)){
				//separando o "../" e armazenando o caminho da imagem em uma variável
				$novaImagem = explode('../', $listProduto[$cont]->getImagem());
				
				//percorrendo a variável com o novo caminho e armazenando em uma nova variável
				foreach($novaImagem as $img){
					//adicionando a imagem com o novo caminho á lista de produtos
					$listProduto[$cont]->setImagem($img);
				}
				
				//incrementando o contador
				$cont++;
			}
			
			
			//retornando a lista dos produtos
			return $listProduto;
		}
		
		public function buscarProduto($id){
			$produtoDAO = new ProdutoDAO();
			$listProduto = $produtoDAO->selectByID($id);
			
			return $listProduto;
		}
		
		public function listarImagens($id){
			$produtoDAO = new ProdutoDAO();
			$listImagens = $produtoDAO->selectImages($id);
			
			$cont = 0;
			
			while($cont < count($listImagens)){
				$novaImagem = explode('../', $listImagens[$cont]->getImagem());
				
				foreach($novaImagem as $img){
					$listImagens[$cont]->setImagem($img);
				}
				
				$cont++;
			}
			
			return $listImagens;
		}
	}
?>