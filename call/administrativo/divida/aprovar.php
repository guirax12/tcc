<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/NegativacaoDAO.php');

$divida = new Divida();
$usuario = new Usuario();

session_start();
$user = $_SESSION['usuarioid'];

$divida->setId_divida($_POST['idAlterar']);
$usuario->setId_usuario($user); 

echo ValidaNegativacao($divida->getId_divida(),$usuario->getId_usuario(),1);

?>