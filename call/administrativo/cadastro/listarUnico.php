<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/CadastroDAO.php');

$cadastro = new Cadastro();
$aux_cadastro = new Cadastro();

$cadastro->setId_cadastro($_POST['idAlterar']);

$aux_cadastro = ListarUnicoCadastro($cadastro->getId_cadastro());

$foto = $aux_cadastro->getAvatar();





$array = array("razaosocial" => $aux_cadastro->getRazao_social(),
			   "nomefantasia" => $aux_cadastro->getNome_fantasia(),
			   "cnpj" => $aux_cadastro->getCnpj(),
			   "cep" => $aux_cadastro->getCep(),
			   "foto" => $foto,
			   "logradouro" => $aux_cadastro->getLogradouro(),
			   "numero" => $aux_cadastro->getNumero(),
			   "bairro" => $aux_cadastro->getBairro(),
			   "complemento" => $aux_cadastro->getComplemento(),
			   "cidade" => $aux_cadastro->getCidade(),
			   "estado" => $aux_cadastro->getEstado(),
			   "bloqueado" => $aux_cadastro->getBloqueado(),
			   "email" => $aux_cadastro->getEmail(),
			   "telefone" => $aux_cadastro->getTelefone()

);

echo json_encode($array);

?>