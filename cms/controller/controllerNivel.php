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

		//função que insere um nível
        public function inserirNivel(){
			//verifica se o método é POST
            if($_SERVER['REQUEST_METHOD'] == "POST"){
				//resgata o valor da caixa de texto
                $nome = $_POST['txtnome'];
            }
			
			//instância da classe Nivel
            $nivelClass = new Nivel();

			//setando o atributo
            $nivelClass->setNome($nome);

			//instância da classe NivelDAO
            $nivelDAO = new NivelDAO();
			
			//chamada da função que insere um nível
         	$nivelDAO->Insert($nivelClass);
        }
		
		//função que exclui um nível
        public function excluirNivel($id){
			//instância da classe nivelDAO
            $nivelDAO = new NivelDAO();
			
			//chamada da função que deleta um nível
            $nivelDAO->Delete($id);
        }
		
		//função que lista todo os níveis
        public function listarNiveis(){
			//instância da classe NivelDAO
            $nivelDAO = new NivelDAO();

			//armazenando o retorno da consulta em uma variável
            $listNiveis = $nivelDAO->selectAll();

			//retornando uma lista com os níveis
            return $listNiveis;
        }
		
		//função que lista as páginas
		public function listarPaginas(){
			//instância da classe NívelDAO
			$nivelDAO = new NivelDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listPaginas = $nivelDAO->selectPaginas();
			
			//retornando a lista com as páginas
			return $listPaginas;
		}

		//função que busca um nível
        public function buscarNivel($id){
			//instância da classe NívelDAO
            $nivelDAO = new NivelDAO();
			
			//armazenando o retorno da consulta em uma variável
            $listNivel = $nivelDAO->SelectByID($id);

			//retornando a lista com o nível
            return $listNivel;
        }

		//função que atualiza um nível
        public function atualizarNivel($id){
			//verifica se o método é POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando o valor da caixa de texto
                $nome = $_POST['txtnome'];
            }
			
			//instância da classe nível
            $nivelClass = new Nivel();
			
			//setando os atributos
            $nivelClass->setId($id);
            $nivelClass->setNome($nome);

			//instância da classe NivelDAO
            $nivelDAO = new NivelDAO();
			
			//chamada da função que deleta um nível
            $nivelDAO->Update($nivelClass);
        }

		//função que atualiza o status
        public function atualizarStatus($id, $status){
			//instância da classe nivelDAO
            $nivelDAO = new NivelDAO();
			
			//chamada da função que deleta um nível
            $nivelDAO->updateStatus($id, $status);
        }
		
		//função que permite o acesso á uma página
		public function permitirPagina($idNivel, $idPagina){
			//instância da classe nívelDAO
			$nivelDAO = new NivelDAO();
			
			//chamada da função que permite uma página
			$nivelDAO->permitirPagina($idNivel, $idPagina);
		}
		
		//função que remove o acesso a uma página
		public function retirarPermissao($idNivel, $idPagina){
			//instância da classe nívelDAO
			$nivelDAO = new NivelDAO();
			
			//chamada da função que retira a permissão
			$nivelDAO->retirarPermissao($idNivel, $idPagina);
		}
		
		//função que verifica qual a permissão necessária
		//para acessar uma página
		public function checarPermissao($idNivel, $idPagina){
			//instância da classe nivelDAO
			$nivelDAO = new NivelDAO();
			
			//chamada da função que deleta um nível
			$nivelDAO->checarPermissao($idNivel, $idPagina);
		}

		//função para pesquisar um nível
		public function pesquisarNivel($pesquisa){
			//formatando a pesquisa
			$termo = '%'.$pesquisa.'%';

			//instância da classe NivelDAO
			$nivelDAO = new NivelDAO();

			//armazenando os dados em uma variável
			$listNiveis = $nivelDAO->searchNivel($termo);

			//retornando os dados
			return $listNiveis;
		}
    }
?>