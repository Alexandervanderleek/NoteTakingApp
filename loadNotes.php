<?php 
session_start();
include('connection.php');

$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM notes WHERE note=''";

$result = mysqli_query($link, $sql);

if(!$result){
    echo "<div class='alert alert-warning'>error</div>";
    exit;
}


$sql = "SELECT * FROM notes WHERE user_id='$user_id' ORDER BY time DESC";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $note = $row['note'];
        $timenote = $row['time'];
        $note_id = $row['ID'];
        $timenote = date("F d, Y h:i:s A",$timenote);
        
        echo "
        <div class='note row'>
        <div class='col-xs-5 col-sm-3 delete'>
        <button class='btn-lg btn-danger'>DELETE</button>
        </div>
        <div class='noteheader' id='$note_id'>
        <div class='text'>$note</div>
        <div class='timetext'>$timenote</div>
        </div>
        </div>";
       } 
    }else{
        echo "<div class='alert alert-warning'>No notes created<div>";
    }


}else{
    echo "<div class='alert alert-warning'>error</div>";
    // echo mysqli_error($link);
    exit;
}








?>