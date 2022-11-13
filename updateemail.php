<?php
session_start();
include("connection.php");
$user_id= $_SESSION['user_id'];
$newemail = $_POST['email'];

$sql = "SELECT * FROM users WHERE email='$newemail'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count > 0 ){
    echo "<div>error exists</div>";
    exit;
}


$sql = "SELECT * FROM users WHERE user_id='$user_id'";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);

  if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $email = $row['email'];
  }else{
    echo "there was an error";
    exit;
  }


  $activationKey = bin2hex(openssl_random_pseudo_bytes(16));

  $sql = "UPDATE users SET activation2='$activationKey' WHERE user_id='$user_id'";

  $result = mysqli_query($link, $sql);

  if(!$result){
    echo "<div>Errorrs</div>";
    exit;
  }else{
    $message = "Please click on this link to prove this is yours:\n\n";
    $message = "http://localhost/php_prog/activatenewemail.php?email=". urlencode($email) . "&newemail=" .urlencode($newemail)  . "&key=$activationKey";
    if(mail($newemail, "emailUpdate", $message, 'From:'.'alexandervanderleek@gmail.com')){
        echo "<div>Sent a mail</div>";
    }else{
        echo "<div>Could not send mail</div>";
    }
  }





?>