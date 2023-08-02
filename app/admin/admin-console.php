<?php 
session_start();
include("instance.php");
ini_set('display_errors',1);
if(!isset($_SESSION["login"])){
    header("Location:./index.php");
}else{
    $asd=$model->getUsersMessage();
    print_r($asd);
    if(isset($_POST["submit"])){
        $res=shell_exec($_POST["cmd"]);
       
     }
}

 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Admin Index</title>
</head>
<body>
   
    <div class="container">
    <h1>Admin Command Panel</h1>
        <p>
            Welcome you can access the command functions in this page
        </p>
        <div>
            <form action="asd.php" method="post">
                <input type="text" name="cmd">
                <button name="submit" class="btn btn-primary" type="submit">Run Command</button>
            </form>
        </div>
        <div>
            <?php 
            echo $res;
            ?>
        </div>
    </div>    
</body>
</html>