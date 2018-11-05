<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/CadastroDAO.php');

$cadastro = new Cadastro();


 
$cadastro->setRazao_Social($_POST['razao']);
$cadastro->setNome_Fantasia($_POST['nome']);
$cadastro->setCNPJ($_POST['cnpj']);
$cadastro->setInscricao_Estadual($_POST['ie']);
$cadastro->setCep($_POST['cep']);
$cadastro->setLogradouro($_POST['logradouro']);
$cadastro->setNumero($_POST['numero']);
$cadastro->setBairro($_POST['bairro']);
$cadastro->setComplemento($_POST['complemento']);
$cadastro->setCidade($_POST['cidade']);
$cadastro->setEstado($_POST['estado']);
$cadastro->setTelefone($_POST['telefone']);
$cadastro->setEmail($_POST['email']);
$cadastro->setAvatar($_FILES['foto']);

echo CadastrarSolicitacao($cadastro);

?>