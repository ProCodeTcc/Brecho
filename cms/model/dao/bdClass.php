<?php
    class ConexaoMySQL{
        private $server;
        private $user;
        private $password;
        private $databaseName;

        public function __construct(){
            $this->server = 'localhost';
            $this->user = 'root';
            $this->password = 'bcd127';
            $this->databaseName = 'brecho';
        }

        public function conectarBanco(){
            $conexao = new PDO('mysql:host='.$this->server.';dbname='.$this->databaseName.';charset=utf8', $this->user, $this->password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $conexao;
        }

        public function fecharConexao(){
            $conexao = null;
        }
    }
?>