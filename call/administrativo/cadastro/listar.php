<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/CadastroDAO.php');

echo ListaCadastro();
 
?>