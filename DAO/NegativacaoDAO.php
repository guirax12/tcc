<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_validacao.php');
require_once($raiz.'/models/model_divida.php');
require_once($raiz.'/models/model_pessoa.php');
require_once($raiz.'/models/model_usuario.php');
require_once($raiz.'/models/model_cadastro.php');

function CadastrarNegativacao($pessoa,$divida){

 $validacao = new validacao;

  
  $cnpj = $validacao->limpaCPF_CNPJ($pessoa->getCpf());
  $cep = $validacao->limpaCPF_CNPJ($pessoa->getCep());

  echo $validacao->validarCampo("Nome",$pessoa->getNome(), 150, 10);
  echo $validacao->validarCampo("Email",$pessoa->getEmail(),100,6);
  echo $validacao->validarNumero("Cep",$cep);
  echo $validacao->validarCampo("Endereco",$pessoa->getEndereco(),100,10);
  echo $validacao->validarNumero("Número",$pessoa->getNumero());
  echo $validacao->validarCampo("Bairro",$pessoa->getBairro(),30,1);
  echo $validacao->validarCampo("Cidade",$pessoa->getCidade(),30,1);
  echo $validacao->validarCampo("Estado",$pessoa->getEstado(),2,2);
  echo $validacao->validarCampo("Telefone",$pessoa->getTelefone(),30,1);
  echo $validacao->validarCampo("Divida",$divida->getTipo(),30,1);
  echo $validacao->validarCampo("Valor",$divida->getValor(),30,1);
  echo $validacao->validarCampo("Descricao",$divida->getDescricao(),300,10);
  echo $validacao->ValidaImagem($divida->getComprovante());

   

  if($validacao->verifica()){
     
    $foto = $divida->getComprovante();

    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp|pdf){1}$/i", $foto["name"], $ext);

    // Gera um nome único para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto["tmp_name"], $caminho_imagem);


   
    $conexao = new Conexao();
     session_start();
     $user = $_SESSION['usuarioid'];
     
    $sql = "CALL PR_SolicitaNegativacao(
    '{$pessoa->getCpf()}',
    '{$pessoa->getNome()}',
    '{$pessoa->getEmail()}',
    '{$pessoa->getCep()}',
    '{$pessoa->getEndereco()}',
    '{$pessoa->getCidade()}',
    '{$pessoa->getBairro()}',
    '{$pessoa->getEstado()}',
    '{$pessoa->getComplemento()}',
    '{$pessoa->getNumero()}',
    '{$pessoa->getTelefone()}',
    '{$divida->getTipo()}',
    '{$divida->getValor()}',
    '{$divida->getDescricao()}',
     '{$nome_imagem}',
     $user

  )";

    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
    
  }
}

 function ListaDivida(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "select d.ID_Divida as codigo,u.Nome as Solicitante,p.Nome as Devedor,d.Tipo,d.valor from tb_divida d
inner join tb_usuario u on d.FK_Solicitante = u.ID_Usuario
inner join tb_pessoa p on p.ID_Pessoa = d.FK_Pessoa
where d.aprovada = 0";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($divida = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '21%'>".$divida['codigo']."</td>
        <td align = 'center'>".$divida['Solicitante']."</td>
        <td align = 'center'>".$divida['Devedor']."</td>
         <td align = 'center'>".$divida['Tipo']."</td>
        <td align = 'center'>".$divida['valor']."</td>
        <td align = 'center'>
          <button class='btn btn-info' title='Editar' value='".$divida['codigo']."' onclick='visualizar(this)'>
            <i class='fas fa-edit'></i>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}
function ListarUnicaDivida($id){

  $conexao = new Conexao();

  $cmdsql = "select p.Nome,p.Cpf,p.Cep,p.Endereco,p.Cidade,P.numero,p.bairro,p.complemento,p.estado,
p.Telefone,p.email,c.Razao_Social,c.CNPJ,d.Tipo,d.valor,d.descricao,d.comprovante
from tb_divida d inner join tb_pessoa p on d.FK_Pessoa = p.ID_Pessoa
inner join tb_usuario u on u.ID_Usuario = d.FK_Solicitante
inner join tb_cadastro c on u.FK_Cadastro = c.ID_Cadastro
where d.ID_Divida = $id";
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

  $array = mysqli_fetch_assoc($resultado);

  $conexao->FechaConexao($conexao->getConexao());

  $cadastro = new Cadastro();
  $divida = new Divida();
  $pessoa = new Pessoa();

  $cadastro->setRazao_social($array['Razao_Social']);
  $cadastro->setCnpj($array['CNPJ']);
  $pessoa->setNome($array['Nome']);
  $pessoa->setCpf($array['Cpf']);
  $pessoa->setCep($array['Cep']);
  $pessoa->setEndereco($array['Endereco']);
  $pessoa->setCidade($array['Cidade']);
  $pessoa->setNumero($array['numero']);
  $pessoa->setBairro($array['bairro']);
  $pessoa->setComplemento($array['complemento']);
  $pessoa->setEstado($array['estado']);
  $pessoa->setTelefone($array['Telefone']);
  $pessoa->setEmail($array['email']);
  $divida->setTipo($array['Tipo']);
  $divida->setValor($array['valor']);
  $divida->setDescricao($array['descricao']);
  $divida->setComprovante($array['comprovante']);

  $retorno[0] = $cadastro;
  $retorno[1] = $pessoa;
  $retorno[2] = $divida;


  return $retorno;

}

function ValidaNegativacao($divida,$usuario,$aprova) {

    $conexao = new Conexao();

 $sql = "call PR_AprovaRejeitaNegativacao($divida,$usuario,$aprova);";

mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;



}

?>