<?php 
session_start();
include('connection.php');

$id = $_POST['id'];

$note =$_POST['note'];

$time = time();

$sql = "UPDATE notes SET note='$note', time='$time' WHERE ID='$id'";

$result = mysqli_query($link, $sql);

if(!$result){
    echo 'error';
}else{
    echo $result;
}

?>