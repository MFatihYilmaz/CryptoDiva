<?php
session_start();
require("instance.php");
ini_set("display_errors",0);
$user=$model->getUser($_SESSION["u_id"]);
$name=$user[0]["firstName"];
$sname=$user[0]["lastName"];
$mail=$user[0]["mail"];
if(isset($_GET["url"]) && $_GET["url"]!="" ){
  if(str_contains($_GET["url"],"base64")){
    $data=$_GET["url"];
    if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
      $data = substr($data, strpos($data, ',') + 1);
      $type = strtolower($type[1]); // jpg, png, gif
  
      if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
          throw new \Exception('invalid image type');
      }
      $data = str_replace( ' ', '+', $data );
      $data = base64_decode($data);
  
      if ($data === false) {
          throw new \Exception('base64_decode failed');
      }
  } else {
      throw new \Exception('did not match data URI with image data');
  }
  }else{
    $data=$_GET["url"];
    $data=file_get_contents($data);
    
  }
  file_put_contents("/var/www/html/mywebsite/images/".$_SESSION["u_id"].".jpg",$data);
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous"
  />
  <script
    src="https://kit.fontawesome.com/5b0a102317.js"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"
  ></script>
    <title>Settings Menu</title>
</head>
<body id="page-top">
<div id="wrapper">
<?php 
include("sidebar.php");
?>
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->
        <div class="row">
            <div class="container">
     
            <div class="main-content">
        <div class="container light-style flex-grow-1 container-p-y">
    
            <h4 class="font-weight-bold py-3 mb-4">
              User Settings
            </h4>
        
            <div class="card overflow-hidden">
              <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                  <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active " data-toggle="list" href="#account-general">General</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-profile">Profile Photos</a>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">
        
                      
                      <hr class="border-light m-0">
                      <form action="change-info?uid=<?php echo $_SESSION["u_id"]?>" method="post">
                      <div class="card-body">
                        
                        <div class="form-group">
                          <label class="form-label">Name</label>
                          <input type="text" class="form-control mb-1" name="name" value="<?php echo $name;?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Surname</label>
                          <input type="text" class="form-control" name="surname" value="<?php echo $sname;?>">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Mail</label>
                          <input type="email" class="form-control mb-1" name="email" value="<?php echo $mail;?>">
                        </div>
                        
                      </div>
                      <div class="text-right mt-3">
                        <button id="sub" type="submit" onclick="return confirm('Değişiklikler kaydedilecektir emin misiniz?')" class="btn btn-primary">Save changes</button>&nbsp;
                        <button type="button" class="btn btn-default">Cancel</button>
                      </div>
                    </form>
        
                    </div>
                    <div class="tab-pane fade" id="account-change-password">
                      <form action="" method="post">
                      <div class="card-body pb-2">
        
          
        
                        <div class="form-group">
                          <label class="form-label">New password</label>
                          <input type="password" name="password" class="form-control">
                        </div>
        
                        <div class="form-group">
                          <label class="form-label">Repeat new password</label>
                          <input type="password" name="repass" class="form-control">
                        </div>
        
                      </div>
                      <div class="text-right mt-3">
                        <button id="sub" type="submit" onclick="return confirm('Değişiklikler kaydedilecektir emin misiniz?')" class="btn btn-primary">Save changes</button>&nbsp;
                        <button type="button" class="btn btn-default">Cancel</button>
                      </div>
                    </form>
                    </div>

                    <div class="tab-pane fade" id="account-change-profile">
                    <form action="settings" method="get">
                      <div class="card-body pb-2">
        
          
                        <div class="form-group">
                          <?php 
                          echo "<div class='d-flex flex-column align-items-center text-center p-3'> <img class='rounded-circle mt-5' width='150px' src='./images/".$_SESSION["u_id"].".jpg'> </div>"
                          ?>
                          </div>
                        <div class="form-group">
                          <label class="form-label">Type the image url</label>
                          <input type="text" name="url" class="form-control">
                        </div>
        
                      </div>
                      <div class="text-right mt-3">
                        <button id="sub" type="submit" onclick="return confirm('Değişiklikler kaydedilecektir emin misiniz?')" class="btn btn-primary">Save changes</button>&nbsp;
                        <button type="button" class="btn btn-default">Cancel</button>
                      </div>
                    </form>
                    </div>
                    
      
                  </div>
                </div>
              </div>
            </div>
        
        
          </div>
        </div>
          <script>
            $(".account-settings-links a").click(function(e){
              e.preventDefault()
              $(this).addClass("active").siblings().removeClass('active');
              var targ=$(this).attr("href");
              $(targ).addClass("active show").siblings().removeClass('active show');
    
            });
          </script>    

           

</div>            

           
        </div>

        <!-- Content Row -->

        <?php
if(isset($_SESSION['error'])){
  echo "
      <div class='text-center'>
          <i class='fas fa-exclamation-triangle'></i>Search for ".$_SESSION['error']."
      </div>
  ";

  unset($_SESSION['error']);
}
?>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Best Crypto Market Ever</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
    </div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/sb-admin-2.js"></script>

</body>

</html>
  
