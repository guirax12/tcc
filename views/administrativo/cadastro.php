<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

$validate ->ValidarPermissao($_SESSION['usuarioid'],4);

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
                            <a href="#"><i class="fa fa-tasks"></i>Administrativo</a>
                        </li>
                        <li class="active">
                            <strong><i class="fa fa-user"></i>Análise de Cadastros</strong>
                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Análise de Cadastros</h2>
                        <div class="actions panel_actions pull-right">
                        </div>
                    </header>
                    
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <br>
                                <table class="display responsive" style="width:100%;" id="cadastroTable">
                                    <thead>
                                        <tr>
                                            <th>Código da Solicitação</th>
                                            <th>Razão Social</th>
                                            <th>CNPJ</th>
                                             <th>Visualizar</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                    </tfoot>

                                    <tbody id="corpo">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->
</div>

<div class="modal fade col-xs-12" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form enctype="multipart/form-data" name="cadastroFornecedor" id="cadastroFornecedor" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Solicitar Cadastro</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Razão Social</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="razao" name="razao" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome Fantasia</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nome" name="nome" readonly="">
                                    <input type="hidden" class="form-control" id="idAlterar" name="idAlterar">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="cnpj" class="control-label">CNPJ</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="cnpj" name="cnpj" data-mask="99.999.999/9999-99" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="ie" class="control-label">Inscrição Estadual</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ie" name="ie" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="cep" class="control-label">Cep</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="cep" name="cep" data-mask="99999-999" readonly="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="logradouro" class="control-label">Logradouro</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="logradouro" name="logradouro" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="numero" class="control-label">Número</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="numero" name="numero" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bairro" class="control-label">Bairro</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="bairro" name="bairro" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="complemento" class="control-label">Complemento</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="complemento" name="complemento" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="cidade" class="control-label">Cidade</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="cidade" name="cidade" readonly="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="estado" class="control-label">Estado</label>
                                <div class="controls">
                                    <select class="form-control" name="estado" id="estado" readonly ="">
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="Carregando..." hidden>Carregando...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="telefone" class="control-label">Telefone</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="telefone" data-mask="(99)99999-9999" name="telefone" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="email" name="email" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Logo</label>
                               <div class="controls">
                                   <img src=""  data-src="holder.js/180x180" name="avatar" id="avatar">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="aprovar()">Aprovar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                </div>
           
            </div>
        </form>
    </div>
  </div>



<div id="retornocadastro">
</div> 
<!--        Modal Add  End       -->

<!--        FOOTER        -->
<?php include("../../views/includes/footer.php");?>

<script src="../../js/administrativo/cadastro.js" type="text/javascript"></script>

</body>
</html>