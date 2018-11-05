<?php
class Pessoa {
        private $id_pessoa;
        private $nome;
        private $cpf;
        private $cep;
        private $endereco;
        private $cidade;
        private $complemento;
        private $bairro;
        private $estado;
        private $numero;
        private $telefone;
        private $email;

        public function getId_pessoa(){
            return $this->id_pessoa;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getCpf(){
            return $this->cpf;
        }
        public function getCep(){
            return $this->cep;
        }
        public function getEndereco(){
            return $this->endereco;
        }
        public function getNumero(){
            return $this->numero;
        }
        public function getTelefone(){
            return $this->telefone;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getComplemento(){
            return $this->complemento;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function getBairro(){
            return $this->bairro;
        }
        public function getCidade(){
            return $this->cidade;
        }
    
    
        public function setId_pessoa($value){
            $this->id_pessoa = $value;
            return $this;
        }
        public function setNome($value){
            $this->nome = $value;
            return $this;
        }
        public function setCpf($value){
            $this->cpf = $value;
            return $this;
        }
        public function setCep($value){
            $this->cep = $value;
            return $this;
        }
        public function setEndereco($value){
            $this->endereco = $value;
            return $this;
        }
        public function setNumero($value){
            $this->numero = $value;
            return $this;
        }
        public function setTelefone($value){
            $this->telefone = $value;
            return $this;
        }
        public function setEmail($value){
            $this->email = $value;
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
        public function setBairro($value){
            $this->bairro = $value;
            return $this;
        }
    }



?>