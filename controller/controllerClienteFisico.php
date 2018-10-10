<?php

    /*
        Projeto: Brechó
        Autor:  Felipe Monteiro
        Data: 10/10/2018
        Objetivo: controlar as ações da página de cadastro de usuario
        
    */

    class controllerClienteFisico{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once ($diretorio.'model/clienteFisicoClass.php');
            require_once ($diretorio.'model/dao/clienteFisicoDAO.php');
                    
        }
        
        public function inserirCliente(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
            
                $nome = $_POST['txtNome'];
                $sobrenome = $_POST['txtSobrenome'];
                $telefone = $_POST['txtTelefone'];
                $celular = $_POST['txtCelular'];
                $email = $_POST['txtEmail'];
                $cpf = $_POST['txtCpf'];
                $dataNascimento = $_POST['txtDataNasc'];
                $login = $_POST['txtUsuario'];
                $senha = $_POST['txtSenha'];
                $sexo = $_POST['rb_sexo'];
            
            }
            
            //Instancia da classe Cliente Fisico
            $clienteFisicoClass = new ClienteFisico();
            
            $clienteFisicoClass->setNome($nome);
            $clienteFisicoClass->setSobrenome($sobrenome);
            $clienteFisicoClass->setTelefone($telefone);
            $clienteFisicoClass->setCelular($celular);
            $clienteFisicoClass->setEmail($email);
            $clienteFisicoClass->setCpf($cpf);
            $clienteFisicoClass->setDataNascimento($dataNascimento);
            $clienteFisicoClass->setLogin($login);
            $clienteFisicoClass->setSenha($senha);
            $clienteFisicoClass->setSexo($sexo);
            
            //instancia da classe ClienteFicicoDAO
            $clienteFisicoDAO = new ClienteFisicoDAO();
            
            //Chamada da função para inserir dados
            $clienteFisicoDAO::Insert($clienteFisicoClass);
        }
    
    }




?>