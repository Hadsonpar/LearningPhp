<?php
  session_start();
  require_once('../config/dbconfig.php');

   if (isset($_POST['submit'])) 
   {
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) 
    {
      $vEmail       = trim($_POST['email']);
      $vPassword    = trim($_POST['password']);
      $options      = array("cost"=>4);
      $hashCodePass = password_hash($vPassword,PASSWORD_BCRYPT,$options);
     
      if(filter_var($vEmail, FILTER_VALIDATE_EMAIL))       
      {
        /* Script de validación acerca de la existencia de registros de email*/
        $sql      = "select * from users where email = :pemail";
        $script   = $pdo->prepare($sql);
        $sqlEmail = ['pemail'=>$vEmail];
        $script->execute($sqlEmail);

        if($script->rowCount() == 0)
        {
          $vNameUse     = strstr($vEmail, '@',true);
          $vidusertype  = 1;

          $sql      = "insert into users (user, email, password, idusertype) values (:puser, :pemail, :ppassword, :pidusertype)";

          try{
            $handle   = $pdo->prepare($sql);
            
            $sqlParams = [':puser'=>$vNameUse,
                          ':pemail'=>$vEmail,
                          ':ppassword'=>$hashCodePass,
                          ':pidusertype'=>$vidusertype];

            $handle->execute($sqlParams);   
            
            $success = 'Usuario creado con éxito';

          }
          catch(PDOException $e)
          {
            $errors[] = $e->getMessage();
          }                
        }
        else
        {
          /*
          $valEmail     = $vEmail;
          $valPassword  = $vPassword;
          */
          $alertEmail   = 'El email '.$vEmail.' ya se encuentra registrado';
        }
      }
    }
    else
    {
      if(!isset($_POST['email']) || empty($_POST['email']))
      {
          $alertMessage1 = 'Por favor ingresa un correo electrónico';
      }
      else
      {
          $valEmail = $_POST['email'];
      }

      if(!isset($_POST['password']) || empty($_POST['password']))
      {
          $alertMessage2 = 'Por favor ingresa una contraseña';
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

  <title>Regístrese usuario | New Talents</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: nTalents - v1.0.0
  * Template URL: https://hadsonpar.com/template/bootstrap-web-new-talents/
  * Author: hadsonpar.com
  * License: https://hadsonpar.com/license/
  ======================================================== -->

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <a href="../index"><img src="../assets/img/new-talents.png" alt="" class="img-fluid"></a>
      </div>
		
      <nav class="nav-menu d-none d-lg-block">
        <ul>          
          <li class="get-started"><a href="../login">Iniciar sesión</a></li>
        </ul>
      </nav>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="registre" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-8 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          
          <div class="row">
            <div class="col-lg-12">
              <h1>Regístrese y se parte de la comunidad de los mejores talentos y profesionales</h1>        
            </div>
            <div class="col-lg-8">    

            <?php 
              if(isset($errors) && count($errors) > 0)
              {
              	foreach($errors as $error_msg)
              	{
              		echo '<div class="alert alert-danger">'.$error_msg.'</div>';
              	}
              }
              {
                echo '<div class="alert alert-warning">'.$alertEmail.'</div>';
              }

              if(isset($success))
              {
                echo '<div class="alert alert-success">'.$success.'</div>';
              }
             ?>

              <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" role="form" class="php-email-form" data-aos="fade-up">
                <div class="form-group">
                  <input placeholder="Email" type="email" class="form-control" name="email" id="email" value="<?php echo ($valEmail??'')?>" />
                  <!--<div class="validate"></div>-->
                    <?php
                      echo '<div class="alertMessage">'.($alertMessage1??'').'</div>';
                    ?>
                </div>
                <div class="form-group">
                  <!--<input placeholder="Contraseña" type="password" class="form-control" name="password" id="password" data-rule="minlen:6" data-msg="Ingrese al menos 6 caracteres" />-->
                  <input placeholder="Contraseña" type="password" class="form-control" name="password" id="password" value="<?php echo ($valPassword??'')?>" />
                  <!--<div class="validate"></div>-->
                    <?php
                      echo '<div class="alertMessage">'.($alertMessage2??'').'</div>';
                    ?>
                </div>
                <div class="mb-3">

                  <div class="legal">
                    Al hacer clic en "Aceptar y registrarse", aceptas las <a href="../legal/user-agreement">Condiciones de uso</a>, 
                    la <a href="../legal/privacy-policy">Política de privacidad</a> y la <a href="../legal/cookie-policy">Política de cookies</a> de New Talents.
                  </div>                  

                </div>
                <button class="registre-btn" name="submit" type="submit">Aceptar y registrarse</button>
                
                  <div class="linea">o</div>
                
                <a href="#" class="google-btn"><i class="bx bxl-google"></i> Regístrate con Google</a>

                <p>¿Ya eres usuario de New Talents? <a href="../login">Iniciar sesión</a></p>

              </form>
            </div>

          </div>
        </div>        
        
        <div class="col-lg-4 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <div class="registre-img">
            <img src="../assets/img/registre-img.jpg" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </div>

  </section><!-- End Hero -->

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <!--<script src="../assets/vendor/php-email-form/validate.js"></script>-->
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>