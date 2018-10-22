<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 21/10/2018
		Objetivo: controlar as ações do cliente
	*/
	class controllerClienteJuridico{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/clienteJuridicoClass.php');
			require_once($diretorio.'model/dao/clienteJuridicoDAO.php');
			require_once($diretorio.'model/enderecoClass.php');
		}
		
		public function inserirCliente(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$razao = $_POST['txtRazao'];
				$email = $_POST['txtEmail'];
				$usuario = $_POST['txtUsuario'];
				$senha = $_POST['txtSenha'];
				$telefone = $_POST['txtTelefone'];
				$celular = $_POST['txtCelular'];
				$cnpj = $_POST['txtCnpj'];
				$cep = $_POST['txtCep'];
				$bairro = $_POST['txtbairro'];
				$logradouro = $_POST['txtLogradouro'];
				$estado = $_POST['txtEstado'];
				$cidade = $_POST['txtCidade'];
				$numero = $_POST['txtNumero'];
				$complemento = $_POST['txtComplemento'];
			}
			
			$clienteClass = new ClienteJuridico();
			$enderecoClass = new Endereco();
			
			$clienteClass->setRazaoSocial($razao);
			$clienteClass->setEmail($email);
			$clienteClass->setLogin($usuario);
			$clienteClass->setSenha($senha);
			$clienteClass->setTelefone($telefone);
			$clienteClass->setCelular($celular);
			$clienteClass->setCnpj($cnpj);
			
			$enderecoClass->setCep($cep);
			$enderecoClass->setBairro($bairro);
			$enderecoClass->setLogradouro($logradouro);
			$enderecoClass->setEstado($estado);
			$enderecoClass->setCidade($cidade);
			$enderecoClass->setNumero($numero);
			$enderecoClass->setComplemento($complemento);
			
			$clienteDAO = new ClienteJuridicoDAO();
			$enderecoDAO = new EnderecoDAO();
			
			$idCliente = $clienteDAO->Insert($clienteClass);
			$idEndereco = $enderecoDAO->Insert($enderecoClass);
			
			$clienteDAO->InsertClienteEndereco($idEndereco, $idCliente);
		}
		
		public function atualizarCliente(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$razao = $_POST['txtrazao'];
				$email = $_POST['txtemail'];
				$senha = $_POST['txtsenha'];
				$telefone = $_POST['txttelefone'];
				$celular = $_POST['txtcelular'];
				$cnpj = $_POST['txtcnpj'];
				$cep = $_POST['txtcep'];
				$bairro = $_POST['txtbairro'];
				$logradouro = $_POST['txtlogradouro'];
				$estado = $_POST['txtestado'];
				$cidade = $_POST['txtcidade'];
				$numero = $_POST['txtnumero'];
				$complemento = $_POST['txtcomplemento'];
				$id = $_POST['id'];
				$idEndereco = $_POST['idEndereco'];
			}
			
			$clienteClass = new ClienteJuridico();
			$enderecoClass = new Endereco();
			
			$clienteClass->setIdCliente($id);
			$clienteClass->setRazaoSocial($razao);
			$clienteClass->setEmail($email);
			$clienteClass->setSenha($senha);
			$clienteClass->setTelefone($telefone);
			$clienteClass->setCelular($celular);
			$clienteClass->setCnpj($cnpj);
			
			$enderecoClass->setIdEndereco($idEndereco);
			$enderecoClass->setCep($cep);
			$enderecoClass->setBairro($bairro);
			$enderecoClass->setLogradouro($logradouro);
			$enderecoClass->setEstado($estado);
			$enderecoClass->setCidade($cidade);
			$enderecoClass->setNumero($numero);
			$enderecoClass->setComplemento($complemento);
			
			$clienteDAO = new ClienteJuridicoDAO();
			$enderecoDAO = new EnderecoDAO();
			
			$clienteDAO->Update($clienteClass);
			$enderecoDAO->Update($enderecoClass);
		}
		
		public function buscarCliente($id){
			$clienteDAO = new ClienteJuridicoDAO();
			
			$listCliente = $clienteDAO->SelectByID($id);
			
			return $listCliente;
		}
	}
?>