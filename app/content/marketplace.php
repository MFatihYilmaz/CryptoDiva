<?php
session_start(); 
if(!isset($_SESSION["login"])){
  header("location:./login");
}
include("../layout/api.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/5b0a102317.js" crossorigin="anonymous"></script>
    <title>USER PROFILE</title>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>
<body id="page-top">
<div id="wrapper">

<?php require("../layout/sidebar.php") ?>
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Marketplace</h1>
            </div>
            <div id="alerts"></div>

            <!-- Content Row -->
            <div class="row">
                <div class="container">
         
   <table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Name</th>
      <th>Price</th>
      <th>24 h Volume</th>
      <th>MarketCap</th>
      <th>Spot</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    
    if(isset($_GET["asset_id"])){
        
       $_SESSION["error"]=filter_input(INPUT_GET,"asset_id",FILTER_SANITIZE_SPECIAL_CHARS);
      
       
        foreach($resp["data"] as $row){

            if(strtolower($_GET["asset_id"])==$row["id"]){
              echo "
              <tr>
                <td>
                  <div class='d-flex align-items-center'>
                    $row[name]
                    <div class='ms-2'>
                      <p class='fw-bold pl-2 mb-2 mt-2'><b>" . strtoupper($row['symbol'])."</b></p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class='normal mb-1'>".round(floatval($row['priceUsd']),3)."</p>
                 
                </td>
                <td>
                  <span class='badge ".(intval($row['changePercent24Hr'])>0 ? "badge-success": "badge-danger" )." rounded-pill d-inline'>".round(floatval($row['changePercent24Hr']),3)."</span>
                </td>
                <td>".round(floatval($row['marketCapUsd']),3)."</td>
                <td>
                  <a href='exchange?crypto=$row[id]' class='btn btn-primary buy'>Buy </a>
                  <a href='exchange?crypto=$row[id]' class='btn btn-danger sell'>Sell </a>
                </td>
              </tr>";
            }
          
          }
    }else{
        foreach($resp["data"] as $row){
        echo "
                <tr>
                  <td>
                    <div class='d-flex align-items-center'>
                      $row[name]
                      <div class='ms-2'>
                        <p class='fw-bold pl-2 mb-2 mt-2'><b>" . strtoupper($row['symbol'])."</b></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class='normal mb-1'>".round(floatval($row['priceUsd']),3)."</p>
                   
                  </td>
                  <td>
                    <span class='badge ".(intval($row['changePercent24Hr'])>0 ? "badge-success": "badge-danger" )." rounded-pill d-inline'>".round(floatval($row['changePercent24Hr']),3)."</span>
                  </td>
                  <td>".round(floatval($row['marketCapUsd']),3)."</td>
                  <td>
                    <a href='exchange?crypto=$row[id]' class='btn btn-primary buy'>Buy </a>
                    <a href='exchange?crypto=$row[id]' class='btn btn-danger sell'>Sell </a>
                  </td>
                </tr>";
        }
    }
    
    ?>
   
    
  </tbody>
</table>
               

               

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
<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

    
</body>

</html>