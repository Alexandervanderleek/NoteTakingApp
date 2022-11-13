<?php
session_start();


include("connection.php");

$missingUsername = "<p>Please enter your username</p>";
$missingPassword = "<p>Please enter your password</p>";
$errors = "";


if(empty($_POST["usernameIn"])){
    $errors .= $missingUsername;
}else{
    $username = filter_var($_POST["usernameIn"], FILTER_SANITIZE_STRING);
}


if(empty($_POST["passwordIn"])){
    $errors .= $missingPassword;
}else{
    $password = filter_var($_POST["passwordIn"], FILTER_SANITIZE_STRING);
}


if($errors){
    echo "<div> $errors </div>";
    exit;
}else{

    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);


    $sql = "SELECT * FROM users WHERE useranme='$username' AND password='$password' AND activation='activated'";

    $result = mysqli_query($link, $sql);

    if(!$result){
        echo "<div>Error loading q</div>";
        exit;
    }

    $count = mysqli_num_rows($result);
    if($count == 1){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['useranme'] = $row['useranme'];
        $_SESSION['email'] = $row['email'];

        if(empty($_POST["rememberme"])){
            echo "success";
        }else{
            $authenticator1 = bin2hex(openssl_random_pseudo_bytes(10));
            $authenticator2 = (openssl_random_pseudo_bytes(20));

            function f1($x,$y){
                $c = $x . "," . bin2hex($y);
                return $c;
            }

            $cookieValue = f1($authenticator1, $authenticator2);

            setcookie(
                "rememberme",
                $cookieValue,
                time() + 1296000
            );

            function f2($a){
                $b = hash('sha256', $a);
                return $b;
            }
            
            $authenticator2 = f2($authenticator2);
            $user_id = $_SESSION["user_id"];
            $expiration = date('Y-m-d H:i:s', time() + 1296000);
            $sql = "INSERT INTO rememberme (`authenticator1`,`f2authenticator2`,`userID`,`expDate`) VALUES ('$authenticator1', '$authenticator2', '$user_id', '$expiration')";
            $result = mysqli_query($link, $sql);

            if(!$result){
                echo "<div>there was an error</div>";
                exit;
            }else{
                echo "success";
            }
        }



    }else{
        echo "<div>greater than count of 1<div>";
    }

}


?>