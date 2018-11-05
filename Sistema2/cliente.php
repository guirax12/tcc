<?php
	// http://www.thiengo.com.br
	// Por: Vinícius Thiengo
	// Em: 25/11/2013
	// Versão: 1.0
	// cliente.php
	include('lib/nusoap.php');
	
	
	$cliente = new nusoap_client('http://localhost/webservice/servidor.php?wsdl');
	
	
	$parametros = array('cpf'=>'462.806.558-65');
						
		
	$resultado = $cliente->call('pessoa', $parametros);
	
      
   echo $resultado;
	
?>