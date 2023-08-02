<?php 
session_start();
if(isset($_POST["xml"])){
    echo $_POST["xml"];
    $url="https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=&order=market_cap_desc&per_page=100&page=1&sparkline=false";
    $_SESSION["api"]=0;
}
try{
    $ch=curl_init();
    $url="https://api.coincap.io/v2/assets";
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $asd=curl_exec($ch);
    $resp=json_decode($asd,true);
}catch(Exception $e){
    $error=$e;
    include("./view/error.php");
    exit();
}
?>