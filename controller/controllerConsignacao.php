<?php
    class controllerConsignacao{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/consignacaoClass.php');
            require_once($diretorio.'model/dao/clienteFisicoDAO.php');
            require_once($diretorio.'model/dao/clienteJuridicoDAO.php');
        }
        
        //função para filtrar a consignação
        public function filtrarConsignacao($tipoCliente, $idCliente){
            //verificando o tipo do cliente
            if($tipoCliente == 'F'){
                //instância da classe CLienteFisicoDAO
                $clienteFisicoDAO = new ClienteFisicoDAO();
                
                //armazenando os dados em uma variável
                $listConsignacao = $clienteFisicoDAO->selectConsignacao($idCliente);
            }else{
                //instância da classe CLienteJuridicoDAO
                $clienteJuridicoDAO = new ClienteJuridicoDAO();
                
                //armazenando os dados em uma variável
                $listConsignacao = $clienteJuridicoDAO->selectConsignacao($idCliente);
            }
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($cont < count($listConsignacao)){
                //formatando a data para o padrão brasileiro
                $data = date('d/m/Y', strtotime($listConsignacao[$cont]->getDtTermino()));
                
                //setando a data formatada
                $listConsignacao[$cont]->setDtTermino($data);
                
                //incrementando o contador
                $cont++;
            }
            
            //retornando os dados
            return $listConsignacao;
        }
    }
?>