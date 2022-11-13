<?php
session_start();
include("connection.php");
if(!isset($_GET['email'])  ||
!isset($_GET['newemail'])  || !isset($_GET['key'])  ){
    echo "<div class='alert alert-danger'>There was a error please use correct activation<div>";
    exit;
}



$email = $_GET["email"];
$newemail = $_GET["newemail"];
$key = $_GET["key"];

$email = mysqli_escape_string($link, $email);

$newemail = mysqli_escape_string($link, $newemail);

$key = mysqli_real_escape_string($link, $key);


$sql = "UPDATE users SET email='$newemail', activation2='0' WHERE (email='$email' AND activation2='$key') LIMIT 1";

$result = mysqli_query($link, $sql);

if(mysqli_affected_rows($link) == 1){
    session_destroy();
    setcookie("rememberme", "", time()-3600);
    echo "<div>Account activated</div>";
    echo "<a href='index.php' type='button' class='btn-lg btn-success'>Login</a>";

}else{
    echo "<div>Could not be activated</div>";
}

?>