<?php
include('plugins/dompdf/dompdf/dompdf_config.inc.php');


/* Cria a instância */
$dompdf = new DOMPDF();

/* Carrega seu HTML */
$dompdf->load_html("
<fieldset>
    <h1>Recibo</h1>
    <p class='center sub-titulo'>
      Nº <strong>0001</strong> - 
      VALOR <strong>R$ 500,00</strong>
    </p>
    <p>Recebi(emos) de <strong>Carlos Domingues Neto</strong></p>
    <p>a quantia de <strong>Quinhentos Reais</strong></p>
    <p>Correspondente a <strong>Serviços prestados ..<strong></p>
    <p>e para clareza firmo(amos) o presente.</p>
    <p>São Roque, 25 de Dezembro de 2015</p>
    <p>Assinatura ......................................................................................................................................</p>
    <p>Nome <strong>João da Silva Nogueira</strong> CPF/CNPJ: <strong>222.222.222-02</strong></p>
    <p>Endereço <strong>Rua da Penha, 200 - Jd. Alguma Coisa - São Paulo</strong></p>
   </fieldset>
   <style>
   fieldset{

}
 
h1{
  text-align: center;
}
 
p.sub-titulo{
  font-size: 20px;
}
 
.direita{
  text-align: right;
}
 
.center{
  text-align: center;
}
</style>
  ");

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream(
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);


?>