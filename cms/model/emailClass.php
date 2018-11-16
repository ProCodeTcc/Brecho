<?php
    class Email{
        public function __construct(){
            
        }
        
        private $assunto;
        private $email;
        private $mensagem;
        
        public function setAssunto($assunto){
            $this->assunto = $assunto;
        }
        
        public function getAssunto(){
            return $this->assunto;
        }
        
        public function setEmail($email){
            $this->email = $email;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function setMensagem($mensagem){
            $this->mensagem = $mensagem;
        }
        
        public function getMensagem(){
            return $this->mensagem;
        }
    }
?>