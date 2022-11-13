$("#updateUser").submit(function(event){
    // console.log("submit");
    event.preventDefault();
    var dataPost = $("#updateUser").serializeArray();
    $.ajax({
        url: "updateUsername.php",
        type: "POST",
        data: dataPost,
        success:function(data){
            if(data){
                $("#forgotMessage").html(data);
            }else{
                location.reload();
            }
        } ,
        error:
        $("#forgotMessage").html("<div class='alert alert-danger'>something went wrong</div>")
    });
    
})


$("#updatePass").submit(function(event){
    // console.log("submit");
    event.preventDefault();
    var dataPost = $("#updatePass").serializeArray();
    $.ajax({
        url: "updatepass.php",
        type: "POST",
        data: dataPost,
        success:function(data){
            if(data){
                $("#forgotMessage1").html(data);
            }
        } ,
        error:
        $("#forgotMessage1").html("<div class='alert alert-danger'>something went wrong</div>")
    });
    
})


$("#upadteEmail").submit(function(event){
    // console.log("submit");
    event.preventDefault();
    var dataPost = $("#upadteEmail").serializeArray();
    $.ajax({
        url: "updateemail.php",
        type: "POST",
        data: dataPost,
        success:function(data){
            if(data){
                $("#forgotMessage2").html(data);
            }
        } ,
        error:
        $("#forgotMessage2").html("<div class='alert alert-danger'>something went wrong</div>")
    });
    
})