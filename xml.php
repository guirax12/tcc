<?php
require_once('DAO/conexao.php');

$conexao = new Conexao();

$cpf = $_GET['cpf'];


$cmdsql = "SELECT nome,email,telefone from tb_pessoa where cpf = $cpf";


    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);
	


#versao do encoding xml
$dom = new DOMDocument("1.0", "ISO-8859-1");

#retirar os espacos em branco
$dom->preserveWhiteSpace = false;

#gerar o codigo
$dom->formatOutput = true;

#criando o nó principal (root)
$root = $dom->createElement("agenda");

#nó filho (contato)
while($rs = mysqli_fetch_assoc($resultado)){



$contato = $dom->createElement("contato");

#setanto nomes e atributos dos elementos xml (nós)
$nome = $dom->createElement("nome", $rs['nome']);
$email = $dom->createElement("email", $rs['email']);
$telefone = $dom->createElement("telefone", $rs['telefone']);

#adiciona os nós (informacaoes do contato) em contato
$contato->appendChild($nome);
$contato->appendChild($email);
$contato->appendChild($telefone);

#adiciona o nó contato em (root) agenda
$root->appendChild($contato);
$dom->appendChild($root);
}
# Para salvar o arquivo, descomente a linha
$dom->save("contatos.xml");

#cabeçalho da página
header("Content-Type: text/xml");
# imprime o xml na tela
print $dom->saveXML();



?>