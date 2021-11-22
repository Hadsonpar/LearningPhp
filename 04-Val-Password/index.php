<?php
require_once('utilities/valpassword.php');
<<<<<<< HEAD

=======
>>>>>>> bba19eeb068e41b0c459eb7e2d0f851f2ef5fac8
if ($_POST){
   $error_encontrado="";
   if (validar_clave($_POST["clave"], $error_encontrado)){
      echo "<div class='col-4 alert alert-success' role='alert'>
            PASSWORD VÁLIDO!
            </div>";
   }else{
      echo "<div class='col-4 alert alert-danger' role='alert'>
            PASSWORD NO VÁLIDO ". $error_encontrado.
            "</div>";
<<<<<<< HEAD

   }
}
?>

=======
   }
}
?>
>>>>>>> bba19eeb068e41b0c459eb7e2d0f851f2ef5fac8
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Validar Password</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<<<<<<< HEAD

<body>
    <form action="index.php" method="post">        
                
                Escribe un Password:
                <input type=password name="clave">
                <input type="submit" value="Enviar">     
                
    </form>

=======
<body>
    <form action="index.php" method="post">        
                
        Escribe un Password:
        <input type=password name="clave">
        <input type="submit" value="Enviar">     
                
    </form>
>>>>>>> bba19eeb068e41b0c459eb7e2d0f851f2ef5fac8
</body>
</html>