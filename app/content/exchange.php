<?php
include("../layout/api.php");
include("../includes/instance.php");
if($_SESSION["login"] && isset($_GET["crypto"])){
ini_set('display_errors', 0);

    $doc=new DOMDocument();
    $postData =file_get_contents('php://input');
    $xml=simplexml_load_string($postData,'SimpleXMLElement',LIBXML_NOENT | LIBXML_DTDLOAD);
    if(strval($xml->name)!=""){
      $_SESSION["next_id"]=strval($xml->name);
    }
                      
    
 
    if($_GET["crypto"]=="bitcoin" || $_GET["crypto"]=="polkadot" || $_GET["crypto"]=="solana" || $_GET["crypto"]=="ethereum"){
      // resp api'dan geliyor.  
     try {
     
      foreach($resp["data"] as $val){
            if($val["id"]===$_GET["crypto"]){
                $price=$val["priceUsd"];
                $_SESSION["cr_id"]=$_GET["crypto"];
                if(isset($_POST["amount"])){
                $model->buyCrypto($_SESSION["u_id"],$_GET["crypto"],$_POST["amount"],$price);
                }
                elseif(isset($_POST["samount"])){
                  //money kontrol satarken problem çıkıyor kontrol et 
                  $model->sellCrypto($_SESSION["u_id"],$_GET["crypto"],$_POST["samount"],$price);
                  
                }
                
            }

        }
      $amountCrypto=$model->getUserCryptoCurrency(intval($_SESSION["u_id"]),$_GET["crypto"]);
      $usd=$model->getUsd($_SESSION["u_id"]);
     
      
    } catch (Exception $e) {
      $_SESSION["error"];
      echo $e;
     } 

    }else{
        $_SESSION["error"]="Sadece BTC ETH SOL DOT verileriyle alışveriş yapılabilir";
       
        
    }

}else{
  header("location:./marketplace");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b0a102317.js" crossorigin="anonymous"></script>
     <!-- Bootstrap core JavaScript-->
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <link rel="stylesheet" href="/css/exchange.css">
    <title>Buy/Sell Crypto</title>
</head>
<body>
<script type="text/javascript">
  function myFunction(){
    var xml = ''+
    '<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>' +
        '<value>' +
        '<name>' + $('#cryptos').val()+ '</name>' +
        
        '</value>';
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState == 4){
            console.log(xmlhttp.readyState);
            console.log(xmlhttp.responseText);
            window.location.href = "/exchange?crypto="+$('#cryptos').val();
            console.log("<?php echo $_SESSION["next_id"] ?>");
        }
    }
    xmlhttp.open("POST","exchange.php?crypto="+"<?php echo $_SESSION["cr_id"] ?>",true);
    xmlhttp.setRequestHeader("Content-Type", "application/xml");
    xmlhttp.send(xml);
    
  };
  
</script> 

<section class="bg-image">
  <div class="mask d-flex h-100 gradient-custom-3">
  

    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
        <div class="card " style="border-radius: 15px;">
            <div class="card-body p-5">
            <h2 class="text-uppercase text-center mb-5">Bakiye</h2>
            <?php echo "
            <p class='text-uppercase'>
            " . $_GET["crypto"] . " = " . $amountCrypto . "
            </p>
            <p class='text-uppercase'>
            USD = " .$usd. "
            </p>
            ";
            ?>
          </div>
  </div>
          <div class="card mt-3" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">BUY CRYPTO</h2>
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
           <?php echo "
           <form class='form-outline' action='exchange.php?crypto=".$_SESSION["cr_id"]."' method='post'> "
           ?>
             
             
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount">
            
            

            <button class="btn btn-success" type="submit">Buy Kripto</button>

        </form>

             
        </div> 
          </div>
          <div class="card mt-5" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">SELL CRYPTO</h2>
              <?php echo "
           <form class='form-outline' action='exchange.php?crypto=".$_SESSION["cr_id"]."' method='post'> "
           ?>
             
             
            <label for="amount">Amount</label>
            <input type="number" name="samount" id="amount">
            
            

            <button class="btn btn-danger" type="submit">Sell Kripto</button>

        </form>
            </div>
          </div>
            <label for="cryptos">Choose a cypto to see value:</label>
            <select name="cryptos" id="cryptos">
              <option value="bitcoin">bitcoin</option>
              <option value="polkadot">polkadot</option>
              <option value="ethereum">ethereum</option>
              <option value="solana">solana</option>
            </select>
            <button class="btn btn-primary" id="cr" onclick="myFunction()">btn</button>
       
        </div>
      </div>
      </div>
      </div>



</section>

</body>
</html>