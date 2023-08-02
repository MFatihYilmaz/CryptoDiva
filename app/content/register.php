<?php 
require_once("instance.php");
session_start();
if(isset($_POST['submit'])){
    if(!isset($_POST['pass']) || 3 > strlen($_POST['pass'])) {
      $_SESSION["error"]= 'Your Username has to be at least 3 Characters long.';
    }else{

      $name=$_POST["name"];
      $sname=$_POST["surname"];
      $pass=$_POST["pass"];
      $conf=$_POST["confirm"];
      $mail = $_POST["mail"];
      preg_match("/@(.*)/", $mail, $matches);
      $result = $matches[1];
      $val=$model->mailControl($result);
      if(strlen($val)==0){
      
        $_SESSION["error"]="Böyle bir mail adresi bulunmamaktadır";
      
      }elseif($model->isUserEmailInUse($_POST["mail"])){
        
          $_SESSION["error"]="Mail kullanılmaktadır!";
      }elseif($pass==$conf){
        $hash=password_hash($pass, PASSWORD_DEFAULT);
        try{ 
         $db->query("INSERT INTO users(firstName,lastName,mail,password) values ('$name','$sname','$mail','$hash')");
         header("location:./login");
        }
        catch(PDOException $e){
          $_SESSION["error"]="Hata meydana geldi. $e";
        
        }
    
          
            
          }else{
            $_SESSION["error"]="Şifreler aynı değil";
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b0a102317.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Registiration</title>
</head>
<body class="gradient-custom-3" >

<section class="bg-image vh-100" style="height: 100vh;">
  <div class="mask d-flex align-items-center h-100 ">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>
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
              <form action="register.php" method="post">

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" required>
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="surname"  required>
                  <label class="form-label" for="form3Example2cg">Your Surname</label>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" id="form3Example3cg" class="form-control form-control-lg" name="mail" required>
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="pass" required>
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="confirm" required>
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                </div>
                
                <div class="form-check justify-content-center mb-5">
                 
                <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                  <input style="margin-left: 1em;" class="form-check-input me-2" onchange="document.getElementById('regis').disabled=!this.checked;" type="checkbox" value="" id="form2Example3cg"> 
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="regis" name="submit">Register</button>
                </div>
                </form>
                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="register.js"></script>
</body>
</html>

