<?php 
session_start();
include("../includes/instance.php");
ini_set('display_errors',0);
if($_SERVER["REQUEST_METHOD"]==='POST'){
    $sbj=filter_input(INPUT_POST,'subj',FILTER_SANITIZE_SPECIAL_CHARS);
    $msg=filter_input(INPUT_POST,'message',FILTER_SANITIZE_SPECIAL_CHARS);
    $model->sendMessageToAdmin($_SESSION["u_id"],$sbj,$msg);
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b0a102317.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Contact Form</title>
</head>
<body>
<div id="wrapper">

<?php 
include("../layout/sidebar.php");
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <?php
                require("../layout/topbar.php");
                ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold text-center">Contact Form</h1>
            </div>
            <div id="alerts"></div>

            <!-- Content Row -->
            <div class="row">
                <div class="container">
         
                <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card text-white" style="border-radius: 1rem; background-color:darkcyan;">
          <div class="card-body p-5 text-center">
          
            <div class="mb-md-5 mt-md-4 pb-5">
                <form action="contact" method="post">
            <h2 class="fw-bold mb-2 text-uppercase">Contact to admin</h2>
              <p class="text-white-50 mb-5">Fill the required fields!</p>

              <div class="form-outline form-white mb-4">
                <input name="subj" type="text" id="typeEmailX" class="form-control form-control-lg" required/>
                <label class="form-label" for="typeEmailX">Subject</label>
              </div>
              
              <div class="form-outline form-white mb-4">
                <textarea name="message" class="form-control form-control-lg" cols="30" rows="10"></textarea>
                <label class="form-label" for="typePasswordX">Message</label>
              </div>

             

              
              
              <button name="submit" class="btn btn-outline-light btn-lg px-5" type="submit">Send</button>
            </form>
             
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
               

               

</div>            

               
            </div>

            <!-- Content Row -->


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

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>
<script src="../js/sb-admin-2.js"></script>



    

</body>
</html>