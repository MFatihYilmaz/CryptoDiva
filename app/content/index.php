<?php
session_start(); 
include("../layout/api.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b0a102317.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Crypto Market</title>

</head>
<body>
<?php require("../layout/nav.php") ?>

   <div class="container">
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
   <table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Name</th>
      <th>Price</th>
      <th>24 h Volume</th>
      <th>MarketCap</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    
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
        ".(($_SESSION['login'])? "<a href='exchange?crypto=".$row["id"]."' class='btn btn-primary stretched-link buy'>Buy </a>":"<button onclick=\"location.href='./login'\" type='button' class='btn btn-link btn-sm btn-rounded'>Buy </button>")."
      </td>
    </tr>";
  
  }
    ?>
   
    
  </tbody>
</table>
    </div>    
</body>
</html>
