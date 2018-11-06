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
        }

        //função que insere as categorias
        public function inserirCategoria(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores das caixas de texto
                $nome = $_POST['txtnome'];
                $genero = $_POST['txtgenero'];
            }

            //instância da classe Categoria
            $categoriaClass = new Categoria();

            //setando os atributos
            $categoriaClass->setNome($nome);
            $categoriaClass->setGenero($genero);

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
                $genero = $_POST['txtgenero'];
            }

            //instância da classe Categoria
            $categoriaClass = new Categoria();

            //setando os atributos
            $categoriaClass->setNome($nome);
            $categoriaClass->setGenero($genero);

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

        public function buscarCategoria($id){
            $categoriaDAO = new CategoriaDAO();

            $listCategoria = $categoriaDAO->selectById($id);

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
    }
?>