<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
<style>
      .nav-link{
        font-size: 1.2em;
      }
      .navbar-brand{
        font-family: Arial, Helvetica, sans-serif;
        font-style: bold;
        font-size: 2em;
      }
    </style>
<div id="wrapper">
        <?php
        require("admin-sidebar.php");
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php require("admin-topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bold text-center">Customers</h1>
                    </div>
                    <div id="alerts"></div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container">

                          <h3>Admin Index Page</h3>


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
</body>
</html>