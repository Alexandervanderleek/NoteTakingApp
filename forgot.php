<?php
session_start();

include("connection.php");


$missingEmail = '<p> missingEmail</p>';
$invalidEmail = '<p> invalidEmail</p>';
$errors = "";

if(empty($_POST["forgotEmail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["forgotEmail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($_POST["forgotEmail"], FILTER_SANITIZE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

if($errors){
    $resultmsg = "<div>".$errors."<div>";
    echo $resultmsg;
    exit;
}

$email = mysqli_real_escape_string($link,$email);

$sql = "SELECT * FROM `users` WHERE email = '$email'";

$result = mysqli_query($link, $sql);

if(!$result){
    echo '<div class="alert alert-danger">Error running the q</div>';
    // echo '<div>'. mysqli_error($link).'</div>';
    exit;
}

$count = mysqli_num_rows($result);
if($count != 1){
    echo '<div>That email does not exist</div>';
    exit;
}


$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$user_id = $row['user_id'];

$Key = bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
$status = 'pending';

$sql = "INSERT INTO forgotpass (`userID`,`keyname`,`time`,`status`) VALUES ('$user_id','$Key','$time','$status')";

$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div>Something went wrong</div>";
    exit;
}

$message = "Please click on this link to reset your password:\n\n";
$message = "http://localhost/php_prog/resetpass.php?user_id=$user_id&Key=$Key";
if(mail($email, "Reset your password", $message, 'From:'.'alexandervanderleek@gmail.com')){
    echo "<div>Sent a mail</div>";
}else{
    echo "<div>Could not send mail</div>";
}



?>
