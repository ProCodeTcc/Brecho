<?php
	class controllerProduto{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/produtoClass.php');
			require_once($diretorio.'model/dao/produtoDAO.php');
		}
		
		public function inserirProduto(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$nome = $_POST['txtnome'];
				$descricao = $_POST['txtdescricao'];
				$preco = $_POST['txtpreco'];
				$classificacao = $_POST['txtclassificacao'];
				$marca = $_POST['txtmarca'];
				$categoria = $_POST['txtcategoria'];
				$cor = $_POST['txtcor'];
				$tamanho = $_POST['txttamanho'];
				$imagem = $_POST['txtimagem1'];
				$imagem2 = $_POST['txtimagem2'];
				$imagem3 = $_POST['txtimagem3'];
				$imagens = array($imagem, $imagem2, $imagem3);
			}
			
			$produtoClass = new Produto();
			
			$produtoClass->setNome($nome);
			$produtoClass->setDescricao($descricao);
			$produtoClass->setPreco($preco);
			$produtoClass->setClassificacao($classificacao);
			$produtoClass->setMarca($marca);
			$produtoClass->setCategoria($categoria);
			$produtoClass->setCor($cor);
			$produtoClass->setTamanho($tamanho);
			
			$produtoDAO = new ProdutoDAO();
			
			$idProduto = $produtoDAO->Insert($produtoClass);
			$idImagem = $produtoDAO->insertImagem($imagens);
			
			$produtoDAO->InsertProdutoImagem($idProduto, $idImagem);
		}
		
		public function atualizarProduto($id){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
			
			$produtoClass = new Produto();
			
			$produtoClass->setId($id);
			$produtoClass->setNome($nome);
			$produtoClass->setDescricao($descricao);
			$produtoClass->setPreco($preco);
			$produtoClass->setClassificacao($classificacao);
			$produtoClass->setMarca($marca);
			$produtoClass->setCategoria($categoria);
			$produtoClass->setCor($cor);
			$produtoClass->setTamanho($tamanho);
			
			$produtoDAO = new ProdutoDAO();
			
			$produtoDAO->Update($produtoClass);
		}
		
		public function atualizarStatus($status, $id){
			$produtoDAO = new ProdutoDAO();
			$produtoDAO->updateStatus($status, $id);
		}
		
		public function atualizarImagem($imagem, $id){
			$produtoDAO = new ProdutoDAO();
			$produtoDAO->updateImagem($imagem, $id);
		}
		
		public function listarImagens($id){
			$produtoDAO = new ProdutoDAO();
			
			$listImagens = $produtoDAO->selectImages($id);
			
			return $listImagens;
		}
		
		public function excluirImagem($id){
			$produtoDAO = new ProdutoDAO();
			
			$produtoDAO->deleteImagem($id);
		}
		
		/*public function inserirImagem(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
			}
			
			$produtoDAO = new ProdutoDAO();
			$produtoDAO->insertImagem($imagens);
		}*/
		
		public function buscarProduto($id){
			$produtoDAO = new ProdutoDAO();
			
			$listProduto = $produtoDAO->selectByID($id);
			
			return $listProduto;
		}
		
		public function excluirProduto($id){
			$produtoDAO = new ProdutoDAO();
			
			$produtoDAO->Delete($id);
		}
		
		public function inserirPromocao($id){
			$produtoDAO = new ProdutoDAO();
			
			$produtoDAO->insertPromocao($id);
		}
		
		public function buscarTamanho($tamanho){
			$produtoDAO = new ProdutoDAO();
			
			$listTamanho = $produtoDAO->selectTamanho($tamanho);
			
			return $listTamanho;
		}
		
		public function listarProduto(){
			$produtoDAO = new ProdutoDAO();
			
			$listProduto = $produtoDAO->selectAll();
			
			return $listProduto;
		}
		
		public function listarCor(){
			$produtoDAO = new ProdutoDAO();
			
			$listCores = $produtoDAO->selectCores();
			
			return $listCores;
		}
		
		public function listarMarca(){
			$produtoDAO = new ProdutoDAO();
			
			$listMarca = $produtoDAO->selectMarcas();
			
			return $listMarca;
		}
		
		public function listarCategoria(){
			$produtoDAO = new ProdutoDAO();
			
			$listCategoria = $produtoDAO->selectCategorias();
			
			return $listCategoria;
		}
	}
?>