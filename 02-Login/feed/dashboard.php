<?php
    /* Capturamos la sessión */
    session_start();
    /* Validamos la sessión */
    if(!$_SESSION['iduser']){
        header('location:../login.php');
    }
?>

<h1>Bienvenido...!</h1>
<?php 
    /* Capturamos el nombre del usario y correo */
    echo strtoupper($_SESSION['user'])."<br>";
    echo ucfirst($_SESSION['email']);
?>