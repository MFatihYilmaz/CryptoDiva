<?php
ini_set("display_errors", 1);
require("../instance.php");
$users = $model->getUsers();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
</head>

<body>
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

                            <table class="table align-middle mb-0 bg-white">
                                <thead class="bg-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Mail</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($users as $user) {
                                        echo '
        <tr>
        <td>
        <p class="fw-normal text-center mt-2">' . $user["id"] . '</p>
        </td>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="../images/' . $user["id"] . '.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ml-3">
            <p class="fw-bold mb-1">' . $user["firstName"] . ' ' . $user["lastName"] . '</p>
          </div>
        </div>
      </td>
      <td>
      <p class="fw-normal mb-1">' . $user["mail"] . '</p>
        
      </td>
      
      <td>
      <a href="delete?user-id=' . $user["id"] . '">Delete</a>
        
      </td>
    </tr>
        
        ';
                                    }
                                    ?>


                                </tbody>
                            </table>




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