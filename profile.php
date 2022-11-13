<?php
session_start();
  if(!isset($_SESSION['user_id'])){
    header("location:index.php");
  }
  include("connection.php");
  $user_id = $_SESSION["user_id"];

  $sql = "SELECT * FROM users WHERE user_id='$user_id'";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);

  if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $row['useranme'];
    $email = $row['email'];
  }else{
    echo "there was an error";
  }
?>

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
    <style>
        .container{
             margin-top: 100px; 
        }


       

        .buttons{
            margin-bottom: 20px;
        }

        tr{
            cursor: pointer;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border border-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Help</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mainPageLoggedin.php">My Notes</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
        
      <li class="nav-item">
        <a class="nav-link text-primary ">Logged in As <Strong><?php echo $username ;?></Strong>     </a>
      </li>


      <li class="nav-item">
        <a href="index.php?logout=1" class="nav-link text-primary font-weight-bold">Logout</a>
      </li>
   
    </ul>
    
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>General Account Settings:</h1>

          <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <tbody>
                <tr data-target="#updateusername" data-toggle="modal">
                <th scope="row">Username</th>
                <td><?php echo $username ;?></td>
                </tr>
                <tr data-target="#updateemail" data-toggle="modal">
                <th scope="row">Email</th>
                <td><?php echo $email ?></td>
                </tr>
                <tr data-target="#updatepassword" data-toggle="modal">
                <th scope="row">Password</th>
                <td colspan="2">HIDDEN</td>
                </tr>
            </tbody>
            </table>
          </div>
        </div>
    </div>

</div>

<form action="" method="post" id="updateUser">
<div class="modal" tabindex="-1" role="dialog" id="updateusername">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset your username:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="forgotMessage"></div>
      <div class="form-group">
            <label for="changeUser">Username</label>
            <input type="text" name="user" class="form-control" id="changeUser" maxlength=30 placeholder="<?php echo $username;?>">
        </div>
       
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" name="forgotpass" type="submit" value="Submit"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="" method="post" id="upadteEmail">
<div class="modal" tabindex="-1" role="dialog" id="updateemail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset your email:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="forgotMessage2"></div>
      <div class="form-group">
            <label for="changeEmail">Email</label>
            <input type="email" name="email" class="form-control" id="changeEmail" maxlength=30 placeholder="<?php echo $email ?>">
        </div>
       
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" name="forgotpass" type="submit" value="Submit"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="" method="post" id="updatePass">
<div class="modal" tabindex="-1" role="dialog" id="updatepassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter current & new password:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="forgotMessage1"></div>
      <div class="form-group">
            <input type="password" class="form-control" id="changePass1" maxlength=30 placeholder="you current password" name="pass1">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="changePass2" maxlength=30 placeholder="your new password" name="pass2">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="changePass3" maxlength=30 placeholder="re-type your password" name="pass3">
        </div>
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" name="forgotpass" type="submit" value="Submit"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>

<footer class="footer">
      <div class="text-center">
        <span class="text-muted">Alexander van der Leek &copy; <?php 
        $today = date("Y");
        echo $today;
        ?> </span>
      </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="profile.js"></script>
</body>

</html>