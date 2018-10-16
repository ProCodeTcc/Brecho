<?php
    
    /*
        Projeto: Brechó
        Autor:  Felipe Monteiro
        Data: 16/10/2018
        Objetivo: controlar as ações do login

    */

    class controllerLogin{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/loginClass.php');
            require_once($diretorio.'model/dao/loginDAO.php');
            
        }
    
        public function BuscarConta(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $login = $_POST['txtLogin'];
                $senha = $_POST['txtSenha'];
                
                $loginDAO = new LoginDAO();
                
                $listLogin = $loginDAO->select($login);
                $listLogin = $loginDAO->select($senha);
                
                return $listLogin;
                
            }
            
            
                
            }
            
        }
    



?>