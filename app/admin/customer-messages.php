<?php
require_once("../instance.php");
$resp = $model->getUsersMessage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Messages</title>
</head>

<body>


    <div id="wrapper">

        <?php
        include("admin-sidebar.php");
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->

                        </li>





                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["name"], " ", $_SESSION["surname"]; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bold text-center">Messages</h1>
                    </div>
                    <div id="alerts"></div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="container">

                            <main role="main">
                                <div class="d-flex align-items-center p-3 my-3 text-white bg-primary rounded box-shadow">
                                    <div class="lh-100">
                                        Messages
                                    </div>
                                </div>
                                <img src="../images/" alt="">

                                <div class="my-3 p-3 bg-white rounded box-shadow">
                                    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>

                                    <?php
                                    foreach ($resp as $user) {
                                        echo ' 
                                    <div class="media text-muted pt-3">
                                    <div class="media-left media-top"> 
                                        <img src="../images/'.$user["id"].'.jpg" alt="" class="mr-2 rounded align-self-center" width="40" height="40">
                                        <p class="text-gray-dark mr-4 text-sm-left"><small>'.$user["firstName"].' '.$user["lastName"].' </small></p>
                                        </div>
                                        <div class="media-body">
                                        <h5 class="mt-0">'.$user["subject"].'</h5>
                                            <p>'.$user["content"].'</p>
                                        </div>
                                        
                                    </div>';
                                    }
                                    ?>


                                </div>
                            </main>




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