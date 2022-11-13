<?php
session_start();
    include("connection.php");

$missingUsername = '<p> missingUsername </p>';
$missingEmail = '<p> missingEmail</p>';
$invalidEmail = '<p> invalidEmail</p>';
$missingPassword = '<p> missingPassword</p>';
$invalidPassword = '<p> invalidPassword</p>';
$missingPassword2 = '<p> missingPassword2</p>';
$invalidPassword2 = '<p> invalidPassword2</p>';
$errors = "";

if(empty($_POST["username"])){
    $errors .= $missingUsername;
}else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}


if(empty($_POST["email"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($_POST["email"], FILTER_SANITIZE_EMAIL)){
        $errors .= $invalidEmail;
    }
}


if(empty($_POST["pass1"])){
    $errors .= $missingPassword;
}else if(strlen($_POST["pass1"])>6 and preg_match('/[A-Z]/',$_POST["pass1"]) and preg_match('/[0-9]/',$_POST["pass1"]) ){
    $password = filter_var($_POST["pass1"], FILTER_SANITIZE_STRING);
    if(empty($_POST["pass2"])){
        $errors .= $missingPassword2;
    }else {
        $password2 = filter_var($_POST["pass2"], FILTER_SANITIZE_STRING); 
        if($password !== $password2){
            $errors.= "<p>Not the same pass</p>";
        }       
    }

}else{
   $errors .= $invalidPassword; 
}

if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}


$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
$password = hash('sha256', $password);


$sql = "SELECT * FROM `users` WHERE useranme = '$username'";

$result = mysqli_query($link, $sql);

if(!$result){
    echo '<div class="alert alert-danger">Error running the q</div>';
    exit;
}

$results = mysqli_num_rows($result);
if($results){
    echo '<div>username taken</div>';
    exit;
}

$sql = "SELECT * FROM `users` WHERE email = '$email'";

$result = mysqli_query($link, $sql);

if(!$result){
    echo '<div class="alert alert-danger">Error running the q</div>';
    // echo '<div>'. mysqli_error($link).'</div>';
    exit;
}

$results = mysqli_num_rows($result);
if($results){
    echo '<div>email already exists</div>';
    exit;
}

$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

$sql = "INSERT INTO users (`useranme`,`email`,`password`,`activation`) VALUES ('$username', '$email', '$password', '$activationKey')";

$result = mysqli_query($link, $sql);

if(!$result){
    echo "<div>Error inserting the details</div>";
    exit;
}

$message = "Please click on this link to activate your account:\n\n";
$message = "http://localhost/php_prog/activate.php?email=". urlencode($email) . "&key=$activationKey";
if(mail($email, "confirm your reg", $message, 'From:'.'alexandervanderleek@gmail.com')){
    echo "<div>Sent a mail</div>";
}else{
    echo "<div>Could not send mail</div>";
}

?>
