<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Crypto Marketplace</a>
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarNav"
        aria-controls="navbarNav"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fs-3" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-3" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-3" href="marketplace">Market</a>
          </li>
          <li class="nav-item">
           <?php 
           if($_SESSION["login"]){
            echo "<a class=\"nav-link fs-3\" href=\"profile\">Profile</a>";
           }else{
            echo "<a class=\"nav-link fs-3\" href=\"login\">Login/Register</a>";
           }
           ?>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-3" href="#">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>