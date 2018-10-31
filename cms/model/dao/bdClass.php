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
            $conexao = new PDO('mysql:host='.$this->server.';dbname='.$this->databaseName, $this->user, $this->password);
            return $conexao;
        }

        public function fecharConexao(){
            $conexao = null;
        }
    }
?>