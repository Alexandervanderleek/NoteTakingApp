<?php
session_start();
include("connection.php");
if(!isset($_POST['userID'])  ||
!isset($_POST['Key'])){
    // echo implode(" ",$_POST);
    // var_dump($_POST);
    echo "<div class='alert alert-danger'>There was a error please use correct actiation<div>";
    exit;
}



$userid = $_POST["userID"];
$Key = $_POST["Key"];
$time = time() -86400;

$userid = mysqli_escape_string($link, $userid);

$Key = mysqli_real_escape_string($link, $Key);


$sql = "SELECT userID FROM forgotpass WHERE keyname='$Key' AND userID='$userid' AND time > '$time' AND status='pending'";

$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count !== 1){
    echo "<div>There was an error</div>";
    exit;
}


$errorpass = "no sir";
$errors = "";
$password = "";

if(empty($_POST["password"])){
    $errors .= $errorpass;
}else if(strlen($_POST["password"])>6 and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"]) ){
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
        $errors .= $errorpass;
    }else {
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING); 
        if($password !== $password2){
            $errors.= "<p>Not the same pass</p>";
        }       
    }

}else{
   $errors .= $errorpass; 
}

if($errors){
    echo "<div>Errors</div>";
    exit;
}

$password = mysqli_real_escape_string($link, $password);
$password = hash('sha256', $password);


$userid = mysqli_real_escape_string($link, $userid);


$sql = "UPDATE users SET password='$password' WHERE user_id='$userid'";
$result = mysqli_query($link, $sql);

if(!$result){
    echo "<div>No sire</div>";
    exit;
}

$sql = "UPDATE forgotpass SET status='used' WHERE keyname='$Key' AND userID='$userid'";

$result = mysqli_query($link,$sql);

if(!$result){
    echo "a error occured ";
    exit;
}else{
    echo "<div>your pass has been successfully updated <a href='index.php'>Login<a></div>";
}





?>