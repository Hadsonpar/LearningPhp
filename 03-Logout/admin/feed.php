<?php
    session_start();

    if(!$_SESSION['iduser']){
        header('location:../login.php');
    }
?>


<h1>Bienvenido...!</h1>
<?php 
    echo ucfirst($_SESSION['user']);
?>
<br/>
<a href="../logout.php?logout=true" >Cerrar Session</a>