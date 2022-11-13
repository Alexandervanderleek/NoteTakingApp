<?php
session_start();
include("connection.php");

$id = $_SESSION['user_id'];

$username = $_POST['user'];

$sql = "UPDATE users SET useranme='$username' WHERE user_id='$id'";

$result = mysqli_query($link, $sql);

if(!$result){
    echo "<div class='alert alert-danger'>Error updating </div>";
}

?>