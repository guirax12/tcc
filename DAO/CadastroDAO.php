<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_cadastro.php');
require_once($raiz.'/models/model_validacao.php');

function CadastrarSolicitacao($cadastro){

  $validacao = new validacao;


  
  $cnpj = $validacao->limpaCPF_CNPJ($cadastro->getCNPJ());
  $cep = $validacao->limpaCPF_CNPJ($cadastro->getCep());

  echo $validacao->validarCampo("Razão Social",$cadastro->getRazao_Social(), 150, 10);
  echo $validacao->validarCampo("Nome Fantasia",$cadastro->getNome_Fantasia(),100,6);
  echo $validacao->ValidarCNPJExistente($cnpj);
  echo $validacao->ValidarEmailExistente($cadastro->getEmail());
  echo $validacao->validarNumero("Inscrição Estadual",$cadastro->getInscricao_Estadual());
  echo $validacao->validarNumero("Cep",$cep);
  echo $validacao->validarCampo("Logradouro",$cadastro->getLogradouro(),100,10);
  echo $validacao->validarNumero("Número",$cadastro->getNumero());
  echo $validacao->validarCampo("Bairro",$cadastro->getBairro(),30,1);
  echo $validacao->validarCampo("Cidade",$cadastro->getCidade(),30,1);
  echo $validacao->validarCampo("Estado",$cadastro->getEstado(),2,2);
  echo $validacao->validarCampo("Telefone",$cadastro->getTelefone(),30,1);
  echo $validacao->ValidaImagem($cadastro->getAvatar());
   echo $validacao->validarEmail($cadastro->getEmail());

   

  if($validacao->verifica()){
     
    $foto = $cadastro->getAvatar();

    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp){1}$/i", $foto["name"], $ext);

    // Gera um nome único para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto["tmp_name"], $caminho_imagem);


   
    $conexao = new Conexao();
 
    $sql = "INSERT INTO tb_cadastro (Razao_Social, Nome_Fantasia, CNPJ,Inscricao_Estadual,Cep, Logradouro,Numero,Bairro,Complemento,Cidade,Estado,Telefone,Bloqueado,Avatar,Email) 
            VALUES ('{$cadastro->getRazao_Social()}','{$cadastro->getNome_Fantasia()}',{$cnpj},{$cadastro->getInscricao_Estadual()},{$cep},'{$cadastro->getLogradouro()}',{$cadastro->getNumero()},'{$cadastro->getBairro()}','{$cadastro->getComplemento()}','{$cadastro->getCidade()}','{$cadastro->getEstado()}','{$cadastro->getTelefone()}','{1}','{$nome_imagem}','{$cadastro->getEmail()}')";

        
    
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
    
  }
}
 function ListaCadastro(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "SELECT ID_Cadastro,Razao_Social, CNPJ FROM tb_cadastro c
left join tb_usuario u on c.ID_Cadastro = u.FK_Cadastro
where u.FK_Cadastro is null";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '21%'>".$cadastro['ID_Cadastro']."</td>
        <td align = 'center'>".$cadastro['Razao_Social']."</td>
        <td align = 'center'>".$cadastro['CNPJ']."</td>
        <td align = 'center'>
          <button class='btn btn-info' title='Editar' value='".$cadastro['ID_Cadastro']."' onclick='visualizar(this)'>
            <i class='fas fa-edit'></i>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function ListarUnicoCadastro($id){

  $conexao = new Conexao();

  $cmdsql = "SELECT * FROM tb_cadastro WHERE ID_Cadastro = $id";
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

  $array = mysqli_fetch_assoc($resultado);

  $conexao->FechaConexao($conexao->getConexao());

  $cadastro = new Cadastro();

  $cadastro->setRazao_social($array['Razao_Social']);
  $cadastro->setNome_fantasia($array['Nome_Fantasia']);
  $cadastro->setCnpj($array['CNPJ']);
  $cadastro->setInscricao_estadual($array['Inscricao_Estadual']);
  $cadastro->setLogradouro($array['Logradouro']);
  $cadastro->setNumero($array['Numero']);
  $cadastro->setBairro($array['Bairro']);
  $cadastro->setComplemento($array['Complemento']);
  $cadastro->setCidade($array['Cidade']);
  $cadastro->setEstado($array['Estado']);
  $cadastro->setCep($array['Cep']);
  $cadastro->setTelefone($array['Telefone']);
  $cadastro->setBloqueado($array['Bloqueado']);
  $cadastro->setEmail($array['Email']);
    $cadastro->setAvatar($array['Avatar']);

  return $cadastro;

}

function ValidaCadastroEmpresa($id) {

    $conexao = new Conexao();

 $sql = "insert into tb_usuario (FK_Cadastro,Nome,Tipo,Email,Senha,Bloqueado,Avatar)
 values ($id,(select Razao_Social from tb_cadastro where ID_Cadastro = $id),'Empresa',(select Email from tb_cadastro where ID_Cadastro = $id),'123Mudar',0,(select Avatar from tb_cadastro where ID_Cadastro = $id))";

mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;



}

?>