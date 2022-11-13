<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="stylings.css">
    
</head>
<body>
<div id="resultmsg"></div>
<?php
session_start();
include("connection.php");
if(!isset($_GET['user_id'])  ||
!isset($_GET['Key'])){
    echo "<div class='alert alert-danger'>There was a error please use correct activation<div>";
    exit;
}



$userid = $_GET["user_id"];
$Key = $_GET["Key"];
$time = time() -86400;

$userid = mysqli_escape_string($link, $userid);

$Key = mysqli_real_escape_string($link, $Key);


$sql = "SELECT userID FROM forgotpass WHERE keyname='$Key' AND userID='$userid' AND time > '$time' AND status='pending'";

$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count !== 1){
    echo "<div>There was an error</div>";
    exit;
}else{
    echo "<form method=post id='passreset'>
        <input type=hidden name=Key value=$Key></input>
        <input type=hidden name=userID value=$userid></input>
        <div class='form-group'>
        <label for='password' >Enter your password</label>
        <input type='password' name='password' id='password' placeholder='Enter a password' class='form-control'>
        </div>   

        <div class='form-group'>
        <label for='password2' >re-enter your password</label>
        <input type='password' name='password2' id='password2' placeholder='reenter a password' class='form-control'>
        </div>   
        
        <input type='submit' name='resetpass' class='btn btn-success btn-lg' value='Reset pass'>
        
        </input>
    
    
    </form>";
}

?>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $("#passreset").submit(function(event){
    console.log("submit2");
    event.preventDefault();
   event.preventDefault();
   var dataPost = $("#passreset").serializeArray();
   $.ajax({
       url: "storeresetpass.php",
       type: "POST",
       data: dataPost,
       success:function(data){
           $("#resultmsg").html(data);
       } ,
       error:
       function(){
        $("#resultmsg").html("<div class='alert alert-danger'>something went wrong</div>")
       }
   });
   
} )
</script>
</body>

</html>