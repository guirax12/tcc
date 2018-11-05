<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');



echo ListaPessoa($_POST['cpf']);

?>