<?php
/*
    Projeto: CMS do Brechó
    Autor: Lucas Eduardo
    Data: 05/11/2018
    Objetivo: controlar as ações das categorias
*/

    class controllerCategoria{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
            require_once($diretorio.'/model/categoriaClass.php');
            require_once($diretorio.'/model/dao/categoriaDAO.php');
            require_once($diretorio.'/model/subcategoriaClass.php');
            require_once($diretorio.'/model/dao/subcategoriaDAO.php');
        }

        //função que insere as categorias
        public function inserirCategoria(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores das caixas de texto
                $nome = $_POST['txtnome'];
            }

            //instância da classe Categoria
            $categoriaClass = new Categoria();

            //setando os atributos
            $categoriaClass->setNome($nome);

            //instância da classe CategoriaDAO
            $categoriaDAO = new CategoriaDAO();

            //inserindo e armazenando o status
            $retorno = $categoriaDAO->Insert($categoriaClass);

            //retornando a mensagem
            return $retorno;
        }

        //função para atualizar uma categoria
        public function atualizarCategoria(){
            //verifica se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores das caixas de texto
                $nome = $_POST['txtnome'];
                $id = $_POST['id'];
            }

            //instância da classe Categoria
            $categoriaClass = new Categoria();

            //setando os atributos
            $categoriaClass->setNome($nome);
            $categoriaClass->setId($id);

            //instância da classe CategoriaDAO
            $categoriaDAO = new CategoriaDAO();

            //chamada da função que atualiza a categoria
            $status = $categoriaDAO->Update($categoriaClass);

            //retornando o status
            return $status;
        }

        //função que lista as categorias
        public function listarCategoria(){
            //instância da classe CategoriaDAO
            $categoriaDAO = new CategoriaDAO();

            //armazenando os dados em uma variável
            $listCategoria = $categoriaDAO->selectAll();

            //retornando os dados
            return $listCategoria;
        }

        //função para buscar uma categoria
        public function buscarCategoria($id){
            //instância da classe categoriaDAO
            $categoriaDAO = new CategoriaDAO();

            //armazenando os dados em uma variável
            $listCategoria = $categoriaDAO->selectById($id);

            //retornando os dados
            return $listCategoria;
        }

        //função que exclui uma categoria
        public function excluirCategoria($id){
            //instância da classe CategoriaDAO
            $categoriaDAO = new CategoriaDAO();

            //chamada da função que exclui a categoria
            $status = $categoriaDAO->Delete($id);

            return $status;
        }

        //função que atualiza o status
        public function atualizarStatus($status, $id){
            //instância da classe CategoriaDAO
            $categoriaDAO = new CategoriaDAO();

            $listCategoria = $categoriaDAO->checkStatus();
            $retorno = array('limite' => false);

            if($status == 0){
                if($listCategoria->ativos == 5){
                    $retorno = array('limite' => 'true');
                }else{
                    $categoriaDAO->updateStatus($status, $id);
                }
            }else{
                $categoriaDAO->updateStatus($status, $id);
            }

            return json_encode($retorno);
        }

        //função para inserir uma subcategoria
        public function inserirSubcategoria(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores
                $nome = $_POST['txtnome'];
                $idCategoria = $_POST['idCategoria'];
            }
            
            //instância da classe Subcategoria
            $subcategoriaClass = new Subcategoria();

            //setando os atributos
            $subcategoriaClass->setNome($nome);
            $subcategoriaClass->setIdCategoria($idCategoria);

            //instância da classe SubcategoriaDAO
            $subcategoriaDAO = new SubcategoriaDAO();

            //chamada da função que insere a subcategoria
            $status = $subcategoriaDAO->Insert($subcategoriaClass);

            //retornando os status
            return $status;
        }

        //função para atualizar a subcategoria
        public function atualizarSubcategoria(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores
                $nome = $_POST['txtnome'];
                $id = $_POST['id'];
            }
            
            //instância da classe Subcategoria
            $subcategoriaClass = new Subcategoria();

            //setando os atributos
            $subcategoriaClass->setNome($nome);
            $subcategoriaClass->setId($id);

            //instância da classe SubcategoriaDAO
            $subcategoriaDAO = new SubcategoriaDAO();

            //chamada da função que atualiza a subcategoria
            $status = $subcategoriaDAO->Update($subcategoriaClass);

            //retornando o status
            return $status;
        }

        //função para listar as subcategorias
        public function listarSubcategoria($idCategoria){
            //instância da classe SubcategoriaDAO
            $subcategoriaDAO = new SubcategoriaDAO();

            //armazenando os dados em uma variável
            $listSubcategoria = $subcategoriaDAO->selectAll($idCategoria);

            //retornando os dados
            return $listSubcategoria;
        }

        //função para buscar uma subcategoria
        public function buscarSubcategoria($idSubcategoria){
            //instância da classe SubcategoriaDAO
            $subcategoriaDAO = new SubcategoriaDAO();

            //armazenando os dados em uma variável
            $listSubcategoria = $subcategoriaDAO->selectByID($idSubcategoria);

            //retornando os dados
            return $listSubcategoria;
        }

        public function excluirSubcategoria($idSubcategoria){
            $subcategoriaDAO = new SubcategoriaDAO();

            $subcategoriaDAO->Delete($idSubcategoria);
        }
    }
?>