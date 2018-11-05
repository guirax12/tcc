<?php
class Usuario {
        private $id_usuario;
        private $nome;
        private $email;
        private $credito;
        private $senha;
        private $bloqueado;
        private $avatar;

        public function getId_usuario(){
            return $this->id_usuario;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getEmail(){
            return $this->email;
        }
      public function getCredito(){
            return $this->credito;
        }
        public function getSenha(){
            return $this->senha;
        }
        public function getBloqueado(){
            return $this->bloqueado;
        }
        public function getAvatar(){
            return $this->avatar;
        }
    
    
        public function setId_usuario($value){
            $this->id_usuario = $value;
            return $this;
        }
        public function setNome($value){
            $this->nome = $value;
            return $this;
        }
        public function setCredito($value){
            $this->credito = $value;
            return $this;
        }
        public function setEmail($value){
            $this->email = $value;
            return $this;
        }
        public function setSenha($value){
            $this->senha = $value;
            return $this;
        }
        public function setBloqueado($value){
            $this->bloqueado = $value;
            return $this;
        }
        public function setAvatar($value){
            $this->avatar = $value;
            return $this;
        }
    }



?>