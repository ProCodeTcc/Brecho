<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 05/10/2018
		Objetivo: controlar as ações da página de eventos
	*/

	class controllerEvento{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/eventoClass.php');
			require_once($diretorio.'model/dao/eventoDAO.php');
			require_once($diretorio.'model/imagemClass.php');
		}
		
		//função que insere um evento
		public function inserirEvento(){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os dados das caixas de texto
				$nome = $_POST['txtnome'];
				$descricao = $_POST['txtdesc'];
				$dtInicio = $_POST['dtinicio'];
				$dtTermino = $_POST['dttermino'];
				$loja = $_POST['txtloja'];
			}
			
			//instância da classe Evento
			$eventoClass = new Evento();
			
			//verificando se existe alguma imagem
			if(!empty($_FILES['fleimagem'])){
				//instância da classe Imagem
				$imagemClass = new Imagem();
				
				//armazenando o caminho da imagem em uma variável
				$imagem = $imagemClass->uploadImagem();
			}
			
			//setando os atributos
			$eventoClass->setNome($nome);
			$eventoClass->setDescricao($descricao);
			$eventoClass->setIdLoja($loja);
			$eventoClass->setDtInicio($dtInicio);
			$eventoClass->setDtTermino($dtTermino);
			$eventoClass->setImagem($imagem);
			
			//instância da classe EventoDAO
			$eventoDAO = new EventoDAO();
			
			//armazenando o ID do evento inserido
			$idEvento = $eventoDAO->Insert($eventoClass);
			
			$eventoDAO->InsertEventoLoja($idEvento, $eventoClass);
		}
		
		//função que atualiza os dados
		public function atualizarEvento(){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os dados das caixas de texto
				$nome = $_POST['txtnome'];
				$descricao = $_POST['txtdesc'];
				$dtInicio = $_POST['dtinicio'];
				$dtTermino = $_POST['dttermino'];
				$loja = $_POST['txtloja'];
				$id = $_POST['id'];
			}
			
			//instância da classe Evento
			$eventoClass = new Evento();
			
			if($_FILES['fleimagem']['size'] == 0){
				$imagem = $_POST['imagem'];
			}else{
				$imagemClass = new Imagem();
				$imagem = $imagemClass->uploadImagem();
			}
			
			//setando os atributos
			$eventoClass->setId($id);
			$eventoClass->setNome($nome);
			$eventoClass->setDescricao($descricao);
			$eventoClass->setIdLoja($loja);
			$eventoClass->setDtInicio($dtInicio);
			$eventoClass->setDtTermino($dtTermino);
			$eventoClass->setImagem($imagem);
			
			//instância da classe EventoDAO
			$eventoDAO = new EventoDAO();
			
			//atualizando o evento
			$eventoDAO->Update($eventoClass);
			
			//atualizando a data
			$eventoDAO->UpdateData($eventoClass);
		}
		
		//função que lista os eventos
		public function listarEvento(){
			//instância da classe EventoDAO
			$eventoDAO = new EventoDAO();
			
			//armazenando os dados em uma variável
			$listEvento = $eventoDAO->selectAll();
			
			//retornando os dados
			return $listEvento;
		}
		
		//função que busca um evento
		public function buscarEvento($id){
			//instância da classe EventoDAO
			$eventoDAO = new EventoDAO();
			
			//armazenando o resultado em uma variável
			$listEvento = $eventoDAO->SelectById($id);
			
			//retornando a lista com os eventos
			return $listEvento;
		}
		
		//função que atualiza o status
		public function atualizarStatus($id, $status){
			//instância da classe eventoDAO
			$eventoDAO = new EventoDAO();
			
			//chamada da função que atualiza o status
			$eventoDAO->updateStatus($id, $status);
		}
		
		//função que exclui um evento
		public function excluirEvento($id){
			//instância da classe eventoDAO
			$eventoDAO = new EventoDAO();
			
			//chamada da função que exclui um evento
			$eventoDAO->Delete($id);
		}
		
		//função que lista as lojas
		public function listarLojas(){
			//instância da classe EventoDAO
			$eventoDAO = new EventoDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listLojas = $eventoDAO->selectLojas();
			
			//retornando os dados
			return $listLojas;
		}
	}
?>