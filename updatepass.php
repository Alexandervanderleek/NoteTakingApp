<?php
session_start();
include("connection.php");

$error = "";


if(empty($_POST["pass1"])){
    $error .= "error";
}else{
     $currentpass = $_POST["pass1"];
     filter_var($currentpass, FILTER_SANITIZE_STRING);
     $currentpass = mysqli_real_escape_string($link, $currentpass);
     $currentpass = hash('sha256', $currentpass);
     $user_id = $_SESSION["user_id"];
     $sql = "SELECT password FROM users WHERE user_id='$user_id'";
     $result = mysqli_query($link, $sql);
     $count = mysqli_num_rows($result);
     if($count !== 1){
        echo "<div class='alert alert-danger'>There was a issue running query</div>";
     }else{
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($currentpass != $row["password"]){
            $error .= "error2";
        }
        
     }
}

if(empty($_POST["pass2"])){
    $error .= "error 3";
}else if(strlen($_POST["pass2"])>6 and preg_match('/[A-Z]/',$_POST["pass2"]) and preg_match('/[0-9]/',$_POST["pass2"]) ){
    $password = filter_var($_POST["pass2"], FILTER_SANITIZE_STRING);
    if(empty($_POST["pass3"])){
        $error .= "error 4";
    }else {
        $password2 = filter_var($_POST["pass3"], FILTER_SANITIZE_STRING); 
        if($password !== $password2){
            $error.= "error 5";
        }       
    }

}else{
   $error .= "error 5"; 
}


if($error){
    echo "<div>$error</div>";
}else{
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);
    $sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
    $result=mysqli_query($link, $sql);
    if(!$result){
        echo "<div>pass could not be reset</div>";
    }else{
        echo "<div class='alert alert-success'>success</div>";
    }
}



?>