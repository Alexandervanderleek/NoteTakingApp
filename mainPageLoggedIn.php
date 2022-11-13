<?php
session_start();
  if(!isset($_SESSION['user_id'])){
    header("location:index.php");
  }
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
    <style>
        .container{
             margin-top: 100px; 
        }


        #allNote, #doneNote, #notePad, .delete{
            display: none;
        }

        .buttons{
            margin-bottom: 20px;
        }

        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: pink;
            color: #CA3DD9;
            background-color:#FBEFFF;
            padding: 10px;
        }

        .noteheader{
          border: 1px solid grey;
          border-radius: 10px;
          margin-bottom: 10px;
          cursor: pointer;
          padding: 0 10px;
          background: linear-gradient(grey, white);
          width: 100%;
        }


        .text{
          font-size: 20px;
          overflow: hidden;
          white-sapce: nowrap;
          text-overflow: ellipsis;
        }

        .timetext{
          overflow: hidden;
          white-sapce: nowrap;
          text-overflow: ellipsis;
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
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Help</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">My Notes</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
        
      <li class="nav-item">
        <a class="nav-link text-primary ">Logged in As <Strong><?php echo $_SESSION['useranme'] ?></Strong>     </a>
      </li>


      <li class="nav-item">
        <a href="index.php?logout=1" class="nav-link text-primary font-weight-bold">Logout</a>
      </li>
   
    </ul>
    
  </div>
</nav>

<div class="container">
    <div id='alert' class='alert alert-danger collapse'>
      <a class="close" data-dismiss="alert">
        &times;
      </a>
      <p id='alertContent'>
        
        </p>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="buttons">
            <button id="addNote" type="button" class="btn btn-info btn-lg">Add Note</button>
            <button id="editNote" type="button" class="btn btn-info btn-lg float-right">Edit</button>
            <button id="doneNote" type="button" class="btn btn-success btn-lg float-right">Done</button>
            <button id="allNote" type="button" class="btn btn-info btn-lg">All Notes</button>
            </div>

            <div>
                <textarea name="" id="notePad" cols="30" rows="10">

                </textarea>
            </div>


            <div id="notes" class="notes">
                <!-- ajax to php to get the notes -->
            </div>
        </div>
    </div>

</div>

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
<script src="mynotes.js"></script>
</body>

</html>