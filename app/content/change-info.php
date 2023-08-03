<?php 
session_start();
require("../includes/instance.php");
ini_set("display_errors",0);
include("../includes/validate.php");

if($token->u_id!=$_GET["uid"]){
  error(401,"");
  header("location:./settings");
}
if(isset($_GET["uid"]) and isset($_POST["name"])){
    if(!$model->isUserEmailInUse($_POST["mail"])){
        $model->changeUserInfo($_SESSION["u_id"],$_POST["name"],$_POST["surname"],$_POST["email"]);
        $_SESSION["name"]=$_POST["name"];
        $_SESSION["surname"]=$_POST["surname"];
        header("location: settings");
      }else{
        $_SESSION["error"]="Mail is used !";
      }
}

?>