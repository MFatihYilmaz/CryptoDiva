<?php
use Firebase\JWT\Key;
include_once("instance.php");
require_once("/var/www/html/mywebsite/app/vendor/autoload.php");
use \Firebase\JWT\JWT;
ob_start();
session_start();
ini_set("display_errors",1);
if(isset($_SESSION["login"])){
  header("location:./profile");
}
 
if(isset($_POST["submit"])){
  if(true/*isset($_POST["g-recaptcha-response"])*/){
    $secretkey="6Lfv38siAAAAAJ_QBGvamrPNNyrQYUOUZeJP_O1B";
    $ip=$_SERVER['REMOTE_ADDR'];
    //$response=$_POST["g-recaptcha-response"];
   // $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
   // $fire=file_get_contents($url);
   // $data=json_decode($fire);
    if(true/*$data->success==true*/){
      $mail=$_POST["mail"];
      $pass=$_POST["password"];
      $ctrl=$db->query("SELECT * from users WHERE mail='$mail'",PDO::FETCH_ASSOC);
      if($ctrl->rowCount()){      
        foreach($ctrl as $as){
          $hash=$as["password"];
          $name=$as["firstName"];
          $surname=$as["lastName"];
          $id=$as["id"];
          $email=$as["mail"];
        }
        if(password_verify($pass,$hash)){
          $_SESSION["login"]=1;
          $_SESSION["name"]=$name;
          $_SESSION["surname"]=$surname;
          $_SESSION["u_id"]=$id;
          
          $payload = [
            'iss' => "localhost",
            'aud' => 'localhost',
            'exp' => time() + 3600, //10 dakika
            'u_id' => $id,
            'isAdmin'=> ($id==27)
        ];
        $secret_key="saltbea";
        $jwt=JWT::encode($payload,$secret_key,'HS256');
        setcookie('jwt_token', $jwt, time() + (86400 * 30), "/","",true,true);
        ?>
        
      
        <?php
       header("location:./profile");
        

       

        }else{
          $_SESSION["error"]="Mail veya şifre hatalı";
              
          
        }
      }else{
        $_SESSION["error"]="Mail veya şifre hatalı";
        
      }
    }
    else{
      $_SESSION["error"]="Please fill Captcha";
    }
  }
  
     
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b0a102317.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Login/Register</title>
</head>
<body>
<!-- Write your comments here <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
          <?php
                if(isset($_SESSION['error'])){
                    echo "
                        <div class='alert alert-danger text-center'>
                            <i class='fas fa-exclamation-triangle'></i> ".$_SESSION['error']."
                        </div>
                    ";
 
                    unset($_SESSION['error']);
                }

            ?> 
            <div class="mb-md-5 mt-md-4 pb-5">
                <form action="login" method="post">
            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input name="mail" type="email" id="typeEmailX" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>
              
              <div class="form-outline form-white mb-4">
                <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" required/>
                <label class="form-label" for="typePasswordX">Password</label>
              </div>

              <!-- <div class="g-recaptcha" data-sitekey="6Lfv38siAAAAAHxhR4RaFx9VXIQ2jDM5L5UEosJE"></div> -->

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
              
              
              <button name="submit" class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
            </form>
             
            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="register" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


</html>
<?php 
ob_end_flush();
?>