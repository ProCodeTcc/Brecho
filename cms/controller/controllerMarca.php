<?php
    /*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 25/11/2018
        Objetivo: controlar as ações das marcas
    */

    class controllerMarca{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
            require_once($diretorio.'/model/marcaClass.php');
            require_once($diretorio.'/model/dao/marcaDAO.php');
        }
        
        //função para inserir a marca
        public function inserirMarca(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores
                $nome = $_POST['txtnome'];
            }
            
            //criando uma nova marca
            $marcaClass = new Marca();
            
            //setando o atributo
            $marcaClass->setNome($nome);
            
            //instância da classe MarcaDAO
            $marcaDAO = new MarcaDAO();
            
            //chamada da função que insere a marca
            $status = $marcaDAO->Insert($marcaClass);
            
            //retornando o status
            return $status;
        }
        
        public function atualizarMarca(){
            //verificando se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //resgatando os valores
                $nome = $_POST['txtnome'];
                $id = $_POST['id'];
            }
            
            //criando uma nova marca
            $marcaClass = new Marca();
            
            //setando o atributo
            $marcaClass->setId($id);
            $marcaClass->setNome($nome);
            
            //instância da classe MarcaDAO
            $marcaDAO = new MarcaDAO();
            
            //chamada da função que insere a marca
            $status = $marcaDAO->Update($marcaClass);
            
            //retornando o status
            return $status;
        }
        
        //função para listar as marca
        public function listarMarca(){
            //istância da classe MarcaDAO
            $marcaDAO = new MarcaDAO();
            
            //armazenando os dados em uma variável
            $listMarca = $marcaDAO->selectAll();
            
            //retornando os dados
            return $listMarca;
        }
        
        //função para buscar uma marca
        public function buscarMarca($id){
            //istância da classe MarcaDAO
            $marcaDAO = new MarcaDAO();
            
            //armazenando os dados em uma variável
            $listMarca = $marcaDAO->selectByID($id);
            
            //retornando os dados
            return $listMarca;
        }
        
        //função para excluir uma marca
        public function excluirMarca($id){
            //instância da classe MarcaDAO
            $marcaDAO = new MarcaDAO();
            
            //chamada da função que exclui a marca
            $status = $marcaDAO->Delete($id);
            
            //retornando o status
            return $status;
        }
        
        //função para pesquisar uma marca
        public function pesquisarMarca($pesquisa){
            //formatando a pesquisa
            $termo = '%'.$pesquisa.'%';
            
            //instância da classe MarcaDAO
            $marcaDAO = new MarcaDAO();
            
            //armazenando os dados em uma variável
            $listMarca = $marcaDAO->searchMarca($termo);
            
            //retornando os dados
            return $listMarca;
        }
    }
?>