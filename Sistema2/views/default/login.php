<!DOCTYPE html>
<html class="">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Faça seu Login!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />


        <!-- CORE CSS FRAMEWORK - START -->
        <link href="/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        
        <link href="/plugins/messenger/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/plugins/messenger/css/messenger-theme-future.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/plugins/messenger/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>

        <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <link href="/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->

    </head>
    
<body class="login_page">
 <div id="loaderModal">
        <i class="fa fa-spinner blue"></i>
    </div>


    <div class="container-fluid">
        <div class="login-wrapper row">
            <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">
                <h1><a href="#" title="Login Page" tabindex="-1">Consome Dados</a></h1>

                <form enctype="multipart/form-data" name="form_login" id="form_login" action="" method="post">
                    <p>
                        <label for="user_pass">Email<br />
                        <input type="text" name="user" id="user" class="input" size="20" /></label>
                    </p>
                    <p>
                        <label for="user_pass">Senha<br />
                        <input type="password" name="senha" id="senha" class="input" size="20" /></label>
                    </p>
                    <p class="submit">
                        <input type="button" name="wp-submit" id="wp-submit" class="btn btn-accent btn-block" value="Logar" onclick="logar()" />
                    </p>
                     <p>
                      <a data-toggle ="modal" href ="#modalAdd">
                            <i class="ace-icon fa fa-arrow-left"></i>
                             Cadastrar
                      </a>  
                        
                    </p>
                </form>

            </div>
        </div>
    </div>
    <div id="retornochamada" name="retornochamada">
    </div>
    <!--        Modal Add        -->
<div class="modal fade col-xs-12" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form name="cadastrousuario" id="cadastrousuario" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Adicionar Usuário</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>                        
                     <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="senha" class="control-label">Senha</label>
                                <div class="controls input-group">
                                    <input type="password" class="form-control" id="senha2" name="senha2">
                                    <span class="input-group-addon" id="olho">
                                        <span class="arrow"></span>
                                        <i class="fa fa-eye-slash olho"></i>     
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="foto" class="control-label">Foto</label>
                                <div class="controls">
                                    <input type="file" class="form-control" id="foto2" name="foto2">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="cadastrar()">Adicionar</button>
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

    <!-- CORE JS FRAMEWORK - START --> 
    <script src="/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
    <script src="/js/jquery.easing.min.js" type="text/javascript"></script> 
    <script src="/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>  
        <script src="/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="/plugins/pace/pace.min.js" type="text/javascript"></script>  
    <script src="/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
    <script src="/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
    <script>window.jQuery||document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>');</script>
    <!-- CORE JS FRAMEWORK - END -->


    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
    <script src="/plugins/messenger/js/messenger.min.js" type="text/javascript"></script>
    <script src="/plugins/messenger/js/messenger-theme-future.js" type="text/javascript"></script>
    <script src="/plugins/messenger/js/messenger-theme-flat.js" type="text/javascript"></script>
    <script src="/js/messenger.js" type="text/javascript"></script>
     <!-- Start Input Mask Plugin -->
    <script src="/plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
    <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <!-- End Input Mask Plugin -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


    <!-- CORE TEMPLATE JS - START --> 
    <script src="/js/scripts.js" type="text/javascript"></script> 
    <!-- END CORE TEMPLATE JS - END --> 
    <script src="/js/default/login.js" type="text/javascript"></script> 
  

</body>
</html>
