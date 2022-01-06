<?php                           
    $dsncnn     = 'mysql:dbname=dbntalents;host=localhost';
    $user       = 'root';
    $password   = '';

    try{        
        $pdo = new PDO($dsncnn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOExeption $e){
        echo "PDO error".$e->getMessage();
        die();
    }
?>