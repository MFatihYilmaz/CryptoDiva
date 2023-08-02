<?php
require("../instance.php");
ini_set("display_errors", 1);
if(isset($_GET["user-id"])){
    $model->removeUser($_GET["user-id"]);
    
    header("Location:/admin/customers",true,302);
}
?>