<?php
    /*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: controlar as ações da página de níveis

    */

    class controllerNivel{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
            require_once($diretorio.'/model/nivelClass.php');
			require_once($diretorio.'/model/paginaClass.php');
            require_once($diretorio.'/model/dao/nivelDAO.php');
        }

        public function inserirNivel(){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $nome = $_POST['txtnome'];
            }

            $nivelClass = new Nivel();

            $nivelClass->setNome($nome);

            $nivelDAO = new NivelDAO();

         	$nivelDAO->Insert($nivelClass);
        }

        public function excluirNivel($id){
            $nivelDAO = new NivelDAO();

            $nivelDAO->Delete($id);
        }

        public function listarNiveis(){
            $nivelDAO = new NivelDAO();

            $listNiveis = $nivelDAO->selectAll();

            return $listNiveis;
        }
		
		public function listarPaginas(){
			$nivelDAO = new NivelDAO();
			
			$listPaginas = $nivelDAO->selectPaginas();
			
			return $listPaginas;
		}

        public function buscarNivel($id){
            $nivelDAO = new NivelDAO();
			
            $listNivel = $nivelDAO->SelectByID($id);

            return $listNivel;
        }

        public function atualizarNivel($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['txtnome'];
            }

            $nivelClass = new Nivel();
            $nivelClass->setId($id);
            $nivelClass->setNome($nome);

            $nivelDAO = new NivelDAO();
            $nivelDAO->Update($nivelClass);
        }

        public function atualizarStatus($id, $status){
            $nivelDAO = new NivelDAO();
            $nivelDAO->updateStatus($id, $status);
        }
		
		public function permitirPagina($idNivel, $idPagina){
			$nivelDAO = new NivelDAO();
			$nivelDAO->permitirPagina($idNivel, $idPagina);
		}
		
		public function retirarPermissao($idNivel, $idPagina){
			$nivelDAO = new NivelDAO();
			$nivelDAO->retirarPermissao($idNivel, $idPagina);
		}
		
		public function checarPermissao($idNivel, $idPagina){
			$nivelDAO = new NivelDAO();
			$nivelDAO->checarPermissao($idNivel, $idPagina);
		}
    }
?>