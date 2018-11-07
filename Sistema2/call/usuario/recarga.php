<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

session_start();

$id = $_SESSION['usuarioid'];


$valor =$_POST['valor'];




echo AtualizaSaldoCompra($id,$valor);

?>