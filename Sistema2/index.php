
<?php



include('models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

?>
<?php include("views/includes/header.php");?>

<?php include("views/includes/top_bar.php");?>   
    
<div class="page-container row-fluid container-fluid">

    <?php include("views/includes/side_bar.php");?>

    <section id="main-content" class="">
        <section class="wrapper main-wrapper row" style=''>
			<div class="page-container row-fluid container-fluid">

            <div class="jumbotron jumbotron-fluid">
  <h1 class="display-4">Bem vindo,<?php echo $_SESSION['usuarionome'];?>!</h1>
  <p class="lead">Através de nossa plataforma,consulte pessoas e suas inadimplências.</p>
  <hr class="my-4">
  <p>Todas as consultas são cobradas e possuem um valor fixo.</p>

</div>
</div>
            
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->


<?php include("views/includes/footer.php");?>

</body>
</html>
