<?php
  session_start();
  require_once('config/dbconfig.php');

  if(isset($_POST['submit']))
  {
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) 
    {
      $vEmail       = trim($_POST['email']);
      $vPassword    = trim($_POST['password']);

      /* FILTER_VALIDATE_EMAIL comprueba si la variable $vEmail es una dirección de email válida*/
      if(filter_var($vEmail, FILTER_VALIDATE_EMAIL))       
      {
        /* Script SQL para realizar la validación acerca de la existencia de 
        registros de email que se pretende registrar*/
        $sql      = "select * from users where email = :pemail";
        $script   = $pdo->prepare($sql);
        $sqlEmail = ['pemail'=>$vEmail];
        $script->execute($sqlEmail);/* Ejecutar (DML) SELECT */
        
        if($script->rowCount() > 0)
        {
          $getRow = $script->fetch(PDO::FETCH_ASSOC);
          if(password_verify($vPassword, $getRow['password'])){
             unset($getRow['password']);
             $_SESSION = $getRow;
             header('location:feed/dashboard.php');
             exit();
          }else{
            $errors[] = "Correo electrónico o contraseña incorrecta";
          }
        }else{
          $errors[] = "Correo electrónico o contraseña incorrecta";
        }
      }else{
        $valEmail    = '';
        $valPassword = $vPassword;
        $errors[] = 'Por favor ingresa un correo electrónico válido'; /* ERROR: ALERTA EN PANTALLA */
      }

    }else{
      /* Validación de INPUTs email y password
        isset: Valida si la variable esta definida.
        empty: Valida si la variable esta vacia*/
      if(!isset($_POST['email']) || empty($_POST['email'])) /* Si no esta denifida y vacia */
      {
          $alertMessage1 = 'Por favor ingresa un correo electrónico';/* ALERTA EN PANTALLA */
      }
      else
      {
          $valEmail = $_POST['email'];
      }
      if(!isset($_POST['password']) || empty($_POST['password'])) /* Si no esta denifida y vacia */
      {
          $alertMessage2 = 'Por favor ingresa una contraseña';/* ALERTA EN PANTALLA */
      }
      else
      {          
          $valPassword = $_POST['password'];          
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Regístrese ahora | New Talents</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================   
  * Template Name: nTalents - v1.0.0
  * Template URL: https://hadsonpar.com/template/bootstrap-web-new-talents/
  * Author: hadsonpar.com
  * License: https://hadsonpar.com/license/
  ======================================================== -->
</head>

<body>
  
  <!-- ======= Hero Section ======= -->    
  <section id="login" class="d-flex align-items-center">
    <div class="container">
      <div class="row">                
        <div class="col-lg-12">       
          <div class="logo">            
            <a href="index"><img src="assets/img/new-talents.png" alt="" class="img-fluid"></a>
          </div>
          
          <div class="form">  
            <h1>Iniciar sesión</h1>
            <h2>Encuentra nuevas oportunidades</h2>
            
            <?php 
              /* Sección de alertas (captura de mensajes y errores) */
              if(isset($errors) && count($errors) > 0)
              {
              	foreach($errors as $error_msg)
              	{
              		echo '<div class="alert alert-danger">'.$error_msg.'</div>';
              	}
              }
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form" class="php-email-form" data-aos="fade-up">
              <div class="form-group">                
                <input placeholder="Email" type="email" class="form-control" name="email" id="email" value="<?php echo ($valEmail??'')?>" />                
                  <?php
                    echo '<div class="alertMessage">'.($alertMessage1??'').'</div>';
                  ?>                
              </div>

              <div class="form-group">              
                <input placeholder="Contraseña" type="password" class="form-control" name="password" id="password" value="<?php echo ($valPassword??'')?>" />                
                  <?php
                    echo '<div class="alertMessage">'.($alertMessage2??'').'</div>';
                  ?>
              </div>
              <div class="mb-3">
                <div class="legal">
                  <a href="#">¿Has olvidado tu contraseña?</a>
                </div>                  
              </div>

              <button class="login-btn" type="submit" name="submit">Iniciar sesión</button>

              <p>¿Eres nuevo en New Talents? <a href="signup/sign-up">Regístrese ahora</a></p>

            </form>
          </div>
        </div>

      </div>
    </div>

  </section><!-- End Hero -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <!--<script src="assets/vendor/php-email-form/validate.js"></script>-->
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>