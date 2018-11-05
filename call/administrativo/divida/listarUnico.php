<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/NegativacaoDAO.php');

$divida_aux = new Divida();

$divida_aux->setId_divida($_POST['idAlterar']);

$cadastro = new Cadastro();
$divida = new Divida();
$pessoa = new Pessoa();


$array = ListarUnicaDivida($divida_aux->getId_divida());

$cadastro = $array[0];
$pessoa = $array[1];
$divida = $array[2];

$vetor = array("razaosocial" => $cadastro->getRazao_social(),
			   "cnpj" => $cadastro->getCnpj(),
			   "nome" => $pessoa->getNome(),
			   "cpf" => $pessoa->getCpf(),
			   "cep" => $pessoa->getCep(),
			   "endereco" => $pessoa->getEndereco(),
			   "cidade" => $pessoa->getCidade(),
			   "numero" => $pessoa->getNumero(),
			   "bairro" => $pessoa->getBairro(),
			   "complemento" => $pessoa->getComplemento(),
			   "estado" => $pessoa->getEstado(),
			   "email" => $pessoa->getEmail(),
			   "telefone" => $pessoa->getTelefone(),
			    "tipo" => $divida->getTipo(),
			   "valor" => $divida->getValor(),
			   "descricao" => $divida->getDescricao(),
			   "comprovante" => $divida->getComprovante()

);


echo json_encode($vetor);


 
?>