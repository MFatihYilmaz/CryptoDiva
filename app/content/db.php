<?php
$dsn="mysql:host=127.0.0.1;dbname=sqli";
$uname="diva";
$pass="diva";
try {

    $db=new PDO($dsn,$uname,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
} catch (PDOException $e) {
    $error="Database error ";
    $error.=$e->getMessage();
    include("./view/error.php");
}


?>