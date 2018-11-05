<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include ($raiz.'/DAO/UsuarioDAO.php');


$usuario = new usuario();
session_start();
$usuario->setId_usuario($_SESSION['usuarioid']);


echo RetornaMenu($usuario);

?>