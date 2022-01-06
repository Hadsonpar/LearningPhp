<?php
session_start();
require_once('config/dbconfig.php');

if (isset($_POST["email"])) {
    $vEmail = $_POST['email'];
    $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    
    if(empty($vEmail)){
        echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Favor ingresa un correo electrónico...!</b>
			</div>
		";
		exit();
    }else{
        if(!preg_match($emailValidation,$vEmail)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Este $vEmail no es válido..!</b>
			</div>
		";
		exit();
	}
        $sql      = "SELECT email_id FROM email_info WHERE email = :pemail LIMIT 1";
        $script   = $pdo->prepare($sql);
        $sqlEmail = ['pemail'=>$vEmail];
        $script->execute($sqlEmail);/* Ejecutar (DML) SELECT en base al filtro del e-mail ingresado */

        if($script->rowCount() > 0){
            echo "
                <div class='alert alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>El correo electrónico ya está registrado</b>
                </div>
            ";
            exit();
        }else{

            $sql = "insert into email_info (email_id, email) values (:id, :pemail)";
            $handle   = $pdo->prepare($sql);
            $sqlParams = [':id'=>null,
                          ':pemail'=>$vEmail];
            $handle->execute($sqlParams);   /* Ejecutar (DML) INSERT */

                echo "<div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Gracias por suscribirse</b>
                </div>";              
            }        
    }    
}
?>