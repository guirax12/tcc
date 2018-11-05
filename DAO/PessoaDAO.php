<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_pessoa.php');
require_once($raiz.'/models/model_validacao.php');
require_once($raiz.'/models/PHPMailer/class.phpmailer.php');


  function ListaPessoa($pessoa){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "SELECT Nome,cep,Endereco,Numero,Telefone,Email,cpf,Cidade,Bairro,Estado,Complemento FROM tb_pessoa where cpf = '{$pessoa->getCpf()}'";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



 $rows = mysqli_num_rows($resultado);
 $resultado = mysqli_fetch_assoc($resultado);

if($rows > 0){

  $retorno = $retorno.'
  <div class = "row">
   <form method="post" action="" name="formpessoa" id="formpessoa" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Nome</label>
              <div class="controls">
            <input class="form-control" type="text" name="nome" value = "'.$resultado['Nome'].'" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Email</label>
              <div class="controls">
          <input class="form-control" type="text" name="email" value = "'.$resultado['Email'].'" readonly/>
          <input class="form-control" type="hidden" name="cpf2" id="cpf2" value = "'.$resultado['cpf'].'" />
            </div>
           </div>                                              
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Cep</label>
              <div class="controls">
            <input class="form-control" type="text" name="cep" id="cep" onblur = "validacep()"value = "'.$resultado['cep'].'" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Endereco</label>
              <div class="controls">
          <input class="form-control" type="text" name="endereco" id= "endereco" value = "'.$resultado['Endereco'].'" readonly/>
            </div>
           </div>                                              
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Cidade</label>
              <div class="controls">
            <input class="form-control" type="text" name="cidade" id ="cidade" value = "'.$resultado['Cidade'].'" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Bairro</label>
              <div class="controls">
          <input class="form-control" type="text" name="bairro" id ="bairro" value = "'.$resultado['Bairro'].'" readonly/>
            </div>
           </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Estado</label>
              <div class="controls">
            <input class="form-control" type="text" name="estado" id = "estado" value = "'.$resultado['Estado'].'" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Complemento</label>
              <div class="controls">
          <input class="form-control" type="text" name="complemento" id = "complemento" value = "'.$resultado['Complemento'].'" readonly/>
            </div>
           </div>                                                    
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Numero</label>
              <div class="controls">
            <input class="form-control" type="number" name="numero" value = "'.$resultado['Numero'].'" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Telefone</label>
              <div class="controls">
          <input class="form-control" type="text" name="telefone" id="telefone" value = "'.$resultado['Telefone'].'" readonly/>
            </div>
           </div>
                                                        
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Tipo De Divida</label>
              <div class="controls">
            <select class="form-control" name="divida">
                                        <option>Empréstimo</option>
                                        <option>Crédito Consignado</option>
                                        <option>Cartão de Crédito</option>
                                        <option>Cartão de Lojas</option>
                                    </select>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Valor R$</label>
              <div class="controls">
          <input class="form-control" type="text" name="valor" id="valor"/>
            </div>
           </div>
                                                        
        </div>
       <div class="form-row">
            <div class="form-group col-md-12">
            <label for="nome" class="control-label">Descrição</label>
              <div class="controls">
            <textarea class="form-control" cols="5" name = "desc"></textarea>
              </div>
              </div>                                 
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <label for="nome" class="control-label">Comprovante</label>
              <div class="controls">
           <input type="file" class="form-control" name="doc">
              </div>
              </div>                                 
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
              <div class="controls">
           <button type="button" class="btn btn-primary" id="btneditar" name="btneditar" onclick="EnviaNotificacao()">Enviar Negativação</button>
              </div>
              </div>                                 
        </div> 

   </form>
  <div>
  ';



}
        
 else{

  $retorno = $retorno.'
  <div class = "row">
   <form method="post" action="" name="formpessoa" id="formpessoa" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Nome</label>
              <div class="controls">
            <input class="form-control" type="text" name="nome"/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Email</label>
              <div class="controls">
          <input class="form-control" type="text" name="email"/>
          <input class="form-control" type="hidden" name="cpf2" id="cpf2"/>
            </div>
           </div>                                              
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Cep</label>
              <div class="controls">
            <input class="form-control" type="text" name="cep" id="cep" onblur = "validacep()"/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Endereco</label>
              <div class="controls">
          <input class="form-control" type="text" name="endereco" id= "endereco" readonly/>
            </div>
           </div>                                              
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Cidade</label>
              <div class="controls">
            <input class="form-control" type="text" name="cidade" id ="cidade" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Bairro</label>
              <div class="controls">
          <input class="form-control" type="text" name="bairro" id ="bairro" readonly/>
            </div>
           </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Estado</label>
              <div class="controls">
            <input class="form-control" type="text" name="estado" id = "estado" readonly/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Complemento</label>
              <div class="controls">
          <input class="form-control" type="text" name="complemento" id = "complemento"/>
            </div>
           </div>                                                    
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Numero</label>
              <div class="controls">
            <input class="form-control" type="number" name="numero"/>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Telefone</label>
              <div class="controls">
          <input class="form-control" type="text" name="telefone" id="telefone"/>
            </div>
           </div>
                                                        
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="nome" class="control-label">Tipo De Divida</label>
              <div class="controls">
            <select class="form-control" name="divida">
                                        <option>Empréstimo</option>
                                        <option>Crédito Consignado</option>
                                        <option>Cartão de Crédito</option>
                                        <option>Cartão de Lojas</option>
                                    </select>
              </div>
              </div>
            <div class="form-group col-md-6">
            <label for="email" class="control-label">Valor R$</label>
              <div class="controls">
          <input class="form-control" type="text" name="valor" id="valor"/>
            </div>
           </div>
                                                        
        </div>
       <div class="form-row">
            <div class="form-group col-md-12">
            <label for="nome" class="control-label">Descrição</label>
              <div class="controls">
            <textarea class="form-control" cols="5" name = "desc"></textarea>
              </div>
              </div>                                 
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
            <label for="nome" class="control-label">Comprovante</label>
              <div class="controls">
           <input type="file" class="form-control" name="doc">
              </div>
              </div>                                 
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
              <div class="controls">
           <button type="button" class="btn btn-primary" id="btneditar" name="btneditar" onclick="EnviaNotificacao()">Enviar Negativação</button>
              </div>
              </div>                                 
        </div> 

   </form>
  <div>
  ';


 }   
  

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}





?>