<?php
session_start();
include("connection.php");

include("rememberme.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="stylings.css">
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Help</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link text-primary font-weight-bold" href="#LoginModal" data-dismiss="modal" data-toggle="modal">Login</a>
      </li>
   
    </ul>
    
  </div>
</nav>

<div class="jumbotron" id="myContainer">
  <h1 class="display-4">Online Notes App</h1>
  <p class="lead">Your note with you wherever you go!</p>
  <p>Easy to use protects all your notes.</p>
  <button type="button" class="btn btn-primary btn-lg signup" data-target="#signUpModal" data-toggle="modal">Sign up Now !</button>

</div>
<form method="post" id="signUpForm">
<div class="modal" tabindex="-1" role="dialog" id="signUpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sign Up Today and Start using our app !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="signupMessage"></div>
        <div class="form-group">
            <label for="InputUsername">Username</label>
            <input type="text" class="form-control" id="inputUsername" maxlength=30 placeholder="Username" name="username">
        </div>
        <div class="form-group">
            <label for="InputEmail">Email</label>
            <input type="email" class="form-control" id="InputEmail" maxlength=50 placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="pass1">
        </div>
        <div class="form-group">
            <label for="InputPassword2">Confirm Your Password</label>
            <input type="password" class="form-control" id="InputPassword2" placeholder="Re-Type Password" name="pass2">
        </div>
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" name="signup" value="Sign Up"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>


<form  method="post" id="loginForm">
<div class="modal" tabindex="-1" role="dialog" id="LoginModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="loginMessage"></div>
        <div class="form-group">
            <label for="LoginUsername">Username</label>
            <input type="text" class="form-control" id="LoginUsername" maxlength=30 placeholder="Username" name="usernameIn">
        </div>
       
        <div class="form-group">
            <label for="LoginPassword">Password</label>
            <input type="password" class="form-control" id="LoginPassword" placeholder="Password" name="passwordIn">
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name="rememberme" id="rememberme">
            Remember Me
          </label>
          
          <a href="#forgotModal" data-toggle="modal" data-dismiss="modal" class="float-right" style="cursor: pointer">Forgot Password</a>
          

        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-auto" data-target="#signUpModal" data-toggle="modal" data-dismiss="modal" >Register</button>
        <input class="btn btn-primary" type="submit" name="loginIn" value="Login"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>

<form method="post" id="forgotForm">
<div class="modal" tabindex="-1" role="dialog" id="forgotModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset your credentials:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="forgotMessage"></div>
      <div class="form-group">
            <label for="forgotEmail">Email</label>
            <input type="email" class="form-control" id="forgotEmail" maxlength=50 placeholder="Email" name="forgotEmail">
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-auto" data-target="#signUpModal" data-toggle="modal" >Register</button>
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
<script src="index.js"></script>


</body>

</html>