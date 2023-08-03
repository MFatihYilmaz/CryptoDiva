<?php 
session_start();
require("../includes/instance.php");
require("../includes/validate.php");
if(!isset($_SESSION["login"])){
    header("location:./login.php");
}
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

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php require("../layout/sidebar.php") ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <?php require("../layout/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Currency</h1>
                    </div>

                   <div class="row">
                   
                        <div class="container my-5 py-5">
                        <div class="row d-flex justify-content-center py-5">
                          <div class="col-md-7 col-lg-5 col-xl-4">
                            <div class="card" style="border-radius: 15px;"> 
                            <div class="card-body p-4">
                                <?php 
                                     if(isset($_SESSION['warn'])){
                                        echo "
                                            <div class='alert alert-danger text-center'>
                                                <i class='fas fa-exclamation-triangle'></i> ".$_SESSION['warn']."
                                            </div>
                                        ";
                     
                                        unset($_SESSION['warn']);
                                    }
                                ?>
                                <form method="post">
                                  <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-outline">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-dollar-sign fa-xl"></i></span>
                                    
                                      <input name="dollar" type="number" id="dollar" class="form-control" siez="17"
                                        minlength="1" maxlength="9" step="any" min="5"
                                        placeholder="Enter amount of dollar" />
                                        </div>
                                        <label class="form-label" for="typeText">Load Dollar</label>
                                    </div>
                                    <img src="https://img.icons8.com/color/48/000000/visa.png" alt="visa" width="64px" height="64px" />
                                    <button type="submit" class="btn btn-info btn-lg btn-rounded d-block">
                                      <i class="fas fa-arrow-right"></i>
                                    </button>  
                                </div>


                                  
                                    
                                  
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                   </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                         

                          

                        </div>

                    </div>

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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php 
if(isset($_POST["dollar"])){
    
    try {
        $sql = "SELECT * FROM USD WHERE user_id=" . $_SESSION["u_id"];
        $ctrl=$db->query($sql,PDO::FETCH_ASSOC);
        if($ctrl->rowCount()){
            $update="UPDATE USD SET quantity=quantity+".$_POST["dollar"]." WHERE user_id=".$_SESSION["u_id"];
            $query = $db->query($update, PDO::FETCH_ASSOC);

        }else{
            $sql="INSERT into `USD` (`user_id`,`quantity`) values (?,?)";
            $stmt=$db->prepare($sql);
            $stmt->bindParam(1,$_SESSION["u_id"],PDO::PARAM_INT);
            $stmt->bindParam(2,$_POST["dollar"]);
            $stmt->execute();
            if($stmt->rowCount()){
                $_SESSION["warn"]="Loading balance is successful";
            }else{
                $_SESSION["warn"]="Error occurred!";
            }
        }
    
    } catch (PDOException $e) {
    print_r($e);
    }
    
}



?>