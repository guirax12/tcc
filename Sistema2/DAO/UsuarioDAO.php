<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_usuario.php');
require_once($raiz.'/models/model_validacao.php');
require_once($raiz.'/models/PHPMailer/class.phpmailer.php');
require_once($raiz.'/lib/nusoap.php');
include($raiz."/plugins/dompdf/dompdf/dompdf_config.inc.php");

function LogarUsuario($usuario){
 
  $validate = new validacao;

  echo $validate->ValidarLoginUsuario($usuario->getEmail(),$usuario->getSenha());
  
  if($validate->verifica()){

    $conexao = new Conexao();

    $cmdsql = "SELECT   ID_Usuario,Nome,credito,Avatar
        FROM tb_usuario
        WHERE Email = '{$usuario->getEmail()}' AND Senha = '{$usuario->getSenha()}'";

      
    
    $exec = mysqli_query($conexao->getConexao(),$cmdsql);
  
    $resultado = mysqli_fetch_assoc($exec);

    $usuariologado = new Usuario;

    $usuariologado->setId_Usuario($resultado['ID_Usuario']);
    $usuariologado->setNome($resultado['Nome']);
    $usuariologado->setCredito($resultado['credito']);
    $usuariologado->setAvatar($resultado['Avatar']);


    session_start();

    $_SESSION['usuarioid'] = $usuariologado->getId_Usuario();
    $_SESSION['usuarionome'] = $usuariologado->getNome();
    $_SESSION['credito'] = $usuariologado->getCredito();
    $_SESSION['avatar'] = $usuariologado->getAvatar();

    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
  }
}


function CadastraUsuario($usuario){

  $validacao = new validacao;

        
  echo $validacao->validarCampo("Nome",$usuario->getNome(),100,4);
  echo $validacao->ValidarEmailExistenteUsuario($usuario->getEmail());
  echo $validacao->validarCampo("Senha",$usuario->getSenha(),25,8);
  echo $validacao->ValidaImagem($usuario->getAvatar());


  if($validacao->verifica()){
   
    // instanciando conexão
    $conexao = new Conexao();

    $foto = $usuario->getAvatar();

    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp){1}$/i", $foto["name"], $ext);

    // Gera um nome único para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto["tmp_name"], $caminho_imagem);
 
    // Se for validado faz o insert
    $cmdsql = "INSERT INTO tb_usuario ( Nome,Senha,Email,BLoqueado,Avatar,Credito) 
               VALUES ('{$usuario->getNome()}','{$usuario->getSenha()}','{$usuario->getEmail()}',0,'{$nome_imagem}',0)";

             
    
    mysqli_query($conexao->getConexao(),$cmdsql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
  } 
}
function AlteraUsuario($usuario){



  $validacao = new validacao;

 echo $validacao->validarCampo("Nome",$usuario->getNome(),100,4);
    echo $validacao->validarCampo("Tipo",$usuario->getTipo(),100,4);
  echo $validacao->ValidarEmailExistenteUsuarioEditar($usuario->getEmail(),$usuario->getId_usuario());
  echo $validacao->validarCampo("Senha",$usuario->getSenha(),25,8);
  echo $validacao->validarNumero("Bloqueado",$usuario->getBloqueado());


  if($usuario->getAvatar() == ''){
    $foto = '';
  } else{
     echo $validacao->ValidaImagem($usuario->getAvatar());
      $foto = $usuario->getAvatar();

  }
  echo $validacao->validarNumero("Bloqueado",$usuario->getBloqueado());

  if($validacao->verifica()){
   
    // instanciando conexão
    $conexao = new Conexao();

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    if($foto == ''){
      $whereFoto = '';
    }else{

      // Pega extensão da imagem
      preg_match("/\.(jpeg|jpg|png|gif|bmp){1}$/i", $foto["name"], $ext);

      // Gera um nome único para a imagem
      $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

      // Caminho de onde ficará a imagem
      $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto["tmp_name"], $caminho_imagem);

      $whereFoto = ", Avatar = '{$nome_imagem}'";

      $sql_imagem = "SELECT Avatar from tb_usuario where ID_Usuario = {$usuario->getId_usuario()}";
      $resultado = mysqli_query($conexao->getConexao(),$sql_imagem);
      $array = mysqli_fetch_assoc($resultado);

      $imagem = $array['Avatar'];

      if (file_exists($raiz."/images/avatar/".$imagem)) {
        unlink($raiz."/images/avatar/".$imagem);
      }
    }


    // Se for validado faz o insert
    $cmdsql = "UPDATE tb_usuario SET Nome = '{$usuario->getNome()}', Senha = '{$usuario->getSenha()}', Email = '{$usuario->getEmail()}', Bloqueado = {$usuario->getBloqueado()}, Tipo = '{$usuario->getTipo()}' $whereFoto WHERE ID_Usuario = {$usuario->getId_usuario()} ";
    
    mysqli_query($conexao->getConexao(),$cmdsql);
    
    $conexao->FechaConexao($conexao->getConexao());

   echo 1;
    
  }
}


function EnviaLoginSenha($user){

    // instanciando conexão
    $conexao = new Conexao();


$cmdsql = "select Email,Senha from tb_usuario where Email = '{$user->getEmail()}'";

$exec = mysqli_query($conexao->getConexao(),$cmdsql);

$result = mysqli_fetch_assoc($exec);


$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'guirax@gmail.com';
$mail->Password = 'xmlxmlw098';
$mail->Port = 587;
$mail->setFrom('guirax@gmail.com');
$mail->addReplyTo('no-reply@email.com.br');
$mail->addAddress($user->getEmail(), 'Guilherme');
$mail->isHTML(true);
$mail->Subject = 'Cadastro Portal';
$mail->Body    = 'Seu cadastro foi aprovado! <br><b>Login:'.$result['Email'].'</b><br><b>Senha:'.$result['Senha'].'</b>';
$mail->send();





}
function RetornaMenu($usuario){
 

 
   

    $menu = null;

        $menu .='<li class="menusection">Consultas</li>';
  

        $menu .=  '<li class="">
                <a href="/views/usuario/dadospessoais.php">
                    <i class="fas fa-edit"></i>
                    <span class="title">Dados Pessoais</span>
                </a>
            </li>';
            $menu .=  '<li class="">
                <a href="/views/usuario/dividas.php">
                    <i class="fas fa-edit"></i>
                    <span class="title">Dividas</span>
                </a>
            </li>';

      $menu .='<li class="menusection">Recarga</li>';
       $menu .=  '<li class="">
                <a href="/views/usuario/recarga.php">
                    <i class="fas fa-edit"></i>
                    <span class="title">Comprar Créditos</span>
                </a>
            </li>';
    
    return $menu;
  
}
 function ListaPessoa($cpf){

 $cliente = new nusoap_client('http://localhost/webservice/servidor.php?wsdl');
  
  
  $parametros = array('cpf'=>$cpf);
            
    
  $resultado = $cliente->call('pessoa', $parametros);

 $jsonText = $resultado;
$decodedText = html_entity_decode($jsonText);
$myArray = json_decode($decodedText, true);
$cont = count($myArray);
$usuario = new Usuario();
session_start();
$usuario->setId_Usuario($_SESSION['usuarioid']);
$saldo = VerificaSaldo($usuario);

if($saldo >= 5.90){

if($cont > 0){
$html = null;
$html = "<fieldset>
    <h1>Consulta de Dados Pessoais</h1>
    <p class='center sub-titulo'>
      VALOR <strong>R$ 5,90</strong>
    </p>";

foreach($myArray as $array){

  $html = $html."
  <p>Nome:<strong>".$array['Nome']."</strong></p>
    <p>Cpf:<strong>".$array['Cpf']."</strong></p>
     <p>Email:<strong>".$array['Email']."</strong></p>
    <p>Cep:<strong>".$array['Cep']."</strong></p>
    <p>Endereço:<strong>".$array['Endereco']."</strong></p>
     <p>Cidade:<strong>".$array['Cidade']."</strong></p>
    <p>Estado:<strong>".$array['Estado']."</strong></p>
    <p>Complemento:<strong>".$array['Complemento']."</strong></p>
    <p>Bairro:<strong>".$array['Bairro']."</strong></p>
    <p>Telefone:<strong>".$array['Telefone']."</strong></p>

  ";

}

$html = $html."
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
";
 /* Cria a instância */
$dompdf = new DOMPDF();
/* Carrega seu HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();
// pega o código fonte do novo arquivo PDF gerado
$output = $dompdf->output();



      // Gera um nome único para o pdf
      $nome_pdf = md5(uniqid(time())) . ".pdf";
      $raiz = $_SERVER['DOCUMENT_ROOT'];
// defina aqui o nome do arquivo que você quer que seja salvo
file_put_contents($raiz."/pdf/".$nome_pdf, $output);
$dir = $raiz."/pdf/".$nome_pdf;
// redirecionamos o usuário para o download do arquivo
//die("<script>location.href='nome_do_arquivo.pdf';</script>");


 
$retorno = null;

  $retorno = $retorno.'
  <div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Sucesso:</strong><a href="/pdf/'.$nome_pdf.'" target="_blank">Clique Aqui para acessar as informações</a></div>
  ';

  AtualizaSaldo($_SESSION['usuarioid'],$saldo,5.90);

  }
  else{

$retorno = null;

  $retorno = $retorno.'
  <div class="alert alert-warning alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Aviso:</strong> Este CPF não possui dados cadastrados!</div>
  ';

  }
}

else{
$retorno = null;

  $retorno = $retorno.'
  <div class="alert alert-danger alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Aviso:</strong> Você não possui saldo suficiente!</div>
  ';


}
  echo $retorno;
  die;
  return $retorno;

}
function VerificaSaldo($usuario){
 

    $conexao = new Conexao();

    $cmdsql = "SELECT   credito
        FROM tb_usuario
        WHERE ID_Usuario = {$usuario->getId_Usuario()}";

      
    
    $exec = mysqli_query($conexao->getConexao(),$cmdsql);
  
    $resultado = mysqli_fetch_assoc($exec);

    $saldo = $resultado['credito'];
    
    $conexao->FechaConexao($conexao->getConexao());

    return $saldo;
  }
  function AtualizaSaldo($id,$cred,$valorconsulta){
   
    $newcred = $cred - $valorconsulta;

    $conexao = new Conexao();

    $cmdsql = "UPDATE tb_usuario set credito = $newcred
        WHERE ID_Usuario = $id";

    
    $exec = mysqli_query($conexao->getConexao(),$cmdsql);
    
    $conexao->FechaConexao($conexao->getConexao());

    

    $_SESSION['credito'] = $newcred;
  }
  function AlteraUsuarioMenu($usuario){



  $validacao = new validacao;

 echo $validacao->validarCampo("Nome",$usuario->getNome(),100,4);
  echo $validacao->validarCampo("Senha",$usuario->getSenha(),25,8);



  if($usuario->getAvatar() == ''){
    $foto = '';
  } else{
     echo $validacao->ValidaImagem($usuario->getAvatar());
      $foto = $usuario->getAvatar();

  }

  if($validacao->verifica()){
   
    // instanciando conexão
    $conexao = new Conexao();

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    if($foto == ''){
      $whereFoto = '';
    }else{

      // Pega extensão da imagem
      preg_match("/\.(jpeg|jpg|png|gif|bmp){1}$/i", $foto["name"], $ext);

      // Gera um nome único para a imagem
      $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

      // Caminho de onde ficará a imagem
      $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto["tmp_name"], $caminho_imagem);

      $whereFoto = ", Avatar = '{$nome_imagem}'";

      $sql_imagem = "SELECT Avatar from tb_usuario where ID_Usuario = {$usuario->getId_usuario()}";
      $resultado = mysqli_query($conexao->getConexao(),$sql_imagem);
      $array = mysqli_fetch_assoc($resultado);

      $imagem = $array['Avatar'];

      if (file_exists($raiz."/images/avatar/".$imagem)) {
        unlink($raiz."/images/avatar/".$imagem);
      }
    }


    // Se for validado faz o insert
    $cmdsql = "UPDATE tb_usuario SET Nome = '{$usuario->getNome()}', Senha = '{$usuario->getSenha()}' $whereFoto WHERE ID_Usuario = {$usuario->getId_usuario()} ";
    $_SESSION['usuarionome'] = $usuario->getNome();
    if($foto != ''){
    $_SESSION['avatar'] = $nome_imagem;
  }


    
    mysqli_query($conexao->getConexao(),$cmdsql);
    
    $conexao->FechaConexao($conexao->getConexao());

   echo 1;
    
  }
}
function ListaUnicoUsuario($idUsuario){

  $conexao = new Conexao();

  $cmdsql = "SELECT * FROM tb_usuario WHERE ID_Usuario = $idUsuario";
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

  $array = mysqli_fetch_assoc($resultado);

  $conexao->FechaConexao($conexao->getConexao());

  $usuario = new Usuario();

  $usuario->setNome($array['Nome']);
  $usuario->setEmail($array['Email']);
  $usuario->setSenha($array['Senha']);
  $usuario->setAvatar($array['Avatar']);


  return $usuario;

}

function ListaDivida($cpf){

 $cliente = new nusoap_client('http://localhost/webservice/servidor.php?wsdl');
  
  
  $parametros = array('cpf'=>$cpf);
            
    
  $resultado = $cliente->call('divida', $parametros);

 $jsonText = $resultado;
$decodedText = html_entity_decode($jsonText);
$myArray = json_decode($decodedText, true);


$cont = count($myArray);
$usuario = new Usuario();
session_start();
$usuario->setId_Usuario($_SESSION['usuarioid']);
$saldo = VerificaSaldo($usuario);

if($saldo >= 12.90){

if($cont > 0){
$html = null;
$html = "<fieldset>
    <h1>Consulta de Dividas</h1>
    <p class='center sub-titulo'>
      VALOR <strong>R$12,90</strong>
    </p>";


foreach($myArray as $array){

  $html = $html."
  <fieldset>
  <p>Tipo:<strong>".$array['Tipo']."</strong></p>
    <p>Valor:<strong>".$array['valor']."</strong></p>
     <p>Empresa:<strong>".$array['Razao_Social']."</strong></p>
    <p>Descricão:<strong>".$array['descricao']."</strong></p>
   </fieldset>
  ";

}

$html = $html."
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
";
 /* Cria a instância */
$dompdf = new DOMPDF();
/* Carrega seu HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();
// pega o código fonte do novo arquivo PDF gerado
$output = $dompdf->output();



      // Gera um nome único para o pdf
      $nome_pdf = md5(uniqid(time())) . ".pdf";
      $raiz = $_SERVER['DOCUMENT_ROOT'];
// defina aqui o nome do arquivo que você quer que seja salvo
file_put_contents($raiz."/pdf/".$nome_pdf, $output);
$dir = $raiz."/pdf/".$nome_pdf;
// redirecionamos o usuário para o download do arquivo
//die("<script>location.href='nome_do_arquivo.pdf';</script>");


 
$retorno = null;

  $retorno = $retorno.'
  <div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Sucesso:</strong><a href="/pdf/'.$nome_pdf.'" target="_blank">Clique Aqui para acessar as informações</a></div>
  ';

  AtualizaSaldo($_SESSION['usuarioid'],$saldo,12.90);

  }
  else{

$retorno = null;

  $retorno = $retorno.'
  <div class="alert alert-warning alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Aviso:</strong> Este CPF não possui dados cadastrados!</div>
  ';

  }
}

else{
$retorno = null;

  $retorno = $retorno.'
  <div class="alert alert-danger alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Aviso:</strong> Você não possui saldo suficiente!</div>
  ';


}

  return $retorno;

}

 function AtualizaSaldoCompra($id,$cred){

    $cred = moeda($cred);
   
    $newcred = $cred + $_SESSION['credito'];

    $conexao = new Conexao();

    $cmdsql = "UPDATE tb_usuario set credito = $newcred
        WHERE ID_Usuario = $id";

    
    $exec = mysqli_query($conexao->getConexao(),$cmdsql);
    
    $conexao->FechaConexao($conexao->getConexao());

    

    $_SESSION['credito'] = $newcred;

      echo 1;
  }

  function moeda($get_valor) { 
               $source = array('.', ',');  
               $replace = array('', '.'); 
               $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto 
               return $valor; //retorna o valor formatado para gravar no banco 
       }







?>