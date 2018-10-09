<?php
    /*
        Projeto: CMS do Brechó
        Autor: Lucas Eduardo
        Data: 20/09/2018
        Objetivo: controlar as ações da página de usuários

    */

    class controllerUsuario{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
            require_once($diretorio.'/model/usuarioClass.php');
            require_once($diretorio.'/model/dao/usuarioDAO.php');
        }

        public function inserirUsuario(){
            //resgatando os dados das caixas de texto
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['txtnome'];
                $usuario = $_POST['txtusuario'];
                $nivel = $_POST['txtnivel'];
                $senha = $_POST['txtsenha'];

                $encryptSenha = md5($senha);

                $imagem = $_POST['txtimagem'];

            }

            //instancia da classe usuario
            $usuarioClass = new Usuario();
			
			//setando os atributos do usuário
            $usuarioClass->setImagem($imagem);
            $usuarioClass->setNome($nome);
            $usuarioClass->setUsuario($usuario);
            $usuarioClass->setNivel($nivel);
            $usuarioClass->setSenha($encryptSenha);

            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

            //chamada da função para inserção de dados
            $usuarioDAO::Insert($usuarioClass);
        }

        public function atualizarContato($id){
            //resgatando os dados das caixas de texto
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['txtnome'];
                $usuario = $_POST['txtusuario'];
                $nivel = $_POST['txtnivel'];
                $senha = $_POST['txtsenha'];

                $encryptSenha = md5($senha);

                $imagem = $_POST['txtimagem'];
            }

            //instancia da classe usuario
            $usuarioClass = new Usuario();

            $usuarioClass->setId($id);
            $usuarioClass->setImagem($imagem);
            $usuarioClass->setNome($nome);
            $usuarioClass->setUsuario($usuario);
            $usuarioClass->setNivel($nivel);
            $usuarioClass->setSenha($encryptSenha);

            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

            //chamada da função de atualizar os dados
            $usuarioDAO->Update($usuarioClass);
        }

        public function buscarUsuario($id){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();
			
			//armazenando os dados da consulta em uma variável
            $listUsuarios = $usuarioDAO->SelectByID($id);

			//retornando a lista com os dados
            return $listUsuarios;
        }

        public function listarUsuarios(){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

			//armazenando o retorno da consulta em uma variável
            $listUsuarios = $usuarioDAO->selectAll();
			
			//retornando a lista com os usuários
            return $listUsuarios;
        }

        public function listarNiveis(){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

			//armazenando o retorno da consulta em uma variável
            $listNiveis = $usuarioDAO->selectNivel();

			//retornando a lista com os níveis
            return $listNiveis;
        }

        public function excluirUsuario($id){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

			//excluindo o usuário
            $usuarioDAO->excluir($id);
        }

        public function logarUsuario($usuario, $senha){
			//encriptando a senha recebida para MD5
            $encryptSenha = md5($senha);
			
			//instância da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();
			
			//retornando o resultado da função que loga o usuário
            return $usuarioDAO->logar($usuario, $encryptSenha);
        }

        public function atualizarStatus($id, $status){
			//instância da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

			//chamando o método que atualiza o status do usuário
            $usuarioDAO->updateStatus($id, $status);
        }
		
		public function totalUsuarios(){
			$usuarioDAO = new UsuarioDAO();
			
			$totalUsuarios = $usuarioDAO->totalUsuarios();
			
			return $totalUsuarios;
		}
		
		public function usuariosAtivos(){
			$usuarioDAO = new UsuarioDAO();
			
			$usuariosAtivos = $usuarioDAO->usuariosAtivos();
			
			return $usuariosAtivos;
		}
		
		public function deslogarUsuario(){
			//iniciando a sessão
			session_start();
			
			//destruíndo a sessão
			session_destroy();
		}
		
		public function checarLogin(){
			//vericicando se a sessão existe
			if(!isset($_SESSION['usuario'])){
				//se não existir, redireciona o usuário pra página de login
				header("location: ../../index.php");
			}
		}
    }
?>