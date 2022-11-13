<?php
$link = mysqli_connect("localhost", "alexander", "9NDbLWyu_5wRDJRW","mynotes");
if(mysqli_connect_error()){
    die("ERROR: unable to connect". mysql_connect_error());
    echo "<script>window.alert('hi')</script>";
}
?>
