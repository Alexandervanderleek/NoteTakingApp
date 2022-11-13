<?php


if( isset($_GET['logout'])){
    session_destroy();
    setcookie("rememberme", "", time() - 3600);
}else{
    if(!isset($_SESSION['user_id']) &&  !empty($_COOKIE['rememberme'])){

        list($auth1, $auth2) = explode(',',$_COOKIE['rememberme'] );
        $auth2= hex2bin($auth2);
        $f2auth2 = hash('sha256', $auth2);
    
    
        $sql = "SELECT * FROM rememberme WHERE authenticator1 = '$auth1'";
    
        $result = mysqli_query($link, $sql);
    
        if(!$result){
            echo "<div>there was an error</div>";
            exit;
        }else{
            $count = mysqli_num_rows($result);
            if($count !== 1){
                echo "<div>something went wrong</div>";
                exit;
            }
    
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
            if(!hash_equals($row['f2authenticator2'], $f2auth2)){
               echo "<div>hash not equal</div>"; 
            }else{
               
                        function f1($x,$y){
                            $c = $x . "," . bin2hex($y);
                            return $c;
                        }
    
                        $cookieValue = f1($auth1, $auth2);
    
                        setcookie(
                            "rememberme",
                            $cookieValue,
                            time() + 1296000
                        );
    
                        function f2($a){
                            $b = hash('sha256', $a);
                            return $b;
                        }
                        
                       
    
                        if(!$result){
                            echo "<div>there was an error</div>";
                            exit;
                        }else{
                            $_SESSION['user_id'] = $row['user_id'];
                            header("location:mainPageLoggedIn.php");
                        }
                    
    
    
    
               
            }
            
        }
    
    }
}




?>