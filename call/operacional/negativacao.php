<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/NegativacaoDAO.php');

$pessoa = new Pessoa();
$divida = new Divida();


 
$pessoa->setNome($_POST['nome']);
$pessoa->setEmail($_POST['email']);
$pessoa->setCep($_POST['cep']);
$pessoa->setEndereco($_POST['endereco']);
$pessoa->setNumero($_POST['numero']);
$pessoa->setBairro($_POST['bairro']);
$pessoa->setComplemento($_POST['complemento']);
$pessoa->setCidade($_POST['cidade']);
$pessoa->setEstado($_POST['estado']);
$pessoa->setTelefone($_POST['telefone']);
$pessoa->setCpf($_POST['cpf2']);

$divida->setTipo($_POST['divida']);
$divida->setDescricao($_POST['desc']);
$divida->setValor($_POST['valor']);
$divida->setComprovante($_FILES['doc']);

CadastrarNegativacao($pessoa,$divida);


//echo CadastrarSolicitacao($cadastro);

?>