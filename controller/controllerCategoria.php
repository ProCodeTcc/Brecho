<?php
    class controllerCategoria{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/categoriaClass.php');
			require_once($diretorio.'model/dao/categoriaDAO.php');
			require_once($diretorio.'model/subcategoriaClass.php');
			require_once($diretorio.'model/dao/subcategoriaDAO.php');
            require_once($diretorio.'model/produtoClass.php');
        }

        public function listarCategoria(){
            
            $categoriaDAO = new CategoriaDAO();
            
            $listCategoria = $categoriaDAO ->selectCategorias();
            
            return $listCategoria;   
		}
		
		public function listarSubcategoria($idCategoria){
			$subcategoriaDAO = new SubcategoriaDAO();

			$listSubcategoria = $subcategoriaDAO -> selectAll($idCategoria);

			return $listSubcategoria;
		}

        //função que listas os produtos por categoria e classificação
		public function listarCategoriaClassificacao($idCategoria, $classificacao, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$categoriaDAO = new CategoriaDAO();
			
			//armazenando os dados em uma variável
			$listProdutos = $categoriaDAO->SelectByClassificacao($idCategoria, $classificacao, $termo);
			
			//retornando os dados
			return $listProdutos;
        }
        
        //função que lista os produtos pelo tamanho e categoria
		public function listarCategoriaTamanho($idCategoria, $tamanho, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$categoriaDAO = new CategoriaDAO();
			
			//armazenando os dados em uma variável
			$listProduto = $categoriaDAO->SelectByTamanho($idCategoria, $tamanho, $termo);
			
			//retornando os dados
			return $listProduto;
        }
        
        //função para listar o produto a partir da cor e categoria
		public function listarCategoriaCor($idCategoria, $cor, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$categoriaDAO = new CategoriaDAO();

			//armazenando os dados em uma variável
			$listProduto = $categoriaDAO->selectByCor($idCategoria, $cor, $termo);

			//retornando os dados
			return $listProduto;
        }
        
        //função para listar o produto a partir da marca e categoria
		public function listarCategoriaMarca($idCategoria, $marca, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$categoriaDAO = new CategoriaDAO();

			//armazenando os dados em uma variável
			$listProduto = $categoriaDAO->selectByMarca($idCategoria, $marca, $termo);

			//retornando os dados
			return $listProduto;
		}

		//função que listas os produtos por subcategoria e classificação
		public function listarSubcategoriaClassificacao($idSubcategoria, $classificacao, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$subcategoriaDAO = new SubcategoriaDAO();
			
			//armazenando os dados em uma variável
			$listProdutos = $subcategoriaDAO->SelectByClassificacao($idSubcategoria, $classificacao, $termo);
			
			//retornando os dados
			return $listProdutos;
		}
		
		//função que lista os produtos pelo tamanho e subcategoria
		public function listarSubcategoriaTamanho($idSubcategoria, $tamanho, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$subcategoriaDAO = new SubcategoriaDAO();
			
			//armazenando os dados em uma variável
			$listProduto = $subcategoriaDAO->SelectByTamanho($idSubcategoria, $tamanho, $termo);
			
			//retornando os dados
			return $listProduto;
        }
        
        //função para listar o produto a partir da cor e subcategoria
		public function listarSubcategoriaCor($idSubcategoria, $cor, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$subcategoriaDAO = new SubcategoriaDAO();

			//armazenando os dados em uma variável
			$listProduto = $subcategoriaDAO->selectByCor($idSubcategoria, $cor, $termo);

			//retornando os dados
			return $listProduto;
        }
        
        //função para listar o produto a partir da marca e subcategoria
		public function listarSubcategoriaMarca($idSubcategoria, $marca, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$subcategoriaDAO = new SubcategoriaDAO();

			//armazenando os dados em uma variável
			$listProduto = $subcategoriaDAO->selectByMarca($idSubcategoria, $marca, $termo);

			//retornando os dados
			return $listProduto;
		}
    }
?>