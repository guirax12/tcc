<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/CadastroDAO.php');
require_once($raiz.'/models/model_cadastro.php');

$cadastro = new Cadastro();

$cadastro->setId_cadastro($_POST['idAlterar']);


echo ValidaCadastroEmpresa($cadastro->getId_cadastro());
 
?>