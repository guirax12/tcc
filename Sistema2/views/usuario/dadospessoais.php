<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);



?>

<?php include("../../views/includes/header.php");?>

<?php include("../../views/includes/top_bar.php");?>

<div class="page-container row-fluid container-fluid">

    <?php include("../../views/includes/side_bar.php");?>

    <section id="main-content" class="">
        <section class="wrapper main-wrapper row">

            <div class='col-xs-12'>
                <div class="page-title">

                    <ol class="breadcrumb primary">
                        <li>
                             <a href="/"><i class="fa fa-home"></i>Início</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks"></i>Consultas</a>
                        </li>
                        <li class="active">
                            <strong><i class="fa fa-user"></i>Dados Pessoais</strong>
                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Consulta de Dados Pessoais - R$:5,9O</h2>
                        <div class="actions panel_actions pull-right">
                        </div>
                    </header>
                    
  <div class="content-body" style="display: block;">
    <div class="row">
      <form method="post" action="" name="formdiv" id="formdiv">
        <div class="form-row">
            <div class="form-group col-md-6">
              <div class="input-group">
    			<input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF" data-mask="999.999.999-99" />
                
   			 	<div class="input-group-btn">
       			<button class="btn btn-primary" type="button" onclick="verificar()">Consultar</button>
   		     	</div>
			</div>
            </div>                                              
        </div>
       </form>
      </div> 
       <div name = "retorno" id="retorno">


       </div>
    </div>
  
 </div> 
                </section>
            </div>
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->
</div>

<?php include("../../views/includes/footer.php");?>

<script src="../../js/usuario/dadospessoais.js" type="text/javascript"></script>