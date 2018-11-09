<?php
    class controllerCategoria{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/categoriaClass.php');
            require_once($diretorio.'model/dao/categoriaDAO.php');
            require_once($diretorio.'model/produtoClass.php');
        }

        public function listarCategoria(){
            
            $categoriaDAO = new CategoriaDAO();
            
            $listCategoria = $categoriaDAO ->selectCategorias();
            
            return $listCategoria;   
        }

        //função que listas os produtos por categoria e classificação
		public function listarCategoriaClassificacao($idCategoria, $classificacao, $pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe ProdutoDAO
			$produtoDAO = new CategoriaDAO();
			
			//armazenando os dados em uma variável
			$listProdutos = $produtoDAO->SelectByClassificacao($idCategoria, $classificacao, $termo);
			
			//retornando os dados
			return $listProdutos;
		}
    }
?>