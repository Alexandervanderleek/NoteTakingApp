
$("#signUpForm").submit(function(event){
    console.log("submit");
    event.preventDefault();
    var dataPost = $("#signUpForm").serializeArray();
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: dataPost,
        success:function(data){
            if(data){
                $("#signupMessage").html(data);
            }
        } ,
        error:
        $("#signupMessage").html("<div class='alert alert-danger'>something went wrong</div>")
    });
    
})

$("#loginForm").submit(function(event){
    console.log("submit");
     event.preventDefault();
    event.preventDefault();
    var dataPost = $("#loginForm").serializeArray();
    $.ajax({
        url: "login.php",
        type: "POST",
        data: dataPost,
        success:function(data){
            if(data == "success"){
                window.location = "mainPageLoggedIn.php";
            }else{
                $("#loginMessage").html(data);
            }
        } ,
        error:
        $("#loginMessage").html("<div class='alert alert-danger'>something went wrong</div>")
    });
    
 })


 $("#forgotForm").submit(function(event){
    console.log("submit2");
    event.preventDefault();
   event.preventDefault();
   var dataPost = $("#forgotForm").serializeArray();
   $.ajax({
       url: "forgot.php",
       type: "POST",
       data: dataPost,
       success:function(data){
           $("#forgotMessage").html(data);
       } ,
       error:
       $("#forgotMessage").html("<div class='alert alert-danger'>something went wrong</div>")
   });
   
})


