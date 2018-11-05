<?php
class Divida {
        private $id_divida;
        private $fk_pessoa;
        private $tipo;
        private $descricao;
        private $valor;
        private $comprovante;

        public function getId_divida(){
            return $this->id_divida;
        }
        public function getFk_pessoa(){
            return $this->fk_pessoa;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getDescricao(){
            return $this->descricao;
        }
        public function getValor(){
            return $this->valor;
        }
        public function getComprovante(){
            return $this->comprovante;
        }
        
    
    
        public function setId_divida($value){
            $this->id_divida = $value;
            return $this;
        }
        public function setFk_pessoa($value){
            $this->fk_pessoa = $value;
            return $this;
        }
         public function setTipo($value){
            $this->tipo = $value;
            return $this;
        }
         public function setDescricao($value){
            $this->descricao = $value;
            return $this;
        }
         public function setValor($value){
            $this->valor = $value;
            return $this;
        }
         public function setComprovante($value){
            $this->comprovante = $value;
            return $this;
        }
       
    }



?>