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
    	
		//função que busca no banco de dados a conta do cliente
        public function BuscarConta(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
				//resgatando os valores das caixas de texto
                $usuario = $_POST['txtLogin'];
                $senha = $_POST['txtSenha'];
            }  
			
			//instância da classe loginDAO
			$loginDAO = new LoginDAO();
			
			//verifica qual o tipo do cliente
			if($_POST['txtcliente'] == "F"){
				//loga o cliente físico
				$status = $loginDAO->Select($usuario, $senha);
			}else{
				//loga o cliente jurídico
				$status = $loginDAO->logarClienteJuridico($usuario, $senha);
            }
            
            return $status;
			
          }
		
		public function deslogar(){
			session_start();
			session_destroy();
		}
    }

?>