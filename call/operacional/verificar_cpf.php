<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/PessoaDAO.php');
require_once($raiz.'/models/model_pessoa.php');

$pessoa = new Pessoa();


 
$pessoa->setCpf($_POST['cpf']);

echo ListaPessoa($pessoa);

?>