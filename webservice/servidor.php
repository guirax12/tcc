<?php
	// Por: Guilherme Francisco
	// Em: 01/10/2018
	// Versão: 1.0
	// servidor.php
	include('lib/nusoap.php');
	include('conexao.php');
	
	
	$servidor = new nusoap_server();
	
	
	$servidor->configureWSDL('urn:Servidor');
	$servidor->wsdl->schemaTargetNamespace = 'urn:Servidor';
	
	
	function pessoa($cpf){


  $conexao = new Conexao();
    
  $retorno = array();

  $cmdsql = "SELECT * FROM tb_pessoa where cpf = '$cpf'";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

    while($row = mysqli_fetch_assoc($resultado)){

    	$retorno[] =  $row;

    }
      
      return json_encode($retorno,JSON_UNESCAPED_UNICODE);
	}
		function divida($cpf){


  $conexao = new Conexao();
    
  $retorno = array();

  $cmdsql = "
	select d.Tipo,d.valor,c.Razao_Social,d.descricao
from tb_divida d
 inner join tb_usuario u on u.ID_Usuario = d.FK_Solicitante
 inner join tb_cadastro c on u.FK_Cadastro = c.ID_Cadastro
inner join tb_pessoa p on p.ID_Pessoa = d.FK_Pessoa
where p.Cpf = '$cpf' and d.aprovada = 1 
  ";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

    while($row = mysqli_fetch_assoc($resultado)){

    	$retorno[] =  $row;

    }
      
      return json_encode($retorno,JSON_UNESCAPED_UNICODE);
	}
	
	
	$servidor->register(
		'pessoa',
		array('nome'=>'xsd:string'),
		array('retorno'=>'xsd:string'),
		'urn:Servidor.exemplo',
		'urn:Servidor.exmeplo',
		'rpc',
		'encoded',
		'Apenas um exemplo utilizando o NuSOAP PHP.'
	);
	$servidor->register(
		'divida',
		array('nome'=>'xsd:string'),
		array('retorno'=>'xsd:string'),
		'urn:Servidor.exemplo',
		'urn:Servidor.exmeplo',
		'rpc',
		'encoded',
		'Apenas um exemplo utilizando o NuSOAP PHP.'
	);
	
	
	$rawPostData = file_get_contents("php://input");
     $servidor->service($rawPostData);

     $f = fopen('arquivo.xml','w');
     fwrite($f,$rawPostData);
     fclose($f);
?>