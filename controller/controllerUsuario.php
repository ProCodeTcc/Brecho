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

            $listUsuarios = $usuarioDAO->SelectByID($id);

            return $listUsuarios;
        }

        public function listarUsuarios(){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

            $listUsuarios = $usuarioDAO->selectAll();

            return $listUsuarios;
        }

        public function listarNiveis(){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

            $listNiveis = $usuarioDAO->selectNivel();

            return $listNiveis;
        }

        public function excluirUsuario($id){
            //instancia da classe usuarioDAO
            $usuarioDAO = new UsuarioDAO();

            $usuarioDAO->excluir($id);
        }

        public function logarUsuario($usuario, $senha){
            $encryptSenha = md5($senha);
            $usuarioDAO = new UsuarioDAO();
            return $usuarioDAO->logar($usuario, $encryptSenha);
        }

        public function atualizarStatus($id, $status){
            $usuarioDAO = new UsuarioDAO();

            $usuarioDAO->updateStatus($id, $status);
        }
    }
?>