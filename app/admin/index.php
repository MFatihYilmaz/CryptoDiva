<?php 
use Firebase\JWT\Key;
include_once("../includes/instance.php");
require_once("/var/www/html/mywebsite/app/vendor/autoload.php");
use \Firebase\JWT\JWT;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset($_POST["email"]) && isset($_POST["password"])){
    
  }else{
    error(402,"Authantication Required");
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
    <title>Admin Login</title>
</head>
<body style="background-color: #508bfc;">
<!-- Write your comments here <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Admin Login</h3>

            <div class="form-outline mb-4">
              <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Email</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>

            
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

            <hr class="my-4">

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