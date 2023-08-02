<?php
include("db.php");
include("functions.php");
session_start();
class Model
{
  private $db = null;

  public function __construct($pdb)
  {
    $this->db = $pdb;
  }


  public function isUserEmailInUse($pEmail)
  {
    try {
      $sql = 'SELECT * FROM users WHERE mail = \'' . $pEmail . '\'';
      $result = $this->db->query($sql);
      return ($result->rowCount()>0);
    } catch (Exception $ex) {
      echo "Query not executed $ex";
    }
  }
  public function userSignIn($tEmail, $tPass)
  {
    $sql = 'SELECT mail from users';
    $response = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function userLogIn($mail, $pass)
  {

    $ctrl = $this->db->query("SELECT * from users WHERE mail='$mail'", PDO::FETCH_ASSOC);
    if ($ctrl->rowCount()) {
      foreach ($ctrl as $as) {
        $hash = $as["password"];
        $name = $as["firstName"];
        $surname = $as["lastName"];
        $id = $as["id"];
      }
      if (password_verify($pass, $hash)) {
        $_SESSION["login"] = 1;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["u_id"] = $id;
        header("location:./profile.php");
      } else {
        $_SESSION["error"] = "Mail veya şifre hatalı";
        header("location:./login.php");
      }
    } else {
      $_SESSION["error"] = "Mail veya şifre hatalı";
      header("location:./login.php");
    }
  }

  public function mailControl($mail)
  {

    $output = shell_exec("dig +short mx $mail");

    return $output;
  }
  public function getUsers()
  {
    $sql = 'SELECT * FROM users';
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUser($u_id)
  {
    try {
      $sql = 'SELECT * FROM users WHERE id='.$u_id;
      return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      error(500, 'Query could not be executed', $ex);
    }
    
  }
  public function removeUser($u_id){
    $resp=$this->getUser($u_id);
    if($resp->rowCount()){
      $sql='DELETE FROM users WHERE id=?';
      $stmt= $this->db->prepare($sql);
      $stmt->execute([$u_id]);
    }else{
      error(500,"User not found");
    }
  }

  public function changeUserInfo($u_id,$name,$sname,$mail){
    try {
      $sql='UPDATE users SET firstName=?, lastName=?, mail=? WHERE id=?';
      $res=$this->db->prepare($sql);
      $res->execute([$name,$sname,$mail,$u_id]);
    } catch (PDOException $th) {
      echo $th;
      error(500,"Information error",$th);
    }
  }
  function changeUserPass($u_id,$pass){
    
  }
  


  public function getUsd($u_id)
  {
    $sql = 'SELECT * FROM USD Where user_id=' . $u_id;
    $usd = $this->db->query($sql, PDO::FETCH_ASSOC);
    if ($usd->rowCount()) {
      foreach ($usd as $resp) {
        return $resp["quantity"];
      }
    }
  }

  public function updateMoney($money, $u_id)
  {
    $sql = 'UPDATE USD SET quantity=\'' . $money . '\' WHERE user_id =' . $u_id;
    $response = $this->db->exec($sql);
    return ($response !== 0);
  }


  public function buyCrypto($u_id, $crypto, $amount, $price)
  {
    $total = $amount * $price;
    $currentUsd = $this->getUsd($u_id);
    if ($currentUsd >= $total) {
      $sql = 'UPDATE ' . $crypto . ' SET quantity=quantity + ' . $amount . ' WHERE user_id=' . $u_id;
      $this->db->exec($sql);
      $updatedMoney = $currentUsd - $total;
      $this->updateMoney($updatedMoney, $u_id);
    } else {
      $_SESSION["error"] = "Yetersiz bakiye";
    }
  }

  public function sellCrypto($u_id, $crypto, $amount, $price)
  {
    $sql = 'SELECT * FROM ' . $crypto . ' Where user_id=' . $u_id;
    $res = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if ($res) {
      $ctrl = $this->cryptoBalanceControl($u_id, $crypto);
      if ($ctrl - $amount >= 0) {
        $total = $amount * $price;
        $currentUsd = $this->getUsd($u_id);
        $updatedMoney = $currentUsd + $total;
        $sql = "UPDATE " . $crypto . " SET quantity= quantity - " . $amount . " WHERE user_id=" . $u_id;
        $this->db->exec($sql);
        $this->updateMoney($updatedMoney, $u_id);
      } else {

        $_SESSION["error"] = "Yetersiz bakiye !";
      }
    }
  }




  public function cryptoBalanceControl($u_id, $crypto)
  {
    $sql = "SELECT quantity FROM $crypto WHERE user_id=?";

    $res = $this->db->prepare($sql);
    $res->execute([$u_id]);
    $result = $res->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["quantity"];
  }




  public function getUserCryptoCurrency(int $user_id, string $crypto)
  {

    $sql = 'SELECT * FROM ' . $crypto . ' WHERE user_id = ' . $user_id;
    $resp = $this->db->query($sql, PDO::FETCH_ASSOC);
    if ($resp->rowCount()) {
      foreach ($resp as $res) {
        return $res["quantity"];
      }
    } else {

      return 1;
    }
  }

  public function sendMessageToAdmin($u_id, $sbj, $msg)
  {
    try {
      $sql = 'INSERT into messages (sender_id,subject,content) values (?,?,?)';
      $this->db->prepare($sql)->execute([$u_id, $sbj, $msg]);
    } catch (PDOException $ex) {
      error(500, 'Query could not be executed', $ex);
    }
  }

  public function getUsersMessage()
  {
    $sql = 'SELECT users.id,users.firstName,users.lastName,messages.subject,messages.content From messages INNER JOIN users ON users.id=messages.sender_id';
    $resp = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $resp;
  }
}
