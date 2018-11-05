<?php
class Cadastro {
        private $id_cadastro;
        private $razao_social;
        private $nome_fantasia;
        private $cnpj;
        private $inscricao_estadual;
        private $cep;
        private $logradouro;
        private $avatar;
        private $numero;
        private $bairro;
        private $complemento;
        private $cidade;
        private $estado;
        private $email;
        private $telefone;
        private $bloqueado;


        public function getId_cadastro(){
            return $this->id_cadastro;
        }
        public function getRazao_social(){
            return $this->razao_social;
        }
        public function getNome_Fantasia(){
            return $this->nome_fantasia;
        }
        public function getCNPJ(){
            return $this->cnpj;
        }
        public function getInscricao_Estadual(){
            return $this->inscricao_estadual;
        }
        public function getCep(){
            return $this->cep;
        }
        public function getLogradouro(){
            return $this->logradouro;
        }
        public function getAvatar(){
            return $this->avatar;
        }
         public function getNumero(){
            return $this->numero;
        }
        public function getBairro(){
            return $this->bairro;
        }
        public function getComplemento(){
            return $this->complemento;
        }
        public function getCidade(){
            return $this->cidade;
        }
          public function getEstado(){
            return $this->estado;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getTelefone(){
            return $this->telefone;
        }
        public function getBloqueado(){
            return $this->bloqueado;
        }
    
    
        public function setId_cadastro($value){
            $this->id_cadastro = $value;
            return $this;
        }
         public function setRazao_social($value){
            $this->razao_social = $value;
            return $this;
        }
         public function setNome_fantasia($value){
            $this->nome_fantasia = $value;
            return $this;
        }
         public function setCnpj($value){
            $this->cnpj = $value;
            return $this;
        }
         public function setInscricao_estadual($value){
            $this->inscricao_estadual = $value;
            return $this;
        }
         public function setCep($value){
            $this->cep = $value;
            return $this;
        }
         public function setLogradouro($value){
            $this->logradouro = $value;
            return $this;
        }
         public function setAvatar($value){
            $this->avatar = $value;
            return $this;
        }
         public function setNumero($value){
            $this->numero= $value;
            return $this;
        }
         public function setBairro($value){
            $this->bairro = $value;
            return $this;
        }
         public function setComplemento($value){
            $this->complemento = $value;
            return $this;
        }
         public function setCidade($value){
            $this->cidade = $value;
            return $this;
        }
          public function setEstado($value){
            $this->estado = $value;
            return $this;
        }

         public function setTelefone($value){
            $this->telefone = $value;
            return $this;
        }
         public function setBloqueado($value){
            $this->bloqueado = $value;
            return $this;
        }
        public function setEmail($value){
            $this->email = $value;
            return $this;
        }
        
    }



?>