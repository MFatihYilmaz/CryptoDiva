<?php 
session_start();
 // delete session data
 session_unset();
 session_destroy();
setcookie("jwt_token","",time()-3600,"/");
 // redirect
 header("location:./")
?>