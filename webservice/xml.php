<?php

$nome = 'Guilherme';
$email = 'guirax@gmail.com';
$telefone = '1195324-5110';



#versao do encoding xml
$dom = new DOMDocument("1.0", "ISO-8859-1");

#retirar os espacos em branco
$dom->preserveWhiteSpace = false;

#gerar o codigo
$dom->formatOutput = true;

#criando o nó principal (root)
$root = $dom->createElement("pessoas");

#nó filho (contato)
$contato = $dom->createElement("contato");

#setanto nomes e atributos dos elementos xml (nós)
$nome = $dom->createElement("nome", $nome);
$email = $dom->createElement("email", $email);
$telefone = $dom->createElement("telefone", $telefone);

#adiciona os nós (informacaoes do contato) em contato
$contato->appendChild($nome);
$contato->appendChild($email);
$contato->appendChild($telefone);

#adiciona o nó contato em (root) agenda
$root->appendChild($contato);
$dom->appendChild($root);

# Para salvar o arquivo, descomente a linha
$dom->save("contatos.xml");

#cabeçalho da página
header("Content-Type: text/xml");
# imprime o xml na tela
print $dom->saveXML();



?>