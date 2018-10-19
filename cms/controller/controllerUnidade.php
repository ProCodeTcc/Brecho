<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 17/10/2018
		Objetivo: controlar as ações da página de eventos
	*/

	class controllerUnidade{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'cms/model/unidadeClass.php');
			require_once($diretorio.'cms/model/dao/unidadeDAO.php');
			require_once($diretorio.'model/enderecoClass.php');
			require_once($diretorio.'model/dao/enderecoDAO.php');
		}
		
		//função que insere uma unidade
		public function inserirUnidade(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os atributos das caixas de texto
				$nome = $_POST['txtnome'];
				$cep = $_POST['txtcep'];
				$logradouro = $_POST['txtlogradouro'];
				$bairro = $_POST['txtbairro'];
				$cidade = $_POST['txtcidade'];
				$estado = $_POST['txtestado'];
				$numero = $_POST['txtnumero'];
				$loja = $_POST['txtloja'];
			}
			
			//instância da classe Unidade
			$unidadeClass = new Unidade();
			
			//instância da classe Endereço
			$enderecoClass = new Endereco();
			
			//setando os atributos da unidade
			$unidadeClass->setNome($nome);
			$unidadeClass->setIdLoja($loja);
			
			//setando os atributos do endereço
			$enderecoClass->setCep($cep);
			$enderecoClass->setLogradouro($logradouro);
			$enderecoClass->setBairro($bairro);
			$enderecoClass->setCidade($cidade);
			$enderecoClass->setEstado($estado);
			$enderecoClass->setNumero($numero);
			
			//instância da classe unidadeDAO
			$unidadeDAO = new UnidadeDAO();
			
			//instância da classe endereçoDAO
			$enderecoDAO = new EnderecoDAO();
			
			//resgatando o ID da Unidade após a inserção
			$idUnidade = $unidadeDAO->Insert($unidadeClass);
			
			//resgatando o ID do Endereço após a inserção
			$idEndereco = $enderecoDAO->Insert($enderecoClass);
			
			$unidadeDAO->InsertUnidadeEndereco($idUnidade, $idEndereco);
		}
		
		//função para atualizar uma unidade
		public function atualizarUnidade($id, $idEndereco){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//resgatando os valores das caixas de texto
				$nome = $_POST['txtnome'];
				$cep = $_POST['txtcep'];
				$logradouro = $_POST['txtlogradouro'];
				$bairro = $_POST['txtbairro'];
				$cidade = $_POST['txtcidade'];
				$estado = $_POST['txtestado'];
				$numero = $_POST['txtnumero'];
				$loja = $_POST['txtloja'];
				$id = $id;
				$idEndereco = $idEndereco;
			}
			
			//instância da classe Unidade
			$unidadeClass = new Unidade();
			
			//instância da classe Endereço
			$enderecoClass = new Endereco();
			
			//setando os atributos da unidade
			$unidadeClass->setNome($nome);
			$unidadeClass->setIdLoja($loja);
			$unidadeClass->setId($id);
			
			//setando os atributos do endereço
			$enderecoClass->setIdEndereco($idEndereco);
			$enderecoClass->setCep($cep);
			$enderecoClass->setLogradouro($logradouro);
			$enderecoClass->setBairro($bairro);
			$enderecoClass->setCidade($cidade);
			$enderecoClass->setEstado($estado);
			$enderecoClass->setNumero($numero);
			
			//instância da classe UnidadeDAO
			$unidadeDAO = new UnidadeDAO();
			
			//instância da classe EnderecoDAO
			$enderecoDAO = new EnderecoDAO();
			
			//chamada da função que atualiza a unidade
			$unidadeDAO->Update($unidadeClass);
			
			//chamada da função que atualiza o endereço
			$enderecoDAO->Update($enderecoClass);
			
		}
		
		//função que lista as unidades
		public function listarUnidades(){
			//instância da classe unidadeDAO
			$unidadeDAO = new UnidadeDAO();
			
			//armazenando os dados em uma variável
			$listUnidades = $unidadeDAO->selectAll();
			
			//retornando os dados
			return $listUnidades;
		}
		
		//função que busca uma unidade
		public function buscarUnidade($id){
			//instância da classe unidadeDAO
			$unidadeDAO = new UnidadeDAO();
			
			//armazenando o retorno dos dados em uma variável
			$listUnidade = $unidadeDAO->selectByID($id);
			
			//retornando os dados
			return $listUnidade;
		}
		
		//função que lista as lojas
		public function listarLojas(){
			//instância da classe unidadeDAO
			$unidadeDAO = new UnidadeDAO();
			
			//armazenando o retorno da consulta em uma variável
			$listLojas = $unidadeDAO->selectLojas();
			
			//retornando os dados
			return $listLojas;
		}
		
		//função que exclui uma unidade
		public function excluirUnidade($id, $idEndereco){
			//instância da classe unidadeDAO
			$unidadeDAO = new UnidadeDAO();
			
			//chamada da função que deleta uma unidade
			$unidadeDAO->Delete($id, $idEndereco);
		}
	}
?>