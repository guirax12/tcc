<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

$usuario = new Usuario();

$usuario->setNome($_POST['nome']);
$usuario->setSenha($_POST['senha2']);
$usuario->setEmail($_POST['email']);
$usuario->setAvatar($_FILES['foto2']);

echo CadastraUsuario($usuario);

?>