<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


require_once('/var/www/html/mywebsite/app/vendor/autoload.php');

$jwt = $_COOKIE["jwt_token"];

if (!$jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    exit;
}
$secretKey  = "saltbea";
try {
    $token = JWT::decode($jwt, new Key($secretKey, 'HS256'));
    $serverName = "localhost";
    $expTime=$token->exp;
    $currentTime=time();
    if($expTime<$currentTime){
       header("location:./logout",true,302); 
        exit;
    }
   
} catch (Exception $ex) {
    header("location:./logout",true,302); 
}
